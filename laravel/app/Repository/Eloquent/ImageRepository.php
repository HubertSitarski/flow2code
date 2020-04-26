<?php

namespace App\Repository\Eloquent;

use App\Image;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * Class ImageRepository
 * @package App\Repository\Eloquent
 */
class ImageRepository extends BaseRepository
{
    private $fileService;

    /**
     * ImageRepository constructor.
     * @param Image $image
     * @param FileService $fileService
     */
    public function __construct(Image $image, FileService $fileService)
    {
        parent::__construct($image);

        $this->fileService = $fileService;
    }

    /**
     * @param UploadedFile $file
     * @return Model
     */
    public function upload(UploadedFile $file): Model
    {
        list ($name, $path) = $this->fileService->uploadFile($file);

        $attributes = [
            'name' => $name,
            'path' => $path
        ];

        return $this->model->create($attributes);
    }
}
