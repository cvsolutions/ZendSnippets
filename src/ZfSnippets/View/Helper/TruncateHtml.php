<?php
namespace ZfSnippets\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
* TruncateHtml
*
* @uses     AbstractHelper
*
* @category Helper
* @package  ZfSnippets
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  New BSD License
* @link     
*/
class TruncateHtml extends AbstractHelper
{
    const _MBSTRING = 'UTF-8';

    const _CHARSET = 'UTF-8';

    const _UTF8_MODIFIER = 'u';

    /**
     * __invoke
     * 
     * @param mixed  $string      input string.
     * @param int    $length      length of truncated text.
     * @param string $etc         end string.
     * @param mixed  $break_words truncate at word boundary.
     * @param mixed  $middle      truncate in the middle of text.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function __invoke($string, $length = 80, $etc = '...', $break_words = false, $middle = false) {

        if ($length == 0) return '';

        if (self::_MBSTRING) {

            if (mb_strlen($string, self::_CHARSET) > $length) {

                $length -= min($length, mb_strlen($etc, self::_CHARSET));
                if (!$break_words && !$middle) {
                    $string = preg_replace('/\s+?(\S+)?$/' . self::_UTF8_MODIFIER, '', mb_substr($string, 0, $length + 1, self::_CHARSET));
                }

                if (!$middle) {
                    return mb_substr($string, 0, $length, self::_CHARSET) . $etc;
                }
                return mb_substr($string, 0, $length / 2, self::_CHARSET) . $etc . mb_substr($string, - $length / 2, $length, self::_CHARSET);
            }
            return $string;
        }

        if (isset($string[$length])) {

            $length -= min($length, strlen($etc));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
            }

            if (!$middle) {
                return substr($string, 0, $length) . $etc;
            }
            return substr($string, 0, $length / 2) . $etc . substr($string, - $length / 2);
        }
        return $string;
    } 

}
