<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ImageUploadTrait
{
    /**
     * Upload one or multiple images to "public/media/{folder}" and delete old ones if exist.
     *
     * @param UploadedFile|array|null $images
     * @param string $folder
     * @param string|array|null $oldImages
     * @return string|array|null
     */
    public function uploadImage($images, string $folder, $oldImages = null)
    {
        if (! $images) {
            return $oldImages;
        }

        $directory = public_path("media/$folder");

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0775, true);
        }

        // Delete old image(s) and their thumbnails
        if ($oldImages) {
            if (is_array($oldImages)) {
                foreach ($oldImages as $img) {
                    $this->deleteImageAndThumbnail($img);
                }
            } else {
                $this->deleteImageAndThumbnail($oldImages);
            }
        }

        // Single image
        if ($images instanceof UploadedFile) {
            $filename = uniqid() . '.' . $images->getClientOriginalExtension();
            $images->move($directory, $filename);
            return "media/$folder/$filename";
        }

        // Multiple images
        $paths = [];
        if (is_array($images)) {
            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($directory, $filename);
                    $imagePath = "media/$folder/$filename";
                    $paths[] = $imagePath;
                    
                    // Generate thumbnail after image is uploaded
                    $this->generateThumbnail($imagePath, $folder);
                }
            }
            return $paths;
        }

        return null;
    }


    /**
     * Generate thumbnail for a single image (400x400 for gallery carousel).
     *
     * @param string $imagePath Relative path like "media/stores/filename.jpg"
     * @param string $folder Folder name like "stores"
     * @return string|null Thumbnail path or null on failure
     */
    protected function generateThumbnail($imagePath, $folder)
    {
        try {
            $fullImagePath = public_path($imagePath);
            
            // Check if image exists
            if (!file_exists($fullImagePath)) {
                return null;
            }
            
            // Get image info
            $pathInfo = pathinfo($imagePath);
            $thumbnailPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
            $fullThumbnailPath = public_path($thumbnailPath);
            
            // Create ImageManager instance
            $manager = new ImageManager(new Driver());
            $image = $manager->read($fullImagePath);
            
            // Resize to 400x400 maintaining aspect ratio
            $image->scale(width: 400, height: 400);
            
            // Save thumbnail with 85% quality
            $image->save($fullThumbnailPath, quality: 85);
            
            return $thumbnailPath;
        } catch (\Exception $e) {
            // Log error but don't break the upload process
            logger()->error('Thumbnail generation failed: ' . $e->getMessage() . ' | Image: ' . $imagePath);
            return null;
        }
    }

    /**
     * Delete image and its associated thumbnail.
     *
     * @param string $imagePath Relative path like "media/stores/filename.jpg"
     * @return void
     */
    protected function deleteImageAndThumbnail($imagePath)
    {
        $fullImagePath = public_path($imagePath);
        
        // Delete main image
        if (File::exists($fullImagePath)) {
            File::delete($fullImagePath);
        }
        
        // Delete thumbnail if exists
        $pathInfo = pathinfo($imagePath);
        $thumbnailPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
        $fullThumbnailPath = public_path($thumbnailPath);
        
        if (File::exists($fullThumbnailPath)) {
            File::delete($fullThumbnailPath);
    }
}
}
