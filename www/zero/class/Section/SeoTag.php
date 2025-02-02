<?php

/**
 * Controller. Output meta tags.
 *
 * {plugin "Zero_Section_SeoTag" view="Zero_Section_SeoTag"}
 *
 * @package Zero.Section.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Zero_Section_SeoTag extends Zero_Controller
{
    /**
     * Create views meta tags.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Default()
    {
        $seo_data = [
            'Title' => Zero_App::Get_Variable('Title'),
            'Description' => Zero_App::Get_Variable('Description'),
            'Keywords' => Zero_App::Get_Variable('Keywords'),
        ];
        if ( !$seo_data['Title'] )
        {
            $seo_data['Title'] = Zero_App::$Section->Title;
        }
        if ( !$seo_data['Description'] )
        {
            $seo_data['Description'] = Zero_App::$Section->Description;
        }
        if ( !$seo_data['Keywords'] )
        {
            $seo_data['Keywords'] = Zero_App::$Section->Keywords;
        }
        if ( isset($this->Params['view']) )
            $this->View = new Zero_View($this->Params['view']);
        else
            $this->View = new Zero_View(get_class($this));
        $this->View->Assign('seo_data', $seo_data);
        if ( Zero_App::$Section->IsIndex == 'no' )
        {
            $this->View->Assign('seo_index', '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">' . "\n");
        }
        else
        {
            $this->View->Assign('seo_index', '');
        }
        return $this->View;
    }
}