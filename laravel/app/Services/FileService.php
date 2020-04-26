<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;

/**
 * Class FileService
 * @package App\Services
 */
class FileService
{
    /**
     * @param UploadedFile $file
     * @return array
     */
    public function uploadFile(UploadedFile $file): array
    {
        $image = $this->resize($file, 400);

        $path = 'images/' . md5(uniqid(rand(), true)) . '.jpg';

        Storage::disk('public')->put($path, $image);

        return [$path, Storage::url($path)];
    }

    /**
     * @param UploadedFile $file
     * @param int $width
     * @param int|null $height
     * @return Image
     */
    private function resize(UploadedFile $file, int $width, int $height = null): Image
    {
        $image = ImageManagerStatic::make($file);
        $image
            ->fit(
                $width,
                $height,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )
            ->encode('jpg');

        return $image;
    }
}
