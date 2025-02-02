<?php

/**
 * Component. RRouting or analysis of the incoming request.
 *
 * Definition and initialization of the input parameters of the request
 *
 * @package Zero.Component
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Www_Route
{
    /**
     * Routing iazy`ka
     *
     * @var string
     */
    public $Lang = '';

    /**
     * Routing razdela s parametrami dlia navigatcii
     *
     * @var string
     */
    public $Url = '';

    /**
     * Routing iazy`ka
     *
     * @var array
     */
    public $Param = [];

    /**
     * Routing iazy`ka
     *
     * @var array
     */
    public $UrlSegment = [];

    /**
     * Пользовательский роутинг
     *
     * Sample:
     * '/page/page/page' => 'Zero_Section_Page', '/page/page/page' => 'Zero_Section_Page', '/page/page/page' => 'Zero_Section_Page' ...
     *
     * @var array
     */
    public static $Routes = [];

    /**
     * Analiz request url
     */
    public function __construct()
    {
        $this->Lang = Zero_App::$Config->Site_Language;

        // если запрос консольный
        if ( !isset($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] == '/' )
        {
            $this->Url = '/';
            return;
        }

        if ( false !== strpos($_SERVER['REQUEST_URI'], 'http://') )
            die("hello children :-)");
        else if ( false !== strpos($_SERVER['REQUEST_URI'], 'https://') )
            die("hello children :-)");

        if ( substr($_SERVER['REQUEST_URI'], -1) == '/' )
            Zero_App::ResponseRedirect(substr($_SERVER['REQUEST_URI'], 0, -1));

        $row = explode('/', strtolower(rtrim(ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/'), '/')));
        $this->UrlSegment = $row;

        // язык
        if ( $this->Lang != $row[0] && isset(Zero_App::$Config->Language[$row[0]]) )
        {
            $this->Lang = array_shift($row);
            $this->Url = '/' . $this->Lang;
            if ( count($row) == 0 )
                return;
        }

        // api
        if ( 'api' == $row[0] )
        {
            Zero_App::$Mode = 'api';
            $this->Url = '/api' . (isset($row[1]) ? '/' . $row[1] : '');
            if ( $_SERVER['REQUEST_METHOD'] === "PUT" )
            {
                $data = file_get_contents('php://input', false, null, -1, $_SERVER['CONTENT_LENGTH']);
                $_POST = json_decode($data, true);
            }
            else if ( $_SERVER['REQUEST_METHOD'] === "POST" && isset($GLOBALS["HTTP_RAW_POST_DATA"]) )
            {
                $_POST = json_decode($GLOBALS["HTTP_RAW_POST_DATA"], true);
            }
            return;
        }

        // парамтеры
        if ( 0 < count($row) )
        {
            $param = array_pop($row);
            if ( preg_match("~.+?-([^/]+)$~", $param, $arr) )
            {
                $row[] = str_replace('-' . $arr[1], '', $param);
                foreach (explode('-', explode('.', $arr[1])[0]) as $segment)
                {
                    $arr = explode(':', $segment);
                    if ( 1 < count($arr) )
                        $this->Param[$arr[0]] = $arr[1];
                }
            }
            else
                $row[] = $param;
            //$this->Url .= implode('/', $row);
            $this->Url .= '/' . implode('/', $row);
        }

        foreach ($this->Param as $k => $v)
        {
            $_GET[$k] = $v;
        }
    }
}
