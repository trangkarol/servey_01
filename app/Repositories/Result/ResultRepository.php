<?php

namespace App\Repositories\Result;

use App\Models\Result;
use App\Repositories\BaseRepository;

class ResultRepository extends BaseRepository implements ResultInterface
{
    public function __construct(Result $result)
    {
        parent::__construct($result);
    }

    public function create($answers)
    {
        $input = [];
        foreach ($answers as $answer) {
            $input[] = [
                'sender_id' => $senderId,
                'recever_id' => $receverId,
                'answer_id' => $answer->id,
            ];
        }

        $this->multiCreate($input);
    }
}
