<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Setting\SettingInterface;
use App\Models\Survey;

class CloseSurveyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:auto-close-survey';
    protected $surveyRepository;
    protected $settingRepository;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update database when the suvey expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SurveyInterface $surveyRepository, SettingInterface $settingRepository)
    {
        parent::__construct();
        $this->settingRepository = $settingRepository;
        $this->surveyRepository = $surveyRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $surveyIds = $this->surveyRepository->where('status', config('settings.survey.status.open'))
            ->where('end_time', '<', Carbon::now())
            ->pluck('id')
            ->all();
        $this->surveyRepository->whereIn('id', $surveyIds)->delete();
    }
}
