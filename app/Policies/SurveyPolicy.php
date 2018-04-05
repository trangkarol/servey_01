<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Survey;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view surveys.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Survey  $survey
     * @return mixed
     */
    public function view(User $user, Survey $survey)
    {
        return $survey->user_id === $user->id;
    }
}
