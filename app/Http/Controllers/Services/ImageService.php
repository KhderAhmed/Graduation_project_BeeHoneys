<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ImageService
{
    protected string $storagePath = 'blog';

    /**
     * رفع صورة جديدة وحذف الصورة القديمة (إن وجدت)
     *
     * @param UploadedFile $newImage
     * @param string|null $oldImage
     * @return string اسم الصورة الجديدة
     */
    public function uploadImage(UploadedFile $newImage, ?string $oldImage = null): string
    {
        // حذف الصورة القديمة لو موجودة
        if ($oldImage && File::exists(public_path("{$this->storagePath}/{$oldImage}"))) {
            File::delete(public_path("{$this->storagePath}/{$oldImage}"));
        }

        $imageName = time() . '.' . $newImage->getClientOriginalExtension();

        $newImage->move(public_path($this->storagePath), $imageName);

        return $imageName;
    }

    /**
     * حذف صورة من التخزين
     *
     * @param string $imageName
     * @return bool
     */
    public function deleteImage(string $imageName): bool
    {
        if (File::exists(public_path("{$this->storagePath}/{$imageName}"))) {
            return File::delete(public_path("{$this->storagePath}/{$imageName}"));
        }
        return false;
    }
}
