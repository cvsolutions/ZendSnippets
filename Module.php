<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2013 Concetto Vecchio <info@cvsolutions.it>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category   ZF2 Modules
 * @package    ZfSnippets
 * @subpackage /
 * @author     Concetto Vecchio <info@cvsolutions.it>
 * @copyright  2013 Concetto Vecchio.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    1.0
 * @link       http://www.cvsolutions.it
 */
namespace ZfSnippets;

/**
* Module
*
* @uses     
*
* @category ZF2 Modules
* @package  ZfSnippets
* @author   Concetto Vecchio <info@cvsolutions.it>
* @license  http://www.opensource.org/licenses/mit-license.php  MIT License
* @link     http://www.cvsolutions.it
*/
class Module
{

    /**
     * getAutoloaderConfig
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * getConfig
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}