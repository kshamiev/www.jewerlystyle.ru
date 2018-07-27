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
class Www_Users_Api extends Zero_Controller
{
    //    const EmailTo = 'yatakaya78@mail.ru';
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
                $this->Chunk_GET();
                break;
            case 'POST':
                $this->Chunk_POST();
                break;
            case 'PUT':
                $this->Chunk_PUT();
                break;
            case 'DELETE':
                $this->Chunk_DELETE();
                break;
            case 'OPTIONS':
                $this->Chunk_OPTIONS();
                break;
        }
        Zero_App::ResponseJson($_SERVER['REQUEST_METHOD'], 409, "Метод запроса не определен");
    }

    /**
     * Получение (GET).
     *
     * Получение текущего пользователя.
     */
    protected function Chunk_GET()
    {
        $data = [
            'Users' => Zero_App::$Users->Get_Props()
        ];
        Zero_App::ResponseJson($data, 200, "Текущий пользователь");
    }

    /**
     * Добавление (POST).
     *
     * Регистрация пользователя
     */
    protected function Chunk_POST()
    {
        switch ( Zero_App::$Route->UrlSegment[2] )
        {
            case 'registration':
                $this->Post_Registration(); // Регистрация пользователя
                break;
        }
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Изменение (PUT).
     *
     * Авторизация пользователя
     * Выход пользователя
     * Профиль пользователя
     * Восстановление реквизитов пользователя
     */
    protected function Chunk_PUT()
    {
        switch ( Zero_App::$Route->UrlSegment[2] )
        {
            case 'login':
                $this->Put_Login(); // Авторизация пользователя
                break;
            case 'logout':
                $this->Put_Logout(); // Выход пользователя
                break;
            case 'profile':
                $this->Put_Profile(); // Профиль пользователя
                break;
            case 'reminder':
                $this->Put_Reminder(); // Восстановление реквизитов пользователя
                break;
        }
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Удаление (DELETE).
     */
    protected function Chunk_DELETE()
    {
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Получение опций (OPTIONS).
     */
    protected function Chunk_OPTIONS()
    {
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Восстановление реквизитов пользователя
     */
    protected function Put_Reminder()
    {
        // проверки
        if ( !isset($_POST['Users']) || !count($_POST['Users']) || !isset($_POST['Users']['Email']) )
            Zero_App::ResponseJson("", 409, "Данные не получены");

        $Model = Zero_Model::Make('Www_Users');
        $Model->VL->Validate($_POST['Users'], 'reminder');
        if ( 0 < count($Model->VL->Get_Errors()) )
            Zero_App::ResponseJson($Model->VL->Get_Errors(), 409, "Ошибка", "Ошибка верификации");

        $Model->AR->Sql_Where('Email', '=', $_POST['Users']['Email']);
        $Model->AR->Select('ID, Name, Login');

        $password = substr(md5(uniqid(mt_rand())), 0, 10);
        $Model->Password = md5($password);
        $Model->AR->Update();

        $subject = "Реквизиты доступа к сайту " . HTTP;
        $View = new Zero_View('Www_Users_ReminderMail');
        $View->Assign('Users', $Model);
        $View->Assign('password', $password);
        $message = $View->Fetch();
        Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, $Model->Email, $subject, $message);

        Zero_App::ResponseJson("", 200, "Реквизиты отправлены");
    }

    /**
     * Профиль пользователя
     */
    protected function Put_Profile()
    {
        // проверки
        if ( !isset($_POST['Users']) || !count($_POST['Users']) )
            Zero_App::ResponseJson($_POST, 409, "Данные не получены");

        if ( 0 == Zero_App::$Users->ID )
            Zero_App::ResponseJson("", 409, "Пользователь не авторизован");

        $Model = Zero_Model::Make('Www_Users', Zero_App::$Users->ID, true);
        $Model->VL->Validate($_POST['Users']);
        if ( 0 < count($Model->VL->Get_Errors()) )
            Zero_App::ResponseJson($Model->VL->Get_Errors(), 409, "Ошибка верификации");

        // сохранение
        $Model->AR->Update();
        Zero_App::$Users = $Model;
        Zero_App::$Users->Factory_Set();

        Zero_App::ResponseJson($_POST, 200, "Профиль изменен");
    }

    /**
     * Регистрация пользователя
     */
    protected function Post_Registration()
    {
        // проверки
        if ( !isset($_POST['Users']) || !count($_POST['Users']) || !isset($_POST['Users']['Keystring']) )
            Zero_App::ResponseJson("", 409, "Регистрационные данные не получены");

        $Model = Zero_Model::Make('Www_Users');
        $Model->VL->Validate($_POST['Users'], 'registration');

        if ( 0 < count($Model->VL->Get_Errors()) )
            Zero_App::ResponseJson($Model->VL->Get_Errors(), 409, "Ошибка регистрации", "Ошибка верификации");

        // сохранение
        $password = substr(md5(uniqid(mt_rand())), 0, 10);
        $Model->Password = md5($password);
        $Model->Zero_Groups_ID = 3;
        $Model->Date = date('Y-m-d H:i:s');
        $Model->AR->Insert();

        // письмо
        $subject = "Регистрация на сайте " . HTTP;
        $View = new Zero_View('Www_Users_RegistrationMail');
        $View->Assign('Users', $Model);
        $View->Assign('password', $password);
        $message = $View->Fetch();
        Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, $_POST['Users']['Email'], $subject, $message);
        Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, self::EmailTo, $subject, $message);

        $Model->Factory_Set();

        Zero_App::ResponseJson("", 200, "Успешная регистрация");
    }

    /**
     * Выход пользователя
     */
    protected function Put_Logout()
    {
        setcookie('i09u9Maf6l6sr7Um0m8A3u0r9i55m3il', null, null, '/');
        Zero_Session::Unset_Instance();
        session_unset();
        session_destroy();
        Zero_App::ResponseJson("/", 200, "Успешный выход");
    }

    /**
     * Авторизация пользователя
     */
    protected function Put_Login()
    {
        // Инициализация чанков
        if ( !isset($_POST['Login']) || !isset($_POST['Password']) || !$_POST['Login'] || !$_POST['Password'] )
            Zero_App::ResponseJson("", 409, "Логин или пароль не задан", "пустые входные значения");

        $Users = Zero_Model::Make('Www_Users');
        $Users->AR->Sql_Where('Login', '=', $_POST['Login']);
        $Users->AR->Select('*');

        //  Check
        if ( 0 == $Users->ID )
            Zero_App::ResponseJson("", 409, "Пользователь с данным логином не зарегистрирован");
        else if ( $Users->Password != md5($_POST['Password']) )
            Zero_App::ResponseJson("", 409, "Логин/Пароль не верен");
        else if ( !$Users->Zero_Groups_ID )
            Zero_App::ResponseJson("", 409, "Польщователь ни входит ни в одну группу");

        if ( isset($_POST['Memory']) && $_POST['Memory'] )
        {
            setcookie('i09u9Maf6l6sr7Um0m8A3u0r9i55m3il', $Users->ID, time() + 2592000, '/');
        }
        $url_history = Zero_App::$Users->UrlRedirect;

        Zero_App::$Users = $Users;
        Zero_App::$Users->Factory_Set();
        Zero_App::ResponseJson($url_history, 200, "Успешная авторизация");
    }
}
