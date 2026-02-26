<?php
namespace App\Traits;

trait CheckFileSizeTrait
{

    public function checkFileSize($files)
    {
        
        foreach ($files as $file) {
            $fileSize = filesize($file);
            if ($fileSize > 3 * 1024 * 1024) { // 3MB in bytes    
                return false;
            }
        }
        return true;
    }
}
