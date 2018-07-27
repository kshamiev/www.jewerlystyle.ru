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
class Shop_Feedback_Page extends Zero_Controller
{
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
     * Vy`polnenie dei`stvii`
     *
     * @return Zero_View or string
     */
    public function Action_Send()
    {
        $this->Chunk_Init();
        $this->Chunk_Send();
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
        $this->View = new Zero_View(__CLASS__);
        $this->Model = Zero_Model::Make('Shop_Feedback');
        return true;
    }

    /**
     * Create views.
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_View()
    {
        $this->View->Assign('Feedback', $this->Model);
        return true;
    }

    /**
     * Some action.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Chunk_Send()
    {
        $this->Model->VL->Validate($_REQUEST['Feedback']);
        if ( 0 < count($this->Model->VL->Get_Errors()) )
        {
            $this->View->Assign('Error_Validator', $this->Model->VL->Get_Errors());
            return $this->Set_Message('Error_Validate', 1);
        }
        $this->Model->DateSend = "NOW()";
        $this->Model->AR->Insert();

        $subject = "Сообщение с сайта " . HTTP;
        $View = new Zero_View(get_class($this) . 'Mail');
        $View->Assign('Feedback', $this->Model);
        $message = $View->Fetch();
        Zero_Lib_Mail::Send($this->Model->Email, Zero_App::$Config->Site_Email, $subject, $message);

        $this->Model = Zero_Model::Make('Shop_Feedback');

        return $this->Set_Message("Feedback", 0);
    }


}
