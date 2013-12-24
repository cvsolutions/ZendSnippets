<?php
namespace ZfSnippets\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Class TruncateHtml
 * @package ZfSnippets\View\Helper
 */
class TruncateHtml extends AbstractHelper
{
    const _MBSTRING = 'UTF-8';

    const _CHARSET = 'UTF-8';

    const _UTF8_MODIFIER = 'u';

    /**
     * @param $string
     * @param int $length
     * @param string $etc
     * @param bool $break_words
     * @param bool $middle
     * @return mixed|string
     */
    public function __invoke($string, $length = 80, $etc = '...', $break_words = false, $middle = false)
    {
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
                return mb_substr($string, 0, $length / 2, self::_CHARSET) . $etc . mb_substr($string, -$length / 2, $length, self::_CHARSET);
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
            return substr($string, 0, $length / 2) . $etc . substr($string, -$length / 2);
        }
        return $string;
    }

}
