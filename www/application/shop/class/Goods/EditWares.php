<?php

/**
 * Controller. Changing the content blocks page.
 *
 * @package Zero.Content.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Goods_EditWares extends Zero_Crud_Edit
{
    /**
     * The table stores the objects handled by this controller.
     *
     * @var string
     */
    protected $ModelName = 'Shop_Goods';

    /**
     * Template view
     *
     * @var string
     */
    protected $Template = 'Zero_Crud_Edit';

    protected function Chunk_Init()
    {
        $this->Params['obj_parent_prop'] = 'Shop_Wares_ID';
        $this->Params['obj_parent_name'] = '';
        parent::Chunk_Init();
    }

    /**
     * Save object
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Save()
    {
        if ( !isset($_REQUEST['Prop']) )
            $_REQUEST['Prop'] = [];

        if ( 0 == $this->Model->ID )
            $this->Chunk_Add();

        //  Set to relation one to many
        if ( isset($this->Params['obj_parent_prop']) && 0 == $this->Model->ID )
        {
            $prop = $this->Params['obj_parent_prop'];
            if ( 0 < $this->Params['obj_parent_id'] )
                $this->Model->$prop = $this->Params['obj_parent_id'];
            else
                $this->Model->$prop = null;
        }

        //  Set the user conditions
        $users_condition = Zero_App::$Users->Get_Condition();
        foreach (array_keys($this->Model->Get_Config_Prop()) as $prop)
        {
            if ( isset($users_condition[$prop]) && 1 == count($users_condition[$prop]) )
                $this->Model->$prop = key($users_condition[$prop]);
        }

        $this->Model->VL->Validate($_REQUEST['Prop']);
        if ( 0 < count($this->Model->VL->Get_Errors()) )
        {
            $this->View->Assign('Error_Validator', $this->Model->VL->Get_Errors());
            return $this->Set_Message('Error_Validate', 1);
        }

        // Save
        /// ///
        $sql = "SELECT COUNT(*) AS Cnt FROM Shop_Goods WHERE
            Directory_Color_ID = {$this->Model->Directory_Color_ID}
            AND `Directory_Packing_ID` = {$this->Model->Directory_Packing_ID}
            AND Shop_Wares_ID = {$this->Model->Shop_Wares_ID}";
        $row = Zero_DB::Select_Row($sql);
        if ( 0 < $row['Cnt'] )
        {
            return $this->Set_Message('Error_Exists', 1);
        }
        /// ///
        if ( 0 < $this->Model->ID )
        {
            if ( false == $this->Model->AR->Update() )
                return $this->Set_Message('Error_Save', 1);
        }
        else
        {
            if ( false == $this->Model->AR->Insert() )
                return $this->Set_Message('Error_Save', 1);

            //  When you add an object having a cross (many to many) relationship with the parent object
            if ( isset($this->Params['obj_parent_table']) )
            {
                //  target parent object
                $Object = Zero_Model::Make($this->Params['obj_parent_table'], $this->Params['obj_parent_id']);
                //  creating a connection
                if ( !$this->Model->AR->Insert_Cross($Object) )
                    return $this->Set_Message('Error_Save', 1);
            }
        }

        $this->Params['id'] = $this->Model->ID;
        //        $_GET['id'] = $this->Model->ID;

        //  Reset Cache
        $this->Model->Cache->Reset();

        return $this->Set_Message('Save', 0);
    }
}