<?php
namespace Joomla\Component\Kata\Administrator\Controller;
defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
class KataController extends AdminController
{
	public function CreateTable()
	{
		$data = json_decode(file_get_contents("php://input"));
        $dulieu = $data->dulieu;
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query = $dulieu;
		$db->setQuery($query);
		$result = $db->execute();
		print_r($result);
	}
	public function getModel($name = 'Kata', $prefix = 'Administrator', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
	public function rebuild()
	{
		$this->checkToken();
		$this->setRedirect(Route::_('index.php?option=com_kata&view=kata', false));
		$model = $this->getModel();
		if ($model->rebuild())
		{
			// Rebuild succeeded.
			$this->setMessage(Text::_('COM_TAGS_REBUILD_SUCCESS'));
			return true;
		}
		else
		{
			// Rebuild failed.
			$this->setMessage(Text::_('COM_TAGS_REBUILD_FAILURE'));
			return false;
		}
	}
}
