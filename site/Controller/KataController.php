<?php

/**

 * @package     Mywalks.Site

 * @subpackage  com_mywalks

 *

 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.

 * @license     GNU General Public License version 2 or later; see LICENSE.txt

 */



namespace Kata\Component\Katas\Site\Controller;



defined('_JEXEC') or die;



use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;


/**

 * Mywalks Component Controller

 *

 * @since  1.5

 */

class KataController extends BaseController

{
	
		public function CSDLCreate()
			{
			$db = Factory::getDbo();
			$query = $db->getQuery(true);
			$query = "CREATE TABLE IF NOT EXISTS `#__chusau` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `idUser` int(11) NOT NULL,
		  `field1` text NOT NULL DEFAULT '0',
		  `field2` text NOT NULL DEFAULT '0',
		  `field3` text NOT NULL DEFAULT '0',
		  `field4` text NOT NULL DEFAULT '0',
		  `field5` text NOT NULL DEFAULT '0',
		  `field6` text NOT NULL DEFAULT '0',
		  `field7` text NOT NULL DEFAULT '0',
		  `field8` text NOT NULL DEFAULT '0',
		  `field9` text NOT NULL DEFAULT '0',
		  `field10` text NOT NULL DEFAULT '0',
		  `Ngaytao` datetime NOT NULL DEFAULT current_timestamp(),
		   PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
				 $db->setQuery($query);
				$result = $db->execute();
				print_r($result);
		}
	
	
		public function EditorCreate()
			{
			$data = json_decode(file_get_contents("php://input"));
			$dulieu = $data->dulieu;
			$user = Factory::getUser();
			$db = Factory::getDbo();
			$profile = new \stdClass;
			$profile->Ten = $dulieu->Ten;
			$profile->Noidung = $dulieu->Noidung;
			$result = $db->insertObject('#__kata', $profile);		
			}
	
	public function EditorRead()
	{
		$db = Factory::getDbo();		
		$query = $db->getQuery(true)
		->select($db->quoteName(array('id','Ten','Noidung','Ngaytao')))
		->from($db->quoteName('#__kata'))
		->order('id DESC');
		$db->setQuery($query);
		$row = $db->loadObjectList();
		$row = json_encode((array) $row);
		print_r($row);
		}	
	public function EditorUpdate()
		{
        $data = json_decode(file_get_contents("php://input"));
		$dulieu = $data->dulieu;
		$user = Factory::getUser();
		$db = Factory::getDbo();
		$profile = new \stdClass;
		$profile->id = $dulieu->id;
		$profile->Ten = $dulieu->Ten;
		$profile->Noidung = $dulieu->Noidung;		
		$result = $db->updateObject('#__kata', $profile, 'id');
		echo '{"loai":"info","noidung":"Đã Cập Nhật Dữ Liệu"}';
		}
	
	
		public function EditorDelete()

			{
			$data = json_decode(file_get_contents("php://input"));
			$dulieu = $data->dulieu;
				$db = Factory::getDbo();
				$query = $db->getQuery(true);
				$conditions = array($db->quoteName('id') . ' = ' . $db->quote($dulieu->id)
				);
				$query->delete($db->quoteName('#__kata'));
				$query->where($conditions);
				$db->setQuery($query);
				$result = $db->execute();
			}	
	

}

