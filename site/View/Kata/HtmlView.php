<?php
namespace Kata\Component\Kata\Site\View\Kata;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

//use Joomla\CMS\HTML\HTMLHelper;
//use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

//use Joomla\CMS\Router\Route;
class HtmlView extends BaseHtmlView

{
    protected $state;

    protected $items;

    protected $pagination;

    protected $params = null;

    public function display($tpl = null)

    {

        $app = Factory::getApplication();

        $params = $app->getParams();

        return parent::display($tpl);

    }

}

