<?php

/**
 * Controller. Management of access rights.
 *
 * @package Zero.Groups.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Zero_Groups_Access extends Zero_Controller
{
    /**
     * The table stores the objects handled by this controller.
     *
     * @var string
     */
    protected $ModelName = 'Zero_Groups';

    /**
     * Template view
     *
     * @var string
     */
    protected $Template = __CLASS__;

    /**
     * Vy`polnenie dei`stvii`
     *
     * @return Zero_View or string
     */
    public function Action_Default()
    {
        $this->Chunk_Init();
        $this->Chunk_View();
        return $this->View;
    }

    /**
     * Preservation of the rights of access
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Save()
    {
        $this->Chunk_Init();
        $this->Chunk_Save();
        $this->Chunk_View();
        return $this->View;
    }

    /**
     * Copying permissions
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Copy()
    {
        $this->Chunk_Init();
        $this->Chunk_Copy();
        $this->Chunk_View();
        return $this->View;
    }

    /**
     * Initialization of the stack chunks and input parameters
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Init()
    {
        $this->Params['obj_parent_prop'] = 'Zero_Groups_ID';
        $this->Params['obj_parent_name'] = '';
        if ( isset($_GET['pid']) )
            $this->Params['obj_parent_id'] = $_GET['pid'];
        else if ( empty($this->Params['obj_parent_id']) )
            $this->Params['obj_parent_id'] = 0;
        $this->View = new Zero_View($this->Template);
        $this->Model = Zero_Model::Make($this->ModelName);
    }

    /**
     * Create views.
     *
     * @throws Exception
     */
    protected function Chunk_View()
    {
        $Section = Zero_Model::Make('Zero_Section');
        $Section->AR->Sql_Where_IsNotNull('Controller');
        $section_list = $Section->AR->Select_Tree('ID, Name, Controller, Url, IsAuthorized');
        foreach ($section_list as $id => $row)
        {
            if ( 'no' == $row['IsAuthorized'] )
            {
                unset($section_list[$id]);
                continue;
            }
            //  read from the controllers
            $method_list = [];
            try
            {
                $reflection = new ReflectionClass($row['Controller']);
            } catch ( Exception $e )
            {
                throw new Exception($e->getMessage(), 409);
            }
            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
            {
                $name = $method->getName();
                if ( 'Action_Default' == $name )
                    continue;
                if ( 'Action' == substr($name, 0, 6) )
                {
                    $index = str_replace('Action_', '', $name);
//                    $index = "controller {$row['Controller']} action {$name}";
                    $method_list[$index] = Zero_I18n::Controller($row['Controller'], $name);
                }
            }
            $section_list[$id]['action_list_all'] = $method_list;
            $section_list[$id]['action_list_all_count'] = count($method_list) + 1;

            $Action = Zero_Model::Make('Zero_Action');
            $Action->AR->Sql_Where('Zero_Section_ID', '=', $id);
            $Action->AR->Sql_Where('Zero_Groups_ID', '=', $this->Params['obj_parent_id']);
            $Action->AR->Sql_Order('Action', 'ASC');
            $action_list = $Action->AR->Select_Array_Index('Action');
            $section_list[$id]['action_list'] = $action_list;
        }

        $this->View->Assign('Section', Zero_App::$Section);
        $this->View->Assign('section_list', $section_list);
        $this->View->Assign('Params', $this->Params);

        $groups_list = Zero_DB::Select_List_Index("SELECT ID, Name FROM Zero_Groups WHERE ID != {$this->Params['obj_parent_id']} ORDER BY Name ASC");
        $this->View->Assign('groups_list', $groups_list);
        $this->View->Assign('pid', $this->Params['obj_parent_id']);
        $this->View->Assign('Action', Zero_App::$Section->Get_Action_List());
    }

    /**
     * Preservation of the rights of access
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Save()
    {
        foreach ($_REQUEST['RoleAccessSection'] as $section_id => $access)
        {
            Zero_DB::Update("DELETE FROM Zero_Action WHERE Zero_Groups_ID = {$this->Params['obj_parent_id']} AND Zero_Section_ID = {$section_id}");
            //  Access to the section for the group
            if ( 'access' == $access )
            {
                $Action = Zero_Model::Make('Zero_Action');
                $Action->Zero_Section_ID = $section_id;
                $Action->Zero_Groups_ID = $this->Params['obj_parent_id'];
                $Action->Action = 'Default';
                $Action->AR->Insert();
            }
            else
                continue;
            //  access to the controller actions
            if ( isset($_REQUEST['RoleAccessAction'][$section_id]) )
            {
                foreach ($_REQUEST['RoleAccessAction'][$section_id] as $action => $panel)
                {
                    if ( 'access' == $panel )
                    {
                        $Action = Zero_Model::Make('Zero_Action');
                        $Action->Zero_Section_ID = $section_id;
                        $Action->Zero_Groups_ID = $this->Params['obj_parent_id'];
                        $Action->Action = $action;
                        $Action->AR->Insert();
                    }
                }
            }
        }
        //  Reset Cache
        $Model = Zero_Model::Make('Zero_Groups', $this->Params['obj_parent_id']);
        $Model->Cache->Reset();
        return $this->Set_Message('RoleAccess', 0);
    }

    /**
     * Copying permissions
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Copy()
    {
        Zero_DB::Update("DELETE FROM Zero_Action WHERE Zero_Groups_ID = {$_REQUEST['obj_id']}");
        $sql = "
        INSERT INTO `Zero_Action`
          (
          `Zero_Section_ID`,
          `Zero_Groups_ID`,
          `Action`
        ) SELECT
          `Zero_Section_ID`,
          {$_REQUEST['obj_id']},
          `Action`
        FROM `Zero_Action`
        WHERE
          `Zero_Groups_ID` = {$this->Params['obj_parent_id']}
        ";
        Zero_DB::Update($sql);
        return $this->Set_Message('AccessCopy', 0);
    }
}