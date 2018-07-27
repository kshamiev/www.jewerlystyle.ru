<?php

/**
 * Controller. <Comment>
 *
 * @package <Package>.<Subpackage>.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Wares_Search extends Zero_Controller
{
    /**
     * Поиск по товарам
     *
     * @return Zero_View представление
     * @throws Exception
     */
    public function Action_Default()
    {
        if ( isset($_REQUEST['search']) )
            $this->Params['search'] = $_REQUEST['search'];
        if ( !isset($this->Params['search']) || !$this->Params['search'] )
            Zero_App::ResponseRedirect(HTTPH);

        // Товары
        $Model = Zero_Model::Make('Shop_Wares');
        /* @var $Model Shop_Wares */

        // Фильтр
        $Filter = Zero_Filter::Factory($Model);
        if ( isset($_GET['pg']) && 0 < $_GET['pg'] )
        {
            if ( $_GET['pg'] == 1 )
            {
                Zero_App::ResponseError(404);
            }
            $Filter->Page = $_GET['pg'];
        }
        else
            $Filter->Page = 1;

        // Данные
        $dataList = $Model::DB_Page_Search($this->Params['search'], $Filter);
        $pager_count = $Model::DB_Page_Search_Count($this->Params['search'], $Filter);

        // Вывод
        $this->View = new Zero_View(__CLASS__);
        // Page by page
        $this->View->Assign('PagerPage', $Filter->Page);
        $this->View->Assign('PagerPageItem', Zero_App::$Config->View_PageItem);
        $this->View->Assign('PagerPageStep', Zero_App::$Config->View_PageStep);
        $this->View->Assign('PagerCount', $pager_count);
        //
        foreach ($dataList as $key => $row)
        {
            $dataList[$key]['NameTrans'] = Zero_Lib_String::Transliteration_Url($row['Name']);
        }
        $this->View->Assign('dataList', $dataList);
        $this->View->Assign('search', $this->Params['search']);
        return $this->View;
    }
}
