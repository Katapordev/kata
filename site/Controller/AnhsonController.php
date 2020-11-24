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

class AnhsonController extends BaseController

{
	
	public function AnhsonRead()
	{
		date_default_timezone_set("Asia/Ho_Chi_Minh");
	    $data = json_decode(file_get_contents("php://input"));
		$user = Factory::getUser();
		$admin = $user->authorise('core.admin');
		$db = Factory::getDbo();	
		$query = $db->getQuery(true);
		$query->select(array('a.id','a.idUser','a.Hoten','a.IP','a.Gmail','a.Info','a.SDT','a.Payoneer','a.Cauhoi','a.Bank','a.Ghichu','a.Trangthai','a.Ngaytao','b.name'))
		->from($db->quoteName('#__anhson', 'a'))
		->join('INNER', $db->quoteName('#__users', 'b') . ' ON ' . $db->quoteName('a.idUser') . ' = ' . $db->quoteName('b.id'))
		->order('id DESC');		
		
//		$query = $db->getQuery(true)
//		->select($db->quoteName(array('id','idUser','Hoten','IP','Gmail','Info','SDT','Payoneer','Cauhoi','Bank','Ghichu','Trangthai','Ngaytao')))
//		->from($db->quoteName('#__anhson'))
//		->order('id DESC');
		if($admin!=1)
		{
		$query->where($db->quoteName('idUser') . ' = ' . $db->quote($user->id));
		}
		//->setLimit($data->limit,$data->offset);
		$db->setQuery($query);
		$row = $db->loadObjectList();
		$outp = "";	
		 $profile = new \stdClass;
//			foreach ($row as $row)
//				{	
//				$user = Factory::getUser($row->idUser);
//				 if ($outp != "") {$outp .= ",";}  
//						$outp .= '{"id":"'.$row->id.'",';  
//						$outp .= '"Ten":"'.$user->name.'",'; 
//						$outp .= '"Hoten":"'.$row->Hoten.'",'; 
//						$outp .= '"IP":"'.$row->IP.'",';  
//						$outp .= '"GmailID":"'.$row->GmailID.'",'; 
//						$outp .= '"GmailPASS":"'.$row->GmailPASS.'",'; 
//						$outp .= '"Info":"'.$row->Info.'",'; 
//						$outp .= '"SDT":"'.$row->SDT.'",'; 
//						$outp .= '"PyoneerID":"'.$row->PyoneerID.'",'; 
//						$outp .= '"PyoneerPASS":"'.$row->PyoneerPASS.'",';  
//						$outp .= '"Bank":"'.$row->Bank.'",'; 
//						$outp .= '"Cauhoi1":"'.$row->Cauhoi1.'",'; 
//						$outp .= '"Cauhoi2":"'.$row->Cauhoi2.'",'; 
//						$outp .= '"Traloi1":"'.$row->Traloi1.'",'; 
//						$outp .= '"Trangthai":"'.$row->Trangthai.'",'; 
//						$outp .= '"Ngaytao":"'.date("d/m/y", strtotime($row->Ngaytao)).'",'; 
//						$outp .= '"Traloi2":"'. $row->Traloi2.'"}'; 
//				}
//						$outp ='{"details":['.$outp.']}';
//		  echo ($outp);
		$row = json_encode((array) $row);
		print_r($row);
			//print_r($user);
		}
		public function AnhsonCreate()
	
		{
			
        $data = json_decode(file_get_contents("php://input"));
		$dulieu = $data->dulieu;
		$user = Factory::getUser();
		$db = Factory::getDbo();
		$profile = new \stdClass;
		$profile->idUser = $user->id;
		$profile->Hoten = $dulieu->Hoten;
		$profile->IP = $dulieu->IP;
		$profile->Gmail = $dulieu->Gmail;
		$profile->Info =$dulieu->Info;
		$profile->SDT =$dulieu->SDT;		
		$profile->Payoneer =$dulieu->Payoneer;	
		$profile->Bank =$dulieu->Bank;
		$profile->Cauhoi =$dulieu->Cauhoi;	
		$profile->Ghichu =$dulieu->Ghichu;		
		$profile->Trangthai =$dulieu->Trangthai;	
		$result = $db->insertObject('#__anhson', $profile);		
		echo '{"loai":"success","noidung":"Đã Thêm Mới Dữ Liệu"}';	
		}
	
	public function AnhsonUpdate()
		{
        $data = json_decode(file_get_contents("php://input"));
		$dulieu = $data->dulieu;
		$user = Factory::getUser();
		$db = Factory::getDbo();
		$profile = new \stdClass;
		$profile->id = $dulieu->id;
		$profile->Hoten = $dulieu->Hoten;
		$profile->IP = $dulieu->IP;
		$profile->Gmail = $dulieu->Gmail;
		//$profile->GmailID = $dulieu->GmailID;
		//$profile->GmailPASS = $dulieu->GmailPASS;
		$profile->Info =$dulieu->Info;
		$profile->SDT =$dulieu->SDT;		
		$profile->Payoneer =$dulieu->Payoneer;
		//$profile->PyonnerID = $dulieu->PyonnerID;
		//$profile->PyonnerPASS = $dulieu->PyonnerPASS;
		$profile->Bank =$dulieu->Bank;
		$profile->Cauhoi = $dulieu->Cauhoi;
		//$profile->Cauhoi1 = $dulieu->Cauhoi1;
		//$profile->Traloi1 = $dulieu->Traloi1;
		//$profile->Cauhoi2 = $dulieu->Cauhoi2;
		//$profile->Traloi2 = $dulieu->Traloi2;
		$profile->Ghichu =$dulieu->Ghichu;		
		$profile->Trangthai =$dulieu->Trangthai;
		$result = $db->updateObject('#__anhson', $profile, 'id');
		echo '{"loai":"info","noidung":"Đã Cập Nhật Dữ Liệu"}';
		}
	
	
		public function AnhsonRemove()

			{
			$data = json_decode(file_get_contents("php://input"));
			$dulieu = $data->dulieu;
				$db = Factory::getDbo();
				$query = $db->getQuery(true);
				$conditions = array($db->quoteName('id') . ' = ' . $db->quote($dulieu)
				);

				$query->delete($db->quoteName('#__anhson'));
				$query->where($conditions);

				$db->setQuery($query);

				$result = $db->execute();
			echo '{"loai":"danger","noidung":"Đã Xóa Dữ Liệu"}';
			}	
	

}

