<?php

/**
 * Controller. Register a new account.
 *
 * @package Zero.Users.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Www_Users_Registration extends Zero_Controller
{
    const EmailTo = 'info@jewerlystyle.ru;NP7663491@yandex.ru';

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
    public function Action_Registration()
    {
        $this->Chunk_Init();
        $this->Chunk_Registration();
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
        if ( 0 < Zero_App::$Users->ID ) {
            Zero_App::ResponseRedirect('/user/profile');
        }
        $this->Model = Zero_Model::Make('Www_Users');
        $this->View = new Zero_View(get_class($this));
        return true;
    }

    /**
     * Create views.
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_View()
    {
        $this->View->Assign('Users', $this->Model);
        return true;
    }

    /**
     * Register a new account.
     *
     * @return boolean flag stop execute of the next chunk
     */
    protected function Chunk_Registration()
    {
        $this->Model->VL->Validate($_REQUEST['Users'], 'registration');
        if ( 0 < count($this->Model->VL->Get_Errors()) )
        {
            $this->View->Assign('Error_Validator', $this->Model->VL->Get_Errors());
            return $this->Set_Message('Error_Validate', 1);
        }

        $password = substr(md5(uniqid(mt_rand())), 0, 10);
        $this->Model->Password = md5($password);
        $this->Model->Zero_Groups_ID = 3;
        $this->Model->AR->Insert();

        $subject = "Register on the site " . HTTP;
        $View = new Zero_View(get_class($this) . 'Mail');
        $View->Assign('Users', $this->Model);
        $View->Assign('password', $password);
        $message = $View->Fetch();
        Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, $_REQUEST['Users']['Email'], $subject, $message);
        Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, self::EmailTo, $subject, $message);

        $this->Model = Zero_Model::Make('Www_Users');

        return $this->Set_Message("Registration", 0);
    }
}
