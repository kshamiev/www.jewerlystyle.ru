<?php

/**
 * Model. Site Section.
 *
 * Section or page of the site. Determined on the of routing.
 * Object section contains all the information on the basis of the page:
 * - The main controller
 * - Controller action with regard to the rights of access
 * - Subsections with the rights of access
 * - Page Layout
 * - Visibility in the navigation
 * - Seo
 *
 * @package Zero.Section.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * <BEG_CONFIG_PROPERTY>
 * @property integer $Zero_Section_ID
 * @property string $Url
 * @property string $UrlThis
 * @property string $UrlRedirect
 * @property string $Layout
 * @property string $ContentType
 * @property string $Controller
 * @property string $IsAuthorized
 * @property string $IsVisible
 * @property string $IsEnable
 * @property integer $Sort
 * @property string $Name
 * @property string $Title
 * @property string $Keywords
 * @property string $Description
 * <END_CONFIG_PROPERTY>
 */
class Shop_Catalog extends Zero_Model
{
    /**
     * The table stores the objects this model
     *
     * @var string
     */
    protected $Source = 'Zero_Section';

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
            'ID' => ['AliasDB' => 'z.ID', 'DB' => 'I', 'IsNull' => 'NO', 'Default' => '', 'Form' => ''],
            'Zero_Section_ID' => ['AliasDB' => 'z.Zero_Section_ID', 'DB' => 'I', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Link'],
            'Url' => ['AliasDB' => 'z.Url', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'ReadOnly'],
            'UrlThis' => ['AliasDB' => 'z.UrlThis', 'DB' => 'T', 'IsNull' => 'NO', 'Default' => '', 'Form' => 'Text'],
            'UrlRedirect' => ['AliasDB' => 'z.UrlRedirect', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Text'],
            'Layout' => ['AliasDB' => 'z.Layout', 'DB' => 'T', 'IsNull' => 'NO', 'Default' => 'Www_Main', 'Form' => ''],
            'Controller' => ['AliasDB' => 'z.Controller', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Text'],
            'IsAuthorized' => ['AliasDB' => 'z.IsAuthorized', 'DB' => 'E', 'IsNull' => 'NO', 'Default' => 'no', 'Form' => 'Radio'],
            'IsVisible' => ['AliasDB' => 'z.IsVisible', 'DB' => 'E', 'IsNull' => 'NO', 'Default' => 'no', 'Form' => 'Radio'],
            'IsEnable' => ['AliasDB' => 'z.IsEnable', 'DB' => 'E', 'IsNull' => 'NO', 'Default' => 'yes', 'Form' => 'Radio'],
            'Sort' => ['AliasDB' => 'z.Sort', 'DB' => 'I', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Number'],
            'Name' => ['AliasDB' => 'z.Name', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Text'],
            'Title' => ['AliasDB' => 'z.Title', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Text'],
            'Keywords' => ['AliasDB' => 'z.Keywords', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Text'],
            'Description' => ['AliasDB' => 'z.Description', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Textarea'],
            'Content' => ['AliasDB' => 'z.Content', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Content'],
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
//            'ID' => [],
//            'Layout' => [],
//            'IsAuthorized' => [],
            'IsVisible' => ['Visible' => true],
            'IsEnable' => ['Visible' => true],
            'Name' => ['Visible' => true],
            'Title' => ['Visible' => true],
            'Keywords' => ['Visible' => true],
            'Description' => ['Visible' => true],
            'Sort' => ['Visible' => true],
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
            'Url' => [],
            'Sort' => [],
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
            'ID' => [],
            'Zero_Section_ID' => [],
            'Url' => [],
            'UrlThis' => [],
            'IsVisible' => [],
            'IsEnable' => [],
            'Sort' => [],
            'Name' => [],
            'Title' => [],
            'Keywords' => [],
            'Description' => [],
            'Content' => [],
        ];
    }

    /**
     * Url Section
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_UrlThis($value, $scenario)
    {
        if ( !$value )
            return 'Error_Prop';
        $this->UrlThis = Zero_Lib_String::Transliteration_Url($value);
        if ( 0 < $this->Zero_Section_ID )
        {
            $Object = Zero_Model::Make($this->Source, $this->Zero_Section_ID);
            $this->Url = rtrim($Object->Url, '/') . '/' . $this->UrlThis;
        }
        else
            $this->Url = $this->UrlThis . '/';
        return '';
    }
}