<?php

namespace Engage\Downloadcenter\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class TenantFileAccess extends Model
{
    use HasFactory;

    public static function createDirectory($path)
    {
        $rootpath = self::rootPath();
        if (!file_exists($rootpath)) {
            File::makeDirectory($rootpath, 0777, true, true);
        }

        $folderpath = $rootpath.$path;
        $folderpath = rtrim($folderpath, "/").'/';

        if (!file_exists($folderpath)) {
            return File::makeDirectory($folderpath);
        }else{
            return true;
        }
    }

    public static function directoryExists($path){
        $folderpath = $path;
        if (!file_exists($folderpath)) {
            return false;
        }else{
            return $folderpath;
        }
    }

    public static function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir")
                    rrmdir($dir."/".$object);
                    else unlink   ($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    public static function rootPath(){
        $path = self::removeprePrefixSlash(env('DOWNLOAD_FILES_ROOT_FOLDER'));
        return storage_path($path);
    }

    public static function removeprePrefixSlash(string $url)
    {
        $url = ltrim($url,"/");
        return $url;
    }

    public static function getFilePath($path){
        $rootPath = self::rootPath();
        $filepath = $rootPath.$path;
        if (file_exists($filepath)) {
            return $filepath;
        }else{
            return false;
        }
    }

    public static function renameFile($old,$new){
        $old = TenantFileAccess::getFilePath($old);
        if($old){
            $new =  self::rootPath().$new;
            $rename = rename ($old, $new);
            if($rename){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
