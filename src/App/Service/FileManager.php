<?php

namespace App\Service;

use http\Exception\RuntimeException;

class FileManager
{
    public function exists(string $path)
    {
        return file_exists($path);
    }

    public function delete(string $path)
    {
        if (!file_exists($path)){
            throw new RuntimeException('Undefined path . ' . $path);
        }

        if (is_dir($path)){
            foreach (scandir($path, SCANDIR_SORT_ASCENDING) as $item){
                if ($item === '.' || $item === '..'){
                    continue;
                }

                $this->delete($path . DIRECTORY_SEPARATOR . $item);
            }
            if (!rmdir($path)){
                throw new RuntimeException('Unable to delete directory . ' . $path);
            }
        } else {
            if (!unlink($path)){
                throw new RuntimeException('Unable to delete file . ' . $path);
            }
        }
    }
}