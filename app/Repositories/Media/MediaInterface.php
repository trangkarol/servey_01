<?php

namespace App\Repositories\Media;

interface MediaInterface
{
    public function deleteMedia($mediableIds, $mediableType);

    public function cloneMedia($media, $object);
}
