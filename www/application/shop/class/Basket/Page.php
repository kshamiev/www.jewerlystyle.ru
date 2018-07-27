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
class Shop_Basket_Page extends Zero_Controller
{
    /**
     * Some action.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Default()
    {
        // Вывод
        $this->View = new Zero_View(get_class($this));
        $data = Shop_Basket::DB_Get_Wares();
        foreach ($data as $key => $row)
        {
            $data[$key]['NameTrans'] = Zero_Lib_String::Transliteration_Url($row['Name']);
        }
        $this->View->Assign('dataList', $data);
        return $this->View;
    }
}
