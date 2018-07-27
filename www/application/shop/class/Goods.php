<?php

/**
 * Model. Shop_Goods.
 *
 * @package Shop.Goods.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * <BEG_CONFIG_PROPERTY>
 * @property integer $Directory_Color_ID
 * @property integer $Directory_Packing_ID
 * @property integer $Shop_Wares_ID
 * @property string $Name
 * @property float $Price
 * <END_CONFIG_PROPERTY>
 */
class Shop_Goods extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Shop_Goods';

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
            'Directory_Color_ID' => [
                'AliasDB' => 'z.Directory_Color_ID',
                'DB' => 'I',
                'IsNull' => 'NO',
                'Default' => '',
                'Form' => 'Link',
            ],
            'Directory_Packing_ID' => [
                'AliasDB' => 'z.Directory_Packing_ID',
                'DB' => 'I',
                'IsNull' => 'NO',
                'Default' => '',
                'Form' => 'Link',
            ],
            'Shop_Wares_ID' => [
                'AliasDB' => 'z.Shop_Wares_ID',
                'DB' => 'I',
                'IsNull' => 'NO',
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
            'Directory_Color_ID' => ['Visible' => true],
            'Directory_Packing_ID' => ['Visible' => true],
            'Shop_Wares_ID' => ['Visible' => true],
            'Name' => ['Visible' => true],
            'Price' => ['Visible' => true],
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
            'Price' => [],
            'Directory_Color_ID' => [],
            'Directory_Packing_ID' => [],
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
            'Directory_Color_ID' => [],
            'Directory_Packing_ID' => [],
            'Shop_Wares_ID' => [],
            'Name' => [],
            'Price' => [],
            /*END_CONFIG_FORM_PROP*/
        ];
    }

    /**
     * Получение продажных позиций товара (продукции)
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
          dc.`ID` AS ColorID,
          dp.`Name` AS Packing,
          dp.`ID` AS PackingID,
          sg.`ID` AS Shop_Goods_ID,
          sg.`Price`,
          sr.`Cnt` AS CntReserve,
          sb.`Cnt` AS CntBasket
        FROM `Shop_Goods` AS sg
          LEFT JOIN `Directory_Color` AS dc ON dc.`ID` = sg.`Directory_Color_ID`
          LEFT JOIN `Directory_Packing` AS dp ON dp.`ID` = sg.`Directory_Packing_ID`
          LEFT JOIN `Shop_Reserve` AS sr ON sr.`Shop_Goods_ID` = sg.`ID` AND sr.`Shop_Warehouse_ID` = {$wareHouseId}
          LEFT JOIN `Shop_Basket` AS sb ON sb.`Shop_Goods_ID` = sg.`ID` AND sb.`Shop_Warehouse_ID` = {$wareHouseId} AND sb.`Zero_Users_ID` = " . Zero_App::$Users->ID . "
        WHERE
          sg.`Shop_Wares_ID` = {$ware_id}
        ORDER BY
          dc.`Name`,
          dp.`Name`
        ";
        return Zero_DB::Select_Array($sql);
    }

    /**
     * Получение продажных позиций товара (продукции)
     *
     * @param int $ware_id
     * @param int $packing_id
     * @return array
     */
    public static function DB_Get_GoodsPacking($ware_id, $packing_id)
    {
        $wareHouseId = 1;
        $sql = "
        SELECT
          dc.`Name` AS Color,
          dc.`ID` AS ColorID,
          sg.`ID` AS Shop_Goods_ID,
          sg.`Price`,
          sr.`Cnt` AS CntReserve,
          sb.`Cnt` AS CntBasket
        FROM `Shop_Goods` AS sg
          LEFT JOIN `Directory_Color` AS dc ON dc.`ID` = sg.`Directory_Color_ID`
          LEFT JOIN `Directory_Packing` AS dp ON dp.`ID` = sg.`Directory_Packing_ID`
          LEFT JOIN `Shop_Reserve` AS sr ON sr.`Shop_Goods_ID` = sg.`ID` AND sr.`Shop_Warehouse_ID` = {$wareHouseId}
          LEFT JOIN `Shop_Basket` AS sb ON sb.`Shop_Goods_ID` = sg.`ID` AND sb.`Shop_Warehouse_ID` = {$wareHouseId} AND sb.`Zero_Users_ID` = " . Zero_App::$Users->ID . "
        WHERE
          sg.`Shop_Wares_ID` = {$ware_id}
          AND dp.ID = {$packing_id}
        ORDER BY
          dc.`Name`
        ";
        return Zero_DB::Select_Array($sql);
    }
}