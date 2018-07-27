<?php

/**
 * Controller. Контроллер изменения объекта
 *
 * @package Shop.Wares.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Wares_Edit extends Zero_Crud_Edit
{
    /**
     * The table stores the objects handled by this controller.
     *
     * @var string
     */
    protected $ModelName = 'Shop_Wares';

    /**
     * Template view
     *
     * @var string
     */
    protected $Template = 'Zero_Crud_Edit';
}