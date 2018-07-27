<?php

/**
 * Базовая работа с пользователем.
 *
 * @package Www.Users.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Feedback_Api extends Zero_Controller
{
    const EmailTo = 'info@jewerlystyle.ru;NP7663491@yandex.ru';

    /**
     * Управляющий метод (API).
     */
    public function Action_Default()
    {
        $this->View = new Zero_View();
        switch ( $_SERVER['REQUEST_METHOD'] )
        {
            case 'GET':
                break;
            case 'POST':
                $this->Post_Message();
                break;
            case 'PUT':
                break;
            case 'DELETE':
                break;
            case 'OPTIONS':
                break;
        }
        Zero_App::ResponseJson($_SERVER['REQUEST_METHOD'], 409, "Операция не определена");
    }

    /**
     * Восстановление реквизитов пользователя
     */
    protected function Post_Message()
    {
        // проверки
        if ( !isset($_POST['Message']) || !count($_POST['Message']) )
            Zero_App::ResponseJson("", 409, "Данные не получены");

        $Model = Zero_Model::Make('Shop_Feedback');
        $Model->VL->Validate($_POST['Message']);
        if ( 0 < count($Model->VL->Get_Errors()) )
            Zero_App::ResponseJson($Model->VL->Get_Errors(), 409, "Ошибка отправки", "Ошибка верификации");
        $Model->DateSend = "NOW()";
        $Model->AR->Insert();

        $subject = "Сообщение с сайта " . HTTP;
        $View = new Zero_View(get_class($this) . 'Mail');
        $View->Assign('Feedback', $Model);
        $message = $View->Fetch();
        Zero_Lib_Mail::Send($Model->Email, self::EmailTo, $subject, $message);

        Zero_Logs::Set_Message_Action("Обратная связь");

        Zero_App::ResponseJson("", 200, "Собщение отправлено");
    }
}
