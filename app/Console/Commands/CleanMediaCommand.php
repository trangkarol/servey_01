<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Media\MediaInterface;

class CleanMediaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clear-media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all media not exist in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $mediaRepository;

    public function __construct(MediaInterface $mediaRepository)
    {
        parent::__construct();
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $listMediaInDataBase = $this->mediaRepository->pluck('url')->all();
        $listMediaInFolder = [];

        foreach (glob(config('settings.path_storage_image_direct') . '/*/*/*.*') as $file) {
            $listMediaInFolder[] = $file;
        }

        foreach ($listMediaInFolder as $media) {
            $item = str_replace(config('settings.path_storage_image_direct'), config('settings.path_storage_image'), $media);

            if (!in_array($item, $listMediaInDataBase) && !in_array('/' . $item, $listMediaInDataBase)) {
                if (file_exists($media)) {
                    unlink($media);
                }
            }
        }
    }
}
