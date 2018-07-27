<?php

/**
 * Работа с покупательской корзиной.
 *
 * @package Shop.Basket.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Basket_Api extends Zero_Controller
{
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
     */
    protected function Chunk_GET()
    {
        if ( "sum" == Zero_App::$Route->UrlSegment[2] )
        {
            Zero_App::ResponseJson(Shop_Basket::DB_Get_Basket_Sum(), 200, "");
        }
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Добавление (POST).
     */
    protected function Chunk_POST()
    {
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Изменение (PUT).
     *
     * Добавление, перерасчет, удаление продукции в корзине.
     */
    protected function Chunk_PUT()
    {
        if ( Zero_App::$Users->ID == 0 )
            Zero_App::ResponseJson("", 409, "Необходимо зарегистрироваться или авторизоваться");
        if ( !isset($_POST['Shop_Goods_ID']) || !$_POST['Shop_Goods_ID'] || !isset($_POST['Cnt']) )
            Zero_App::ResponseJson("", 409, "Данные не получены");

        Zero_Logs::Set_Message_Action("добавление продукции в корзину");

        $subj = Shop_Basket::DB_Set_Goods($_POST);
        if ( $subj == "" )
            if ( 0 < $_POST['Cnt'] )
                Zero_App::ResponseJson("", 200, "Позиция добавлена в корзину");
            else
                Zero_App::ResponseJson("", 200, "Позиция удалена из корзины");
        else
            Zero_App::ResponseJson("", 409, $subj);
    }

    /**
     * Удаление (DELETE).
     *
     * Удаление товара из корзины.
     * Сброс (очистка) корзины. Удаление всех товаров из корзины
     */
    protected function Chunk_DELETE()
    {
        if ( Zero_App::$Users->ID == 0 )
            Zero_App::ResponseJson("", 409, "Необходимо зарегистрироваться или авторизоваться");
        if ( isset(Zero_App::$Route->UrlSegment[2]) )
        {
            Zero_Logs::Set_Message_Action("удаление товара из корзины");
            $subj = Shop_Basket::DB_Rem_Wares(Zero_App::$Route->UrlSegment[2]);
            if ( $subj == "" )
                Zero_App::ResponseJson("", 200, "Товар удален из корзины");
            else
                Zero_App::ResponseJson("", 409, $subj);
        }
        else
        {
            Zero_Logs::Set_Message_Action("сброс всей корзины");
            $subj = Shop_Basket::DB_Rem_Wares();
            if ( $subj == "" )
                Zero_App::ResponseJson("", 200, "Корзина сброшена");
            else
                Zero_App::ResponseJson("", 409, $subj);
        }
    }

    /**
     * Получение опций (OPTIONS).
     */
    protected function Chunk_OPTIONS()
    {
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }
}