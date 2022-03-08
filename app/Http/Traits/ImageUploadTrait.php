<?php


namespace App\Http\Traits;

use Carbon\Carbon;

trait ImageUploadTrait
{
    public function upload($image = null)
    {
        $upload_path = public_path('images');
        if ($image != null) {
            $image_name = Carbon::now()->toDateString() . "-" . uniqid() . "." . $image->getClientOriginalExtension();
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }
            $image->move($upload_path, $image_name);
        } else {
            $image_name = 'def.png';
        }
        return $image_name;
    }

    public function updateImage($old_image = 'abc.png', $image = null)
    {
        $path = public_path() . '/images/' . $old_image;
        if (file_exists($path)) {
            unlink($path);
        }
        return $this->upload($image);
    }


}
