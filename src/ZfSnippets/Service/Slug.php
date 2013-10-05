<?php
namespace ZfSnippets\Service;
/**
* Slug
*
* @uses     
*
* @category Service
* @package  ZfSnippets
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  http://www.opensource.org/licenses/mit-license.php  MIT License
* @link     http://www.cvsolutions.it
*/
class Slug
{
    /**
     * toAscii
     * 
     * @param string $str       Title to friendly URL conversion.
     * @param string $delimiter Return good words separated by dashes.
     *
     * @access private
     *
     * @return mixed Value.
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