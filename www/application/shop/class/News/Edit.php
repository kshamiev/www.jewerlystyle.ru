<?php

/**
 * Controller. Контроллер изменения объекта
 *
 * @package Shop.News.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_News_Edit extends Zero_Crud_Edit
{
    /**
     * The table stores the objects handled by this controller.
     *
     * @var string
     */
    protected $ModelName = 'Shop_News';

    /**
     * Template view
     *
     * @var string
     */
    protected $Template = 'Zero_Crud_Edit';

    /**
     * Initialization of the stack chunks and input parameters
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_EmailSendMy()
    {
        $this->Chunk_Init();

        $data = Www_Users::Get_Users_IsNews([Zero_App::$Users->ID]);

        foreach ($data as $row)
        {
            // письмо
            $subject = $this->Model->Name;
            $View = new Zero_View('Shop_News_EmailSend');
            $View->Assign('User', $row['Name']);
            $View->Assign('Content', $this->Model->Content);
            $message = $View->Fetch();
            Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, $row['Email'], $subject, $message);
        }

        $this->Set_Message('Отправлено ' . count($data) . ' адресатам', 0);

        $this->Chunk_View();
        return $this->View;
    }

    /**
     * Initialization of the stack chunks and input parameters
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_EmailSend()
    {
        $this->Chunk_Init();

        $data = Www_Users::Get_Users_IsNews();

        foreach ($data as $row)
        {
            // письмо
            $subject = $this->Model->Name;
            $View = new Zero_View('Shop_News_EmailSend');
            $View->Assign('User', $row['Name']);
            $View->Assign('Content', $this->Model->Content);
            $message = $View->Fetch();
            Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, $row['Email'], $subject, $message);
        }

        $this->Set_Message('Отправлено ' . count($data) . ' адресатам', 0);

        $this->Chunk_View();
        return $this->View;
    }
}