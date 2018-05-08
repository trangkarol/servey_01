<?php

namespace App\Repositories\Section;

use App;
use Exception;
use App\Models\Section;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;
use App\Repositories\Question\QuestionInterface;

class SectionRepository extends BaseRepository implements SectionInterface
{
    public function getModel()
    {
        return Section::class;
    }

    public function deleteSections($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        $questionIds = app(QuestionInterface::class)->whereIn('section_id', $ids)->pluck('id')->all();
        app(QuestionInterface::class)->deleteQuestions($questionIds);

        return $this->model->whereIn('id', $ids)->delete();
    }
}
