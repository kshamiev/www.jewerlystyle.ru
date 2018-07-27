<?php

/**
 * Model. Shop_Wares.
 *
 * @package Shop.Wares.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * <BEG_CONFIG_PROPERTY>
 * @property integer $Zero_Section_ID
 * @property string $Name
 * @property string $Title
 * @property string $Keywords
 * @property string $Description
 * @property string $Content
 * <END_CONFIG_PROPERTY>
 */
class Shop_Wares extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Shop_Wares';

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
            'Zero_Section_ID' => [
                'AliasDB' => 'z.Zero_Section_ID',
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
            'Title' => [
                'AliasDB' => 'z.Title',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Text',
            ],
            'Keywords' => [
                'AliasDB' => 'z.Keywords',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Text',
            ],
            'Description' => [
                'AliasDB' => 'z.Description',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Textarea',
            ],
            'DescriptionSmall' => [
                'AliasDB' => 'z.DescriptionSmall',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Textarea',
            ],
            'Content' => [
                'AliasDB' => 'z.Content',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Content',
            ],
            'Imgs' => [
                'AliasDB' => 'z.Imgs',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Img',
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
            'Zero_Section_ID' => ['Visible' => true],
            'Name' => ['Visible' => true],
            'Title' => ['Visible' => true],
            'Keywords' => ['Visible' => true],
            'Description' => ['Visible' => true],
            'DescriptionSmall' => ['Visible' => true],
            'Content' => ['Visible' => true],
            'Imgs' => ['Visible' => true],
            'IsImg' => [
                'AliasDB' => 'swf.ID',
                'DB' => 'I',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Radio',
                'Visible' => true,
            ],
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
            'Title' => [],
            'Keywords' => [],
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
            'Zero_Section_ID' => [],
            'Name' => [],
            'Title' => [],
            'Keywords' => [],
            'Description' => [],
            'DescriptionSmall' => [],
            'Content' => [],
            'Imgs' => [],
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
        if ( !isset($data['Imgs']['X']) || !$data['Imgs']['X'] )
            $data['Imgs']['X'] = 100;
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
    public function FL_IsImg()
    {
        return ["IS NOT NULL"=>"с фото", "IS NULL"=>"без фото"];
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
     * Товары согласно условиям
     *
     * @param array $catIdList список идентификаторов каталогов
     * @param Zero_Filter $filter Фильтр
     * @return int
     */
    public static function DB_Page($catIdList, Zero_Filter $filter)
    {
        $sql = "
        SELECT
          z.ID,
          z.`Name`,
          z.`Title`,
          z.`Description`,
          z.`DescriptionSmall`,
          z.`Imgs`,
          MIN(g.`Price`) AS Price
        FROM Shop_Wares AS z
          LEFT JOIN `Shop_Goods` AS g ON g.`Shop_Wares_ID` = z.`ID`
        WHERE
          z.`Zero_Section_ID` IN (" . implode(', ', $catIdList) . ")
        GROUP BY
          1, 2, 3, 4, 5
        ORDER BY
          2
        LIMIT " . (($filter->Page - 1) * $filter->Page_Item) . ', ' . $filter->Page_Item . "
        ";
        return Zero_DB::Select_Array_Index($sql);
    }

    /**
     * Количество товаров согласно условиям
     *
     * @param array $catIdList список идентификаторов каталогов
     * @param Zero_Filter $filter Фильтр
     * @return int
     */
    public static function DB_Page_Count($catIdList, Zero_Filter $filter)
    {
        $sql = "
        SELECT
          COUNT(DISTINCT z.ID) AS Cnt
        FROM Shop_Wares AS z
        WHERE z.`Zero_Section_ID` IN (" . implode(', ', $catIdList) . ")
        ";
        $res = Zero_DB::Select_Row($sql);
        if ( isset($res['Cnt']) )
        {
            return $res['Cnt'];
        }
        else
        {
            return 0;
        }
    }

    /**
     * Товары согласно условиям
     *
     * @param string $search список идентификаторов каталогов
     * @param Zero_Filter $filter Фильтр
     * @return int
     */
    public static function DB_Page_Search($search, Zero_Filter $filter)
    {
        $search = Zero_DB::Escape_T('%' . $search . '%');
        $sql = "
        SELECT
          z.ID,
          z.`Name`,
          z.`Title`,
          z.`Description`,
          z.`DescriptionSmall`,
          z.`Imgs`,
          MIN(g.`Price`) AS Price
        FROM Shop_Wares AS z
          LEFT JOIN `Shop_Goods` AS g ON g.`Shop_Wares_ID` = z.`ID`
        WHERE
          z.`Name` LIKE " . $search . "
          OR z.`Title` LIKE " . $search . "
          OR z.`Keywords` LIKE " . $search . "
          OR z.`Description` LIKE " . $search . "
          OR z.`Content` LIKE " . $search . "
        GROUP BY
          1, 2, 3, 4, 5
        ORDER BY
          2
        LIMIT " . (($filter->Page - 1) * $filter->Page_Item) . ', ' . $filter->Page_Item . "
        ";
        return Zero_DB::Select_Array_Index($sql);
    }

    /**
     * Количество товаров согласно условиям
     *
     * @param string $search список идентификаторов каталогов
     * @param Zero_Filter $filter Фильтр
     * @return int
     */
    public static function DB_Page_Search_Count($search, Zero_Filter $filter)
    {
        $search = Zero_DB::Escape_T('%' . $search . '%');
        $sql = "
        SELECT
          COUNT(DISTINCT z.ID) AS Cnt
        FROM Shop_Wares AS z
        WHERE
          z.`Name` LIKE " . $search . "
          OR z.`Title` LIKE " . $search . "
          OR z.`Keywords` LIKE " . $search . "
          OR `Description` LIKE " . $search . "
          OR z.`Content` LIKE " . $search . "
        ";
        $res = Zero_DB::Select_Row($sql);
        if ( isset($res['Cnt']) )
        {
            return $res['Cnt'];
        }
        else
        {
            return 0;
        }
    }

    /**
     * Формирование from запроса
     */
    public function DB_From($params)
    {
        $Filter = Zero_Filter::Factory($this);
        if ( isset($Filter->Get_Filter()['IsImg']['Value']) && $Filter->Get_Filter()['IsImg']['Value'] )
        {
            $this->AR->Sql_From("FROM {$this->Source} as z
                LEFT JOIN Shop_WaresPhoto as swf ON z.ID = swf.Shop_Wares_ID
            ");
            $this->AR->Sql_Group('1, 2, 3, 4');
        }
        else
        {
            $this->AR->Sql_From("FROM {$this->Source} as z");
        }
    }

    /**
     * Получение фотографий товара
     *
     * @param int $ware_id
     * @return array
     */
    public static function DB_Get_Images($ware_id)
    {
        $sql = "SELECT * FROM `Shop_WaresPhoto` WHERE `Shop_Wares_ID` = {$ware_id}";
        return Zero_DB::Select_Array_Index($sql);
    }

    /**
     * Фильтр в админстративной части
     * В разделе товары
     *
     * @return array
     */
    public function FL_Zero_Section_ID()
    {
        $arr = [];
        $Section = Zero_Model::Make('Zero_Section', 1050);
        foreach ($Section->AR->Select_Tree('ID, Name') as $row)
        {
            $indent = '';
            for ($i = 1; $i < $row['Level']; $i++)
            {
                $indent .= '&nbsp;&nbsp;&nbsp;';
            }
            $arr[$row['ID']] = $indent . $row['Name'];
        }
        return $arr;
    }
}