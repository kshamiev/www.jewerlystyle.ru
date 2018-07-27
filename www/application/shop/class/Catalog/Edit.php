<?php

/**
 * Controller. Section edit.
 *
 * To work with the catalog.
 *
 * @package Zero.Section.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Catalog_Edit extends Zero_Crud_Edit
{
    /**
     * The table stores the objects handled by this controller.
     *
     * @var string
     */
    protected $ModelName = 'Shop_Catalog';

    /**
     * Template view
     *
     * @var string
     */
    protected $Template = 'Zero_Crud_Edit';

    protected function Chunk_Init()
    {
        $this->Params['obj_parent_prop'] = 'Zero_Section_ID';
        $this->Params['obj_parent_name'] = '';
        parent::Chunk_Init();
    }

    /**
     *  Adding an object
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Add()
    {
        parent::Chunk_Add();
        $this->Model->Layout = 'Www_Main';
        $this->Model->Controller = 'Shop_Wares_Page';
    }

    /**
     * Initialization of the stack chunks and input parameters
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Export()
    {
        $cat = new Shop_Wares_Grid();
        $cat->Action_Export($_REQUEST['catId']);
    }
}