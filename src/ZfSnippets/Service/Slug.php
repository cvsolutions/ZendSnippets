<?php
namespace ZfSnippets\Service;
/**
 * Class Slug
 * @package ZfSnippets\Service
 */
class Slug
{
    /**
     * @param string $str
     * @param string $delimiter
     * @return mixed|string
     */
    private function toAscii($str = '', $delimiter = '-')
    {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        return $clean;
    }
}