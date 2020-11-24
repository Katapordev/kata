<?php
/**
 * @package     Mywalks.Site
 * @subpackage  com_mywalks
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Kata\Component\Katas\Site\View\Chusau;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

//use Joomla\CMS\Router\Route;



/**
 * Walks List View class
 *
 * @since  1.6
 */

class HtmlView extends BaseHtmlView

{

    /**
     * The item model state
     *
     * @var    \Joomla\Registry\Registry
     * @since  1.6.0
     */

    protected $state;

    /**
     * The item details
     *
     * @var    \JObject
     * @since  1.6.0
     */

    protected $items;

    /**
     * The pagination object
     *
     * @var    \JPagination
     * @since  1.6.0
     */

    protected $pagination;

    /**
     * The page parameters
     *
     * @var    \Joomla\Registry\Registry|null
     * @since  4.0.0
     */

    protected $params = null;

    /**
     * Method to display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  \Exception on failure, void on success.
     *
     * @since   1.6
     */

    public function display($tpl = null)

    {

        $app = Factory::getApplication();

        $params = $app->getParams();

        return parent::display($tpl);

    }

}

