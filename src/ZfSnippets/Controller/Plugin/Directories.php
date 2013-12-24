<?php
namespace ZfSnippets\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Class Directories
 * @package ZfSnippets\Plugin
 */
class Directories extends AbstractPlugin
{
    /**
     * @param $dirname
     * @return bool
     */
    public function DeleteDirectory($dirname)
    {
        if (is_dir($dirname)) $dir_handle = opendir($dirname);
        if (!$dir_handle) return false;

        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->DeleteDirectory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    /**
     * @param $target
     */
    public function DeleteFiles($target)
    {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK);

            foreach ($files as $file) {
                $this->DeleteFiles($file);
            }
            // rmdir($target);
        } else {
            unlink($target);
        }
    }
}