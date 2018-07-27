<?php

/**
 * Model. Users.
 *
 * @package Www.Users.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * @property string $IsNews
 */
class Www_Users extends Zero_Users
{
    /**
     * Получение пользователей подписанных на рассылку
     *
     * @return array
     */
    public static function Get_Users_IsNews($listId = [])
    {
        if ( count($listId) )
        {
            $ids = implode(', ', $listId);
            $sql = "SELECT `Name`, Email FROM Zero_Users WHERE ID IN ({$ids})";
        }
        else
            $sql = "SELECT `Name`, Email FROM Zero_Users WHERE IsNews = 'yes'";
        return Zero_DB::Select_Array($sql);
    }

    /**
     * Валидация подписки.
     *
     * @param mixed $value value to check
     * @param string $scenario scenario validation
     * @return string
     */
    public function VL_IsNews($value, $scenario)
    {
        $this->IsNews = $value;
        Zero_Logs::Set_Message_Error($value);
        return '';
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
        return array_replace_recursive(parent::Config_Prop($Model), [
            'Address' => ['AliasDB' => 'z.Address', 'DB' => 'T', 'IsNull' => 'YES', 'Default' => '', 'Form' => 'Textarea'],
            'IsNews' => ['AliasDB' => 'z.IsNews', 'DB' => 'E', 'IsNull' => 'NO', 'Default' => 'yes', 'Form' => 'Radio'],
        ]);
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
        return array_replace_recursive(parent::Config_Filter($Model), [
            'Address' => ['Visible' => true],
            'IsNews' => ['Visible' => true],
        ]);
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
        return array_replace_recursive(parent::Config_Form($Model), [
            'Address' => [],
            'IsNews' => [],
        ]);
    }
}
