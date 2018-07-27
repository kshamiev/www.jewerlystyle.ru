<?php

/**
 * Model. Shop_News.
 *
 * @package Shop.News.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * <BEG_CONFIG_PROPERTY>
 * @property string $Name
 * @property string $Date
 * @property string $Description
 * @property string $Imgs
 * @property string $Content
 * <END_CONFIG_PROPERTY>
 */
class Shop_News extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Shop_News';


    /**
     * Товары согласно условиям
     *
     * @param Zero_Filter $filter Фильтр
     * @return int
     */
    public static function DB_Page(Zero_Filter $filter)
    {
        $sql = "
        SELECT
          z.ID,
          z.`Name`,
          z.`Date`,
          z.`Description`,
          z.`Imgs`
        FROM Shop_News AS z
        ORDER BY
          3 DESC
        LIMIT " . (($filter->Page - 1) * $filter->Page_Item) . ', ' . $filter->Page_Item . "
        ";
        return Zero_DB::Select_Array_Index($sql);
    }

    /**
     * Количество товаров согласно условиям
     *
     * @param Zero_Filter $filter Фильтр
     * @return int
     */
    public static function DB_Page_Count(Zero_Filter $filter)
    {
        $sql = "
        SELECT
          COUNT(*) AS Cnt
        FROM Shop_News
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
			'Name' => [
				'AliasDB' => 'z.Name',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Text',
			],
			'Date' => [
				'AliasDB' => 'z.Date',
				'DB' => 'D',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'DateTime',
			],
            'Description' => [
                'AliasDB' => 'z.Description',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Textarea',
            ],
            'Imgs' => [
                'AliasDB' => 'z.Imgs',
                'DB' => 'T',
                'IsNull' => 'YES',
                'Default' => '',
                'Form' => 'Img',
            ],
			'Content' => [
				'AliasDB' => 'z.Content',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Content',
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
			'Name' => ['Visible' => true],
			'Date' => ['Visible' => true],
            'Description' => ['Visible' => true],
			'Content' => ['Visible' => true],
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
			'Name' => [],
			'Date' => [],
            'Description' => [],
            'Imgs' => [],
			'Content' => [],
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
     * Sample. Direct query to the database
     *
     * @param mixed Any parameter
     * @return array
     */
    public static function DB_QueryNameSample($param)
    {
        return [];
    }

    /**
     * Формирование from запроса
     *
     * @param array $params параметры контроллера
     */
    public function DB_From($params)
    {
        $this->AR->Sql_From("FROM {$this->Source} as z");
    }

    /**
     * Формирование from запроса к крос таблице
     *
     * @param string $parent_table таблица связей
     * @param int $parent_id идентификатор родительской связи
     */
    public function DB_From_Cross($parent_table, $parent_id)
    {
        $link = $this->Model->Get_Config_Link();
        $link = $link[$parent_table];
        $sql = "FROM {$this->Source} as z
            INNER JOIN {$link['table_link']} as p ON p.{$link['prop_this']} = z.ID AND p.{$link['prop_target']} = $parent_id
        ";
        $this->AR->Sql_From($sql);
    }
}