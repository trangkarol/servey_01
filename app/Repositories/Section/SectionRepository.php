<?php

namespace App\Repositories\Question;

use Exception;
use App\Models\Section;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;

class SectionRepository extends BaseRepository implements SectionInterface
{
    public function getModel()
    {
        return Section::class;
    }
}
