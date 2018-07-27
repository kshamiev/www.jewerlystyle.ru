<?php

/**
 * Model. Shop_GoodsPhoto.
 *
 * @package Shop.GoodsPhoto.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * <BEG_CONFIG_PROPERTY>
 * @property integer $Shop_Wares_ID
 * @property string $Name
 * @property string $Imgs
 * @property string $Imgb
 * <END_CONFIG_PROPERTY>
 */
class Shop_WaresPhoto extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Shop_WaresPhoto';

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
			'Imgs' => [
				'AliasDB' => 'z.Imgs',
				'DB' => 'T',
				'IsNull' => 'YES',
				'Default' => '',
				'Form' => 'Img',
			],
			'Imgb' => [
				'AliasDB' => 'z.Imgb',
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
			'Shop_Wares_ID' => ['Visible' => true],
			'Name' => ['Visible' => true],
			'Imgs' => ['Visible' => true],
			'Imgb' => ['Visible' => true],
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
			'Shop_Wares_ID' => [],
			'Name' => [],
			'Imgs' => [],
			'Imgb' => [],
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
        if ( !isset($data['Imgb']['X']) || !$data['Imgb']['X'] )
            $data['Imgb']['X'] = 600;
        return $data;
    }
}