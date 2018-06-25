<?php

namespace App\Console\Commands;

use App\Models\Survey;
use Illuminate\Console\Command;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Section\SectionInterface;
use App\Repositories\Question\QuestionInterface;
use App\Repositories\Answer\AnswerInterface;
use App\Repositories\Setting\SettingInterface;
use App\Repositories\Media\MediaInterface;
use App\Repositories\Result\ResultInterface;
use App\Repositories\Invite\InviteInterface;
use Carbon\Carbon;
use App\Traits\ManageSurvey;

class OpenSurveyCommand extends Command
{
    use ManageSurvey;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:auto-open-survey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open the survey when it\'s time';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $surveyRepository;
    protected $sectionRepository;
    protected $questionRepository;
    protected $answerRepository;
    protected $settingRepository;
    protected $mediaRepository;
    protected $resultRepository;
    protected $inviteRepository;
    
    public function __construct(
        SurveyInterface $surveyRepository,
        QuestionInterface $questionRepository,
        SectionInterface $sectionRepository,
        AnswerInterface $answerRepository,
        SettingInterface $settingRepository,
        MediaInterface $mediaRepository,
        ResultInterface $resultRepository,
        InviteInterface $inviteRepository
    ) {
        parent::__construct();
        $this->surveyRepository = $surveyRepository;
        $this->surveyRepository = $surveyRepository;
        $this->questionRepository = $questionRepository;
        $this->sectionRepository = $sectionRepository;
        $this->answerRepository = $answerRepository;
        $this->settingRepository = $settingRepository;
        $this->mediaRepository = $mediaRepository;
        $this->resultRepository = $resultRepository;
        $this->inviteRepository = $inviteRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $surveys = $this->surveyRepository->where('status', config('settings.survey.status.close'))
            ->where('start_time', '<', Carbon::now())
            ->get();
        foreach ($surveys as $survey) {
            $this->open($survey);
        }
    }
}
