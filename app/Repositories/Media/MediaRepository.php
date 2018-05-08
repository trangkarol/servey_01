<?php

namespace App\Repositories\Media;

use App\Repositories\BaseRepository;
use App\Models\Media;
use App\Repositories\Media\MediaInterface;
use Storage;

class MediaRepository extends BaseRepository implements MediaInterface
{
    public function getModel()
    {
        return Media::class;
    }

    public function deleteMedia($mediableIds, $mediableType)
    {
        $mediableIds = is_array($mediableIds) ? $mediableIds : [$mediableIds];
        $regex = '/^http+/';
        $media = $this->model->whereIn('mediable_id', $mediableIds)->where('mediable_type', $mediableType);

        foreach ($media->get() as $value) {
            $urlImage = $value->url;
            preg_match($regex, $urlImage, $matches);

            if (!$matches) {
                $image = str_replace('storage', 'public', $urlImage);
                if (Storage::disk('local')->exists($image)) {
                    Storage::disk('local')->delete($image);
                }
            }
        }

        return $media->delete();
    }
}
