<?php

namespace App\Utility;

use Str;

class DirectoryUtils
{

    /**
     * Get last folder name from a path
     *
     * @param string $path Folder path
     * @return string last directory name
     **/
    static function dirNameFromStorage(string $path): string
    {
        $str_exploded = explode('/', $path);
        return $str_exploded[count($str_exploded) - 1];
    }

    /**
     * Get the normal name from kebab case string
     *
     * @param string $string The string to be converted
     * @return string
     **/
    static function snakeToNormal(string $string): string
    {
        if (!$string) {
            throw ('Argument must not be null');
        }
        $converted_string = Str::ucfirst(Str::replace('_', ' ', $string));
        return $converted_string;
    }
}
