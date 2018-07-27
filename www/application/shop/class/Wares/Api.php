<?php

/**
 * Работа с товаром.
 *
 * @package Shop.Wares.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Wares_Api extends Zero_Controller
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
     *
     * Получение продукции товара с учетом корзины
     */
    protected function Chunk_GET()
    {
        if ( !isset(Zero_App::$Route->UrlSegment[2]) )
            Zero_App::ResponseJson("", 409, "Входные параметры не заданы");
        $ware_id = intval(Zero_App::$Route->UrlSegment[2]);
        if ( 0 == $ware_id )
            Zero_App::ResponseJson("", 409, "Входные параметры не заданы");

        $data = [];
        if ( isset(Zero_App::$Route->UrlSegment[3]) )
        {
            $packing_id = intval(Zero_App::$Route->UrlSegment[3]);
            if ( 0 == $packing_id )
                Zero_App::ResponseJson("", 409, "Входные параметры не заданы");
            $data = Shop_Goods::DB_Get_GoodsPacking($ware_id, $packing_id);
        }
        else
        {
            $data = Shop_Goods::DB_Get_Goods($ware_id);
        }
        Zero_App::ResponseJson($data, 200, "");
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
     */
    protected function Chunk_PUT()
    {
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
}