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

class Anhson2Controller extends BaseController

{
	
	public function FieldsRead()
	{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
	    $data = json_decode(file_get_contents("php://input"));
		$user = Factory::getUser();
		$admin = $user->authorise('core.admin');
		$db = Factory::getDbo();	
		$query = $db->getQuery(true);
		$query->select(array('a.id','a.idUser','a.field1','a.field2','a.field3','a.field4','a.field5','a.field6','a.field7','a.field8','a.field9','a.field10','a.Ngaytao','b.name'))
		->from($db->quoteName('#__anhson2', 'a'))
		->join('INNER', $db->quoteName('#__users', 'b') . ' ON ' . $db->quoteName('a.idUser') . ' = ' . $db->quoteName('b.id'))
		->order('id DESC');		
		if($admin!=1)
		{
		$query->where($db->quoteName('idUser') . ' = ' . $db->quote($user->id));
		}
		$db->setQuery($query);
		$row = $db->loadObjectList();
		$outp = "";	
		 $profile = new \stdClass;
		$row = json_encode((array) $row);
		print_r($row);
		}
		public function FieldsCreate()
	
		{
			
        $data = json_decode(file_get_contents("php://input"));
		$dulieu = $data->dulieu;
		$user = Factory::getUser();
		$db = Factory::getDbo();
		$profile = new \stdClass;
		$profile->idUser = $user->id;
		$profile->field1 =$dulieu->field1;				
		$profile->field2 = $dulieu->field2;
		$profile->field3= $dulieu->field3;
		$profile->field4 = $dulieu->field4;
		$profile->field5 =$dulieu->field5;
		$profile->field6 =$dulieu->field6;		
		$profile->field7 =$dulieu->field7;	
		$profile->field8 =$dulieu->field8;
		$profile->field9 =$dulieu->field9;	
		$profile->field10 =$dulieu->field10;		
		$result = $db->insertObject('#__anhson2', $profile);		
		echo '{"loai":"success","noidung":"Đã Thêm Mới Dữ Liệu"}';	
		}
	
	public function FieldsUpdate()
		{
        $data = json_decode(file_get_contents("php://input"));
		$dulieu = $data->dulieu;
		$user = Factory::getUser();
		$db = Factory::getDbo();
		$profile = new \stdClass;
		$profile->id = $dulieu->id;
		$profile->field1 =$dulieu->field1;				
		$profile->field2 = $dulieu->field2;
		$profile->field3= $dulieu->field3;
		$profile->field4 = $dulieu->field4;
		$profile->field5 =$dulieu->field5;
		$profile->field6 =$dulieu->field6;		
		$profile->field7 =$dulieu->field7;	
		$profile->field8 =$dulieu->field8;
		$profile->field9 =$dulieu->field9;	
		$profile->field10 =$dulieu->field10;
		$result = $db->updateObject('#__anhson2', $profile, 'id');
		echo '{"loai":"info","noidung":"Đã Cập Nhật Dữ Liệu"}';
		}
	
	
		public function FieldsRemove()

			{
			$data = json_decode(file_get_contents("php://input"));
			$dulieu = $data->dulieu;
				$db = Factory::getDbo();
				$query = $db->getQuery(true);
				$conditions = array($db->quoteName('id') . ' = ' . $db->quote($dulieu)
				);

				$query->delete($db->quoteName('#__anhson2'));
				$query->where($conditions);

				$db->setQuery($query);

				$result = $db->execute();
			echo '{"loai":"danger","noidung":"Đã Xóa Dữ Liệu"}';
			}	
	

}

