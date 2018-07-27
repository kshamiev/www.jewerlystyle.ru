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
class Shop_News_Page extends Zero_Controller
{
    /**
     * Постраничный вывод товаров
     *
     * @return bool flag stop execute of the next chunk
     * @throws Exception
     */
    private function _Chunk_View_Page()
    {
        $page = 0;
        if ( isset($_GET['pg']) && 0 < $_GET['pg'] )
        {
            if ( $_GET['pg'] == 1 )
            {
                Zero_App::ResponseError(404);
            }
            $page = $_GET['pg'];
        }
        else
            $page = 1;

        $index = 'waresList' . $page;

//        if ( false === $data = Zero_App::$Section->Get_Cache()->Get($index, Zero_Cache::TIME_H1) )
//        {
            // Новости
            $Model = $this->Model;
            /* @var $Model Shop_News */

            // Фильтр
            $Filter = Zero_Filter::Factory($Model);
            $Filter->Page = $page;

            // Данные
            $data = [];
            $data['list'] = $Model::DB_Page($Filter);
            $data['count'] = $Model::DB_Page_Count($Filter);

//            Zero_App::$Section->Get_Cache()->Set($index, $data, Zero_Cache::TIME_H1);
//        }

        // Вывод
        $this->View = new Zero_View(__CLASS__);
        // Page by page
        foreach ($data['list'] as $key => $row)
        {
            $data['list'][$key]['NameTrans'] = Zero_Lib_String::Transliteration_Url($row['Name']);
        }
        $this->View->Assign('dataList', $data['list']);
        $this->View->Assign('PagerPage', $page);
        $this->View->Assign('PagerPageItem', Zero_App::$Config->View_PageItem);
        $this->View->Assign('PagerPageStep', Zero_App::$Config->View_PageStep);
        $this->View->Assign('PagerCount', $data['count']);

        // SEO
        $HeaderLinkCanonical = '';
        if ( 1 < $page )
        {
            $HeaderLinkCanonical .= '<link rel="prev" href="' . ZERO_HTTP . URL . '-pg:' . ($page - 1) . '"/>' . "\n";
        }
        $HeaderLinkCanonical .= '<link rel="canonical" href="' . ZERO_HTTP . URL . '-pg:' . $page . '"/>' . "\n";
        if ( $page < ceil($data['count'] / Zero_App::$Config->View_PageItem) )
        {
            $HeaderLinkCanonical .= '<link rel="next" href="' . ZERO_HTTP . URL . '-pg:' . ($page + 1) . '"/>' . "\n";
        }
        Zero_App::Set_Variable('HeaderLinkCanonical', $HeaderLinkCanonical);

        return true;
    }

    /**
     * Create views.
     *
     * @return boolean flag stop execute of the next chunk
     */
    private function _Chunk_View_Details()
    {
        // Товары
        $Model = $this->Model;
        /* @var $Model Shop_News */

        // Вывод
        $this->View = new Zero_View(__CLASS__ . 'Details');
        $this->View->Assign('Name', $Model->Name);
        $this->View->Assign('Content', $Model->Content);

        // SEO
        Zero_App::Set_Variable("Title", $Model->Name);
        Zero_App::Set_Variable("Keywords", $Model->Name);
        Zero_App::Set_Variable("Description", $Model->Name);

        return true;
    }

    /**
     * Some action.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Default()
    {
        if ( isset($_GET['id']) && 0 < $_GET['id'] )
        {
            $this->Model = Zero_Model::Make('Shop_News', $_GET['id'], true);
            $this->_Chunk_View_Details();
        }
        else
        {
            $this->Model = Zero_Model::Make('Shop_News');
            $this->_Chunk_View_Page();
        }
        return $this->View;
    }
}
