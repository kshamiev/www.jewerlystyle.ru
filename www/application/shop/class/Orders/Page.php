<?php

/**
 * Controller. User Profile.
 *
 * @package Zero.Users.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Orders_Page extends Zero_Controller
{
    /**
     * Vy`polnenie dei`stvii`
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Default()
    {
        $this->View = new Zero_View(get_class($this));
        $this->View->Assign('basketSum', Shop_Basket::DB_Get_Basket_Sum());
        $this->View->Assign('Users', Zero_App::$Users);
        return $this->View;
    }
}
