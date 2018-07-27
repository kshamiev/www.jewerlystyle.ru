<?php

/**
 * Model. Shop_Orders.
 *
 * @package Shop.Orders.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * <BEG_CONFIG_PROPERTY>
 * @property integer $Zero_Users_ID
 * @property string $Name
 * @property string $DateCreate
 * @property string $Address
 * @property string $Comment
 * @property string $Status
 * <END_CONFIG_PROPERTY>
 */
class Shop_Orders extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Shop_Orders';

    /**
     * Configuration model
     *
     * - 'Comment' => 'Comment'
     * - 'Language' => '0, 1'
     *
     * @param Zero_Model $Model The exact working model
     * @return array
     */
    protected static function Config_Model($Model)
    {
        return [
            /*BEG_CONFIG_MODEL*/
            'Language' => '0'
            /*END_CONFIG_MODEL*/
        ];
    }

    /**
     * Configuration links many to many
     *
     * - 'table_target' => ['table_link', 'prop_this', 'prop_target']
     *
     * @param Zero_Model $Model The exact working model
     * @return array
     */
    protected static function Config_Link($Model)
    {
        return [
            /*BEG_CONFIG_LINK*/
            /*END_CONFIG_LINK*/
        ];
    }

    /**
     * The configuration properties
     *
     * - 'DB'=> 'T, I, F, E, S, D, B'
     * - 'IsNull'=> 'YES, NO'
     * - 'Default'=> 'mixed'
     * - 'Value'=> [] 'Values ​​for Enum, Set'
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @return array
     */
    protected static function Config_Prop($Model)
    {
        return [
            /*BEG_CONFIG_PROP*/
            'ID' => [
                'AliasDB' => 'z.ID',
                'DB' => 'I',
                'IsNull' => 'NO',
                'Default' => '',
                'Form' => '',
            ],
            'Zero_Users_ID' => [
                'AliasDB' => 'z.Zero_Users_ID',
                'DB' => 'I',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Link',
            ],
            'Name' => [
                'AliasDB' => 'z.Name',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Text',
            ],
            'DateCreate' => [
                'AliasDB' => 'z.DateCreate',
                'DB' => 'D',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'DateTime',
            ],
            'Address' => [
                'AliasDB' => 'z.Address',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Textarea',
            ],
            'Comment' => [
                'AliasDB' => 'z.Comment',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Textarea',
            ],
            'Status' => [
                'AliasDB' => 'z.Status',
                'DB' => 'E',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Select',
            ],
            /*END_CONFIG_PROP*/
        ];
    }

    /**
     * Dynamic configuration properties for the filter
     *
     * - 'Filter'=> 'Select, Radio, Checkbox, DateTime, Link, LinkMore, Number, Text, Textarea, Content
     * - 'Search'=> 'Number, Text'
     * - 'Sort'=> false, true
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario
     * @return array
     */
    protected static function Config_Filter($Model, $scenario = '')
    {
        return [
            /*BEG_CONFIG_FILTER_PROP*/
            'ID' => ['Visible' => true],
            'Zero_Users_ID' => ['Visible' => true],
            'Name' => ['Visible' => true],
            'DateCreate' => ['Visible' => true],
            'Address' => ['Visible' => true],
            'Comment' => ['Visible' => true],
            'Status' => ['Visible' => true],
            /*END_CONFIG_FILTER_PROP*/
        ];
    }

    /**
     * Dynamic configuration properties for the Grid
     *
     * - 'Grid' = 'AliasName.PropName'
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario
     * @return array
     */
    protected static function Config_Grid($Model, $scenario = '')
    {
        return [
            /*BEG_CONFIG_GRID_PROP*/
            'ID' => [],
            'Name' => [],
            'DateCreate' => [],
            'Zero_Users_ID' => [],
            /*END_CONFIG_GRID_PROP*/
        ];
    }

    /**
     * Dynamic configuration properties for the form
     *
     * - 'Form'=> [
     *      Number, Text, Select, Radio, Checkbox, Textarea, Date, Time, DateTime, Link,
     *      Hidden, ReadOnly, Password, File, FileData, Img, ImgData, Content', LinkMore
     *      ]
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario forms
     * @return array
     */
    protected static function Config_Form($Model, $scenario = '')
    {
        return [
            /*BEG_CONFIG_FORM_PROP*/
            'ID' => [],
            'Zero_Users_ID' => [],
            'Name' => [],
            'DateCreate' => [],
            'Address' => [],
            'Comment' => [],
            'Status' => [],
            /*END_CONFIG_FORM_PROP*/
        ];
    }

    /**
     * Sample. The total initial validation properties
     *
     * @param array $data verifiable data array
     * @param string $scenario scenario validation
     * @return array
     */
    public function Validate_Before($data, $scenario)
    {
        return $data;
    }

    /**
     * Sample. The validation property
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function Validate_PropertyName($value, $scenario)
    {
        $this->PropertyName = $value;
        return '';
    }

    /**
     * Sample. Total final validation properties
     *
     * @param array $data verifiable data array
     * @param string $scenario scenario validation
     */
    public function Validate_After($data, $scenario)
    {
    }

    /**
     * Sample. Filter for property.
     *
     * @return array
     */
    public function FL_PropNameSample()
    {
        return [];
    }

    /**
     * Оформление нового заказа пользователем
     *
     * @param array $apiData информация о добавляемом товаре
     * @return int номер заказа
     */
    public static function DB_Orders_Add($apiData)
    {
        if ( !isset($apiData['Address']) || !isset($apiData['Comment']) )
        {
            Zero_Logs::Set_Message_Error("Данные не получены");
            return 0;
        }

        // создаем заказ
        $sql = "
        INSERT `Shop_Orders` SET
          `Zero_Users_ID` = " . Zero_App::$Users->ID . ",
          `DateCreate` = NOW(),
          `Address` = " . Zero_DB::Escape_T($apiData['Address']) . ",
          `Comment` = " . Zero_DB::Escape_T($apiData['Comment']) . "
        ";
        $order_id = Zero_DB::Insert($sql);
        if ( !$order_id )
        {
            Zero_Logs::Set_Message_Error("Ошибка создание заказа");
            return 0;
        }
        $sql = "UPDATE `Shop_Orders` SET `Name` = 'Заказ № {$order_id}' WHERE ID = {$order_id}";
        if ( false === Zero_DB::Update($sql) )
        {
            Zero_Logs::Set_Message_Error("Ошибка создание заказа");
            return 0;
        }

        // перекладываем товар из корзины в заказ
        $sql = "
        INSERT INTO `Shop_OrdersGoods`
            (
            `Shop_Orders_ID`,
            `Shop_Goods_ID`,
            `Name`,
            `Price`,
            `Cnt`
            )
        SELECT
            " . $order_id . ",
            `Shop_Goods_ID`,
            `Name`,
            `Price`,
            `Cnt`
        FROM `Shop_Basket`
        WHERE
            Zero_Users_ID = " . Zero_App::$Users->ID . "
        ";
        if ( false === Zero_DB::Update($sql) )
        {
            Zero_Logs::Set_Message_Error("Ошибка перемещения товара из корзины в заказ");
            return 0;
        }

        // очищаем корзину
        $sql = "DELETE FROM `Shop_Basket` WHERE `Zero_Users_ID` = " . Zero_App::$Users->ID;
        if ( false === Zero_DB::Update($sql) )
        {
            Zero_Logs::Set_Message_Error("Ошибка сброса корзины после формирования заказа");
            return 0;
        }
        return $order_id;
    }
}