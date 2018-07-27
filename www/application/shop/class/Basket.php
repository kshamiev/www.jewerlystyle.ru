<?php

/**
 * Model. Shop_Basket.
 *
 * @package Shop.Basket.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * <BEG_CONFIG_PROPERTY>
 * @property integer $Zero_Users_ID
 * @property integer $Shop_Goods_ID
 * @property string $Name
 * @property float $Price
 * @property integer $Cnt
 * <END_CONFIG_PROPERTY>
 */
class Shop_Basket extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Shop_Basket';

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
            'Shop_Goods_ID' => [
                'AliasDB' => 'z.Shop_Goods_ID',
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
            'Price' => [
                'AliasDB' => 'z.Price',
                'DB' => 'F',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Number',
            ],
            'Cnt' => [
                'AliasDB' => 'z.Cnt',
                'DB' => 'I',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Number',
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
            'Shop_Goods_ID' => ['Visible' => true],
            'Name' => ['Visible' => true],
            'Price' => ['Visible' => true],
            'Cnt' => ['Visible' => true],
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
            'Shop_Goods_ID' => [],
            'Name' => [],
            'Price' => [],
            'Cnt' => [],
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
     * Добавление, перерасчет, удаление продукции товара в корзине.
     *
     * @param array $apiData информация о добавляемом товаре
     * @return string сообщение об операции
     */
    public static function DB_Set_Goods($apiData)
    {
        $wareHouseId = 1;
        // читаем информацию о товаре на складе (в резерве)
        $sql = "
        SELECT
          r.Shop_Goods_ID, g.`Name`, r.`Cnt`, g.`Price`, r.Shop_Warehouse_ID
        FROM Shop_Reserve AS r
          INNER JOIN Shop_Goods AS g ON r.Shop_Goods_ID = g.ID AND r.Shop_Warehouse_ID = {$wareHouseId}
        WHERE
          g.ID = {$apiData['Shop_Goods_ID']}
        ORDER BY
          r.`Cnt` DESC
        LIMIT 0, 1;
        ";
        $row_reserve = Zero_DB::Select_Row($sql);
        if ( 0 == count($row_reserve) )
            return "Товар не найден на складе";

        // читаем информацию о продукции уже добавленном в корзину
        $sql = "
        SELECT
          ID,
          `Cnt`
        FROM Shop_Basket
        WHERE
            Zero_Users_ID = " . Zero_App::$Users->ID . "
            AND Shop_Warehouse_ID = {$row_reserve['Shop_Warehouse_ID']}
            AND Shop_Goods_ID = {$row_reserve['Shop_Goods_ID']}
        ";
        $row_basket = Zero_DB::Select_Row($sql);

        // добавляем продукцию в корзину
        if ( 0 == count($row_basket) )
        {
            if ( 0 == $apiData['Cnt'] ) // нечего добавлять
                return '';
            if ( $row_reserve['Cnt'] < $apiData['Cnt'] )
                return "Количество товара не достаточно на складе";
            $sql = "
            INSERT Shop_Basket SET
                Zero_Users_ID = " . Zero_App::$Users->ID . ",
                Shop_Warehouse_ID = {$row_reserve['Shop_Warehouse_ID']},
                Shop_Goods_ID = {$row_reserve['Shop_Goods_ID']},
                `Name` = " . Zero_DB::Escape_T($row_reserve['Name']) . ",
                Price = {$row_reserve['Price']},
                Cnt = {$apiData['Cnt']}
            ";
            if ( false == Zero_DB::Update($sql) )
                return "Ошибка добавлениет товара в корзину ";
            $goodsCntReserve = $row_reserve['Cnt'] - $apiData['Cnt'];
        }
        else
        {
            if ( $row_reserve['Cnt'] < $apiData['Cnt'] - $row_basket['Cnt'] )
                return "Количество товара не достаточно на складе";
            if ( 0 == $apiData['Cnt'] )
            {
                $sql = "DELETE FROM Shop_Basket WHERE ID = {$row_basket['ID']}";
            }
            else
            {
                $sql = "
                UPDATE Shop_Basket SET
                    Cnt = {$apiData['Cnt']}
                WHERE
                    ID = {$row_basket['ID']}
                ";
            }
            if ( false === Zero_DB::Update($sql) )
                return "Ошибка добавлениет товара в корзину ";
            $goodsCntReserve = $row_reserve['Cnt'] + ($row_basket['Cnt'] - $apiData['Cnt']);
        }

        // списываем со склада (с резерва)
        $sql = "UPDATE Shop_Reserve SET Cnt = {$goodsCntReserve} WHERE Shop_Goods_ID = {$row_reserve['Shop_Goods_ID']} AND Shop_Warehouse_ID = {$row_reserve['Shop_Warehouse_ID']}";
        if ( false === Zero_DB::Update($sql) )
            return "Ошибка списания товара со склада";
        //
        return "";
    }

    /**
     * Получение позиций товара (продукции) лежащих в корзине
     *
     * @param int $ware_id
     * @return array
     */
    public static function DB_Get_Goods($ware_id)
    {
        $wareHouseId = 1;
        $sql = "
        SELECT
          dc.`Name` AS Color,
          dp.`Name` AS Packing,
          sg.`ID` AS Shop_Goods_ID,
          sg.`Price`,
          sb.`Cnt` AS CntBasket,
          sg.`Price` * sb.`Cnt` AS SumBasket
        FROM `Shop_Goods` AS sg
          LEFT JOIN `Directory_Color` AS dc ON dc.`ID` = sg.`Directory_Color_ID`
          LEFT JOIN `Directory_Packing` AS dp ON dp.`ID` = sg.`Directory_Packing_ID`
          LEFT JOIN `Shop_Basket` AS sb ON sb.`Shop_Goods_ID` = sg.`ID` AND sb.`Shop_Warehouse_ID` = {$wareHouseId} AND sb.`Zero_Users_ID` = " . Zero_App::$Users->ID . "
        WHERE
          sg.`Shop_Wares_ID` = {$ware_id}
          AND sb.`Cnt` IS NOT NULL
        ORDER BY
          dc.`Name`,
          dp.`Name`
        ";
        return Zero_DB::Select_Array($sql);
    }


    /**
     * Получение суммы всей корзины и количества товаров в ней лежащих
     *
     * @return string сообщение об операции
     */
    public static function DB_Get_Basket_Sum()
    {
        $wareHouseId = 1;
        $sql = "
        SELECT
            COUNT(DISTINCT sw.ID) AS Cnt,
            SUM(sb.`Price` * sb.`Cnt`) AS Summa
        FROM Shop_Wares AS sw
            INNER JOIN `Shop_Goods` AS sg ON sg.`Shop_Wares_ID` = sw.`ID`
            INNER JOIN `Shop_Basket` AS sb ON sb.`Shop_Goods_ID` = sg.`ID`
        WHERE
            sb.`Zero_Users_ID` = " . Zero_App::$Users->ID . "
            AND sb.`Shop_Warehouse_ID` = {$wareHouseId}
        ";
        $row = Zero_DB::Select_Row($sql);
        $row['Summa'] *= 1;
        return $row;
    }

    /**
     * Получение товара лежащего в корзине.
     *
     * @return array товар лежащий в корзине и его сумма
     */
    public static function DB_Get_Wares()
    {
        $wareHouseId = 1;
        $sql = "
        SELECT
            sw.ID,
            sw.`Name`,
            sw.`Description`,
            sw.`Imgs`,
            SUM(sb.`Price` * sb.`Cnt`) AS Prices
        FROM Shop_Wares AS sw
            INNER JOIN `Shop_Goods` AS sg ON sg.`Shop_Wares_ID` = sw.`ID`
            INNER JOIN `Shop_Basket` AS sb ON sb.`Shop_Goods_ID` = sg.`ID`
        WHERE
            sb.`Zero_Users_ID` = " . Zero_App::$Users->ID . "
            AND sb.`Shop_Warehouse_ID` = {$wareHouseId}
        GROUP BY
            1, 2, 3, 4
        ORDER BY
            2
        ";
        return Zero_DB::Select_Array_Index($sql);
    }

    /**
     * Удаление товара из корзины.
     *
     * @param int $wares_id идентификатор товара. Если не указан очищается вся корзина
     * @return string сообщение об операции
     */
    public static function DB_Rem_Wares($wares_id = 0)
    {
        // читаем информацию о товаре добавленном в корзину
        $sql_where = "";
        if ( 0 < $wares_id )
            $sql_where = "AND g.`Shop_Wares_ID` = {$wares_id}";
        $sql = "
        SELECT
          b.ID,
          b.`Shop_Warehouse_ID`,
          b.`Shop_Goods_ID`,
          b.`Cnt`
        FROM Shop_Basket AS b
        INNER JOIN `Shop_Goods` AS g ON b.`Shop_Goods_ID` = g.`ID`
        WHERE
            b.`Zero_Users_ID` = " . Zero_App::$Users->ID . "
            {$sql_where}
        ";
        foreach (Zero_DB::Select_Array($sql) as $row)
        {
            // кладем обратно в резерв на склад
            $sql = "UPDATE Shop_Reserve SET Cnt = Cnt + {$row['Cnt']} WHERE Shop_Goods_ID = {$row['Shop_Goods_ID']} AND Shop_Warehouse_ID = {$row['Shop_Warehouse_ID']}";
            if ( false !== Zero_DB::Update($sql) )
            {
                // удаляем из корзины
                $sql = "DELETE FROM Shop_Basket WHERE ID = {$row['ID']}";
                Zero_DB::Update($sql);
            }
        }
        return "";
    }

    /**
     * Сброс корзины.
     *
     * @return string сообщение об операции
     */
//    public static function DB_Clear()
//    {
//        // удаляем из корзины
//        $sql = "DELETE FROM Shop_Basket WHERE  Zero_Users_ID = " . Zero_App::$Users->ID;
//        Zero_DB::Update($sql);
//        return "";
//    }
}

/*
$sql = "
        INSERT Shop_Basket SET
            Zero_Users_ID = " . Zero_App::$Users->ID . ",
            Shop_Warehouse_ID = 1,
            Shop_Goods_ID = {$row['ID']},
            `Name` = " . Zero_DB::Escape_T($row['Name']) . ",
            Price = {$row['Price']},
            Cnt = {$row['Cnt']}
        ON DUPLICATE KEY UPDATE
            Zero_Users_ID = " . Zero_App::$Users->ID . ",
            Shop_Warehouse_ID = 1,
            Shop_Goods_ID = {$row['ID']},
            `Name` = " . Zero_DB::Escape_T($row['Name']) . ",
            Price = {$row['Price']},
            Cnt = {$row['Cnt']}
        ";
if ( false == Zero_DB::Update($sql) )
    return "Ошибка добавлениет товара в корзину";
*/