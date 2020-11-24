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

class TazaController extends BaseController

{


	public function display($cachable = false, $urlparams = array())

	{

		return parent::display();

	}
	public function TazaRead()
	{
	    $data = json_decode(file_get_contents("php://input"));
		$db = Factory::getDbo();		
		$query = $db->getQuery(true)
		->select($db->quoteName(array('id', 'idCus', 'Phone', 'Name', 'Sanpham', 'Gia','Paid')))
		->from($db->quoteName('#__taza'))
		->order('idCus ASC')
		->setLimit($data->limit,$data->offset);
		$db->setQuery($query);
		$row = $db->loadObjectList();
		$outp = "";	
			foreach ($row as $row)
				{
				
				 if ($outp != "") {$outp .= ",";}  
						$outp .= '{"id":"'  . $row->id. '",'; 
						$outp .= '"idCus":"'.$row->idCus.'",'; 
						$outp .= '"Phone":"'.$row->Phone.'",'; 
						$outp .= '"Name":"'.$row->Name.'",'; 
						$outp .= '"Sanpham":"'.$row->Sanpham.'",';  
						$outp .= '"Gia":"'.$row->Gia.'",'; 
						$outp .= '"Paid":"'. $row->Paid.'"}'; 
				}
						$outp ='{"details":['.$outp.']}';
		  echo ($outp); 
		}
	
	public function TazaReadFN()
	{
	    $data = json_decode(file_get_contents("php://input"));
		$db = Factory::getDbo();		
		$query = $db->getQuery(true)
		->select($db->quoteName(array('id', 'idCus','Gia','Paid')))
		->from($db->quoteName('#__tazafn'))
		->order('idCus ASC')
		->setLimit($data->limit,$data->offset);
		$db->setQuery($query);
		$row = $db->loadObjectList();
		$outp = "";	
			foreach ($row as $row)
				{
				
				 if ($outp != "") {$outp .= ",";}  
						$outp .= '{"id":"'  . $row->id. '",'; 
						$outp .= '"idCus":"'.$row->idCus.'",';   
						$outp .= '"Gia":"'.$row->Gia.'",'; 
						$outp .= '"Paid":"'. $row->Paid.'"}'; 
				}
						$outp ='{"details":['.$outp.']}';
		  echo ($outp); 
		}
	
	public function TazaUpdate()
	{
	    $data = json_decode(file_get_contents("php://input"));
		/*32603*/
		/*5000*/
	for($i=32301;$i<=32900;$i++)
	{
		$flag=0;
		$gia=0;
		$paid=0;
		$db = Factory::getDbo();		
		$query = $db->getQuery(true)
		->select($db->quoteName(array('id', 'idCus', 'Phone', 'Name', 'Sanpham', 'Gia','Paid')))
		->from($db->quoteName('#__taza'))
		->order('idCus ASC');
		$db->setQuery($query);
		$row = $db->loadObjectList();
		  foreach ($row as $row)
				{

				   if($row->idCus==$i)
					{
								$flag=1;
								$gia+=$row->Gia;
								$paid+=$row->Paid;
					}

				}
		 if($flag==1)
				  {
							$db = Factory::getDbo();
							$profile = new \stdClass;
							$profile->idCus = $i;	
							$profile->Gia = $gia;
							$profile->Paid = $paid;			
							$result = $db->insertObject('#__tazafn', $profile);
				   }
		}
		echo $i;
		}	
	
	
	
//		public function QACreate()
//	
//		{
//		for ($i;$i<10;$i++)	
//		{
//			
//			
//		}
//	    date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $data = json_decode(file_get_contents("php://input"));
//		$dulieu = $data->dulieu;
//      $db = Factory::getDbo();
//		$profile = new \stdClass;
//		$profile->Cauhoi = $dulieu;
//		$result = $db->insertObject('#__taza_qa', $profile);	
//		$html .='{"id":"'.$result.'","mes":"'.$dulieu.' Đã Gửi Thành Công"}';		
//		}

}

