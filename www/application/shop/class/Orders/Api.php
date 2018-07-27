<?php

/**
 * Работа с заказами.
 *
 * @package Shop.Orders.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Shop_Orders_Api extends Zero_Controller
{
    const EmailTo = 'orders@jewerlystyle.ru;NP7663491@yandex.ru';

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
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Добавление (POST).
     *
     * Оформление нового заказа пользователем
     */
    protected function Chunk_POST()
    {
        if ( Zero_App::$Users->ID == 0 )
            Zero_App::ResponseJson("", 409, "Необходимо зарегистрироваться или авторизоваться");

        $summa = Shop_Basket::DB_Get_Basket_Sum();
        if ( $summa['Cnt'] == 0 )
        {
            Zero_App::ResponseJson("", 409, "корзина пуста, оформлять нечего");
        }

        $num = 1;
        $result = [];
        $wares = Shop_Basket::DB_Get_Wares();
        foreach ($wares as $row)
        {
            $result[$num]['Name'] = $row['Name'];
            $result[$num]['Prices'] = $row['Prices'];
            $goods = Shop_Basket::DB_Get_Goods($row['ID']);
            foreach ($goods as $arr)
            {
                $result[$num]['Goods'][] = [
                    'Color' => $arr['Color'],
                    'Packing' => $arr['Packing'],
                    'CntBasket' => $arr['CntBasket'],
                    'Price' => $arr['Price'],
                    'SumBasket' => $arr['SumBasket'],
                ];
            }
            $num++;
        }

        Zero_Logs::Set_Message_Action("оформление заказа");

        $order_id = Shop_Orders::DB_Orders_Add($_POST);

        if ( 0 < $order_id )
        {
            $subject = "Оформление заказа № {$order_id} на сайте " . HTTP;
            $View = new Zero_View('Shop_Orders_Mail');
            $View->Assign('Users', Zero_App::$Users);
            $View->Assign('result', $result);
            $View->Assign('summa', $summa);
            $message = $View->Fetch();
            Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, Zero_App::$Users->Email, $subject, $message);
            // письмо магазину
            $message .= "Фио клиента: " . Zero_App::$Users->Name . "<br>\n";
            $message .= "Телефон клиента: " . Zero_App::$Users->Phone . "<br>\n";
            $message .= "Электронная почта клиента: " . Zero_App::$Users->Email . "<br>\n";
            $message .= "Адресс доставки: " . $_POST['Address'] . "<br>\n";
            $message .= "Комментарий заказа: " . $_POST['Comment'] . "<br>\n";
            Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, self::EmailTo, $subject, $message);
            Zero_Lib_Mail::Send(Zero_App::$Config->Site_Email, "konstantin@shamiev.ru", $subject, $message);
            Zero_App::ResponseJson("", 200, "Заказ оформлен. В ближайшее время с Вами свяжется наш Менеджер");
        }
        else
            Zero_App::ResponseJson("", 409, "Ошибка создание заказа");
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