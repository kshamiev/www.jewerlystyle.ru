<?php

/**
 * Model. Users_Feedback.
 *
 * @package Users.Feedback.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * <BEG_CONFIG_PROPERTY>
 * @property string $Name
 * @property string $Message
 * @property string $Fio
 * @property string $Email
 * @property string $DateSend
 * <END_CONFIG_PROPERTY>
 */
class Shop_Feedback extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Shop_Feedback';

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
				'IsNull' => 'NO',
				'Default' => '',
				'Form' => 'Text',
			],
			'Message' => [
				'AliasDB' => 'z.Message',
				'DB' => 'T',
				'IsNull' => 'NO',
				'Default' => '',
				'Form' => 'Textarea',
			],
			'Fio' => [
				'AliasDB' => 'z.Fio',
				'DB' => 'T',
				'IsNull' => 'NO',
				'Default' => '',
				'Form' => 'Text',
			],
			'Email' => [
				'AliasDB' => 'z.Email',
				'DB' => 'T',
				'IsNull' => 'NO',
				'Default' => '',
				'Form' => 'Text',
			],
			'DateSend' => [
				'AliasDB' => 'z.DateSend',
				'DB' => 'D',
				'IsNull' => 'NO',
				'Default' => 'NOW',
				'Form' => 'DateTime',
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
			'Message' => ['Visible' => true],
			'Fio' => ['Visible' => true],
			'Email' => ['Visible' => true],
			'DateSend' => ['Visible' => true],
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
			'Fio' => [],
			'Email' => [],
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
			'Message' => [],
			'Fio' => [],
			'Email' => [],
			'DateSend' => [],
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
     * Validatciia e`lektronnogo pochtovogo adresa.
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_Email($value, $scenario)
    {
        if ( !preg_match(Zero_Validator::PATTERN_EMAIL, $value) )
            return 'Error_ValidEmail';
        $this->Email = $value;
        return '';
    }

    /**
     * Validatciia kontrol`noi` stroki.
     *
     * Zashchita ot botov
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_Keystring($value, $scenario)
    {
        if ( Zero_App::$Users->Keystring != $value )
            return 'Error_Keystring';
        return '';
    }

}