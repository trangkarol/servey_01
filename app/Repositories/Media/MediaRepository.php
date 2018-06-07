<?php

namespace App\Repositories\Media;

use App\Repositories\BaseRepository;
use App\Models\Media;
use App\Repositories\Media\MediaInterface;
use App\Traits\FileProcesser;

class MediaRepository extends BaseRepository implements MediaInterface
{
    use FileProcesser;

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

    public function cloneMedia($media, $object)
    {
        $newMedia = [];
        $regex = '/^http+/';

        foreach ($media as $item) {
            preg_match($regex, $item['url'], $matches);

            if (!$matches) {
                $newUrl = $this->copyFile($item['url']);
                $item['url'] = $newUrl;
            }

            $newMedia[] = $item;
        }

        return $object->media()->createMany($newMedia);
    }
}
