<?php
namespace Joomla\Component\Kata\Administrator\Controller;
\defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Router\Route;
/**
 * Tags view class for the Tags package.
 *
 * @since  3.1
 */
class DisplayController extends BaseController
{
	/**
	 * The default view.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $default_view = 'kata';
	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
	 *
	 * @return  static|boolean   This object to support chaining or false on failure.
	 *
	 * @since   3.1
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$view   = $this->input->get('view', 'kata');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');
		parent::display();
		return $this;
	}
}