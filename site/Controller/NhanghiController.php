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

class NhanghiController extends BaseController

{


	public function display($cachable = false, $urlparams = array())

	{

		return parent::display();

	}
	public function phongRead()
	{
		$data = json_decode(file_get_contents("php://input"));
		$ChiNhanh = $data->ChiNhanh;
		$db = Factory::getDbo();
	    $query = $db->getQuery(true)
		->select($db->quoteName(array('id', 'TenSP', 'GiaSP1','GiaSP2','GiaSP3','GiaSP4','GiaSP5','image', 'TrangThaiSP','LoaiPhong','ChiNhanh','Ordering')))
		->from($db->quoteName('#__nhanghi_sp'))
		->where($db->quoteName('ChiNhanh') . ' = ' . $db->quote($ChiNhanh))
	    ->order('Ordering ASC');

			$db->setQuery($query);

			$row = $db->loadObjectList();
				$outp = ""; 
				foreach ($row as $row)
				{
				if ($outp != "") {$outp .= ",";}     
				$outp .= '{"id":"'  . $row->id. '",'; 
				$outp .= '"TenSP":"'  . $row->TenSP. '",';
				$outp .= '"GiaSP1":"'  . $row->GiaSP1. '",';
				$outp .= '"GiaSP2":"'  . $row->GiaSP2. '",';
				$outp .= '"GiaSP3":"'  . $row->GiaSP3. '",';
				$outp .= '"GiaSP4":"'  . $row->GiaSP4. '",';
				$outp .= '"GiaSP5":"'  . $row->GiaSP5. '",';
				$outp .= '"image":"'  . $row->image. '",';
				$outp .= '"TrangThaiSP":"'  . $row->TrangThaiSP. '",';
				$outp .= '"LoaiPhong":"'. $row->LoaiPhong  . '"}'; 
				}
				$outp ='{"details":['.$outp.']}'; ;
				echo($outp); 
	}
	
	public static function tenphong($id)
    {

        $db = Factory::getDbo();

		$query = $db->getQuery(true)

	->select($db->quoteName(array('id', 'TenSP', 'GiaSP1','GiaSP2','GiaSP3','GiaSP4','GiaSP5','image', 'TrangThaiSP','LoaiPhong')))

    ->from($db->quoteName('#__nhanghi_sp'))

  ->where($db->quoteName('id')." = ".$db->quote($id));

		$db->setQuery($query);

		$result = $db->loadRow();

		return $result;
    }  
	
	public static function hoadonRead()
	{
		$data = json_decode(file_get_contents("php://input"));
		//$trangthai   = $data->trangthai;
		$ChiNhanh = $data->ChiNhanh;
		$db = Factory::getDbo();
		$query = $db->getQuery(true)
            ->select($db->quoteName(array('a.id', 'a.idSP', 'a.GioVao','a.GioRa','a.NhanVien','a.KhachHang','a.TrangThaiHD','b.ChiNhanh')))
            ->from($db->quoteName('#__nhanghi_bill','a'))
			->join('INNER', $db->quoteName('#__nhanghi_sp', 'b') . ' ON ' . $db->quoteName('a.idSP') . ' = ' . $db->quoteName('b.id'))
			->where($db->quoteName('b.ChiNhanh') . ' = ' . $db->quote($ChiNhanh))
			->setLimit(500)
			->order('id DESC');
		$db->setQuery($query);	
		$row = $db->loadObjectList();
			$outp = ""; 
			foreach ($row as $row)
			{
			$tenphong = NhanghiController::tenphong($row->idSP);
		   $kqtinhtien = NhanghiController::tinhtien($row->GioVao,$row->GioRa,$tenphong[9],$tenphong[2],$tenphong[3],$tenphong[4],$tenphong[5],$tenphong[6]);
			if ($outp != "") {$outp .= ",";}     
			$outp .= '{"id":"'  . $row->id. '",'; 
			$outp .= '"idSP":"'  . $row->idSP. '",';
			$outp .= '"tenphong":"'  . $tenphong[1]. '",';
			$outp .= '"GioVao":"'  . $row->GioVao. '",';
			$outp .= '"GioRa":"'  . $row->GioRa. '",';
			$outp .= '"NhanVien":"'  . $row->NhanVien. '",';
			$outp .= '"TongTien":"'  . $kqtinhtien[0]. '",';
			$outp .= '"Ngay":"'  . $kqtinhtien[1]. '",';
			$outp .= '"Gio":"'  . $kqtinhtien[2]. '",';
			$outp .= '"Phut":"'  . $kqtinhtien[3]. '",';
			$outp .= '"TrangThai":"'  . $row->TrangThaiHD. '",';	
			$outp .= '"ChiNhanh":"'  . $row->ChiNhanh. '",';		
			$outp .= '"KhachHang":"'. $row->KhachHang  . '"}'; 
			}
			$outp ='{"details":['.$outp.']}'; ;
			echo($outp); 
	}
	
	
	public static function thanhtoan()
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');;
		$data = json_decode(file_get_contents("php://input"));
		$id   = $data->id;
		$idsp   = $data->idsp;
		$giora = date('Y/m/d H:i:s');
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->update($db->quoteName('#__nhanghi_bill'))
		->set(array($db->quoteName('TrangThaiHD') . ' = 1',$db->quoteName('GioRa') . ' ='.$db->quote($giora)))
		->where($db->quoteName('id') . ' = ' . $db->quote($id));
		$db->setQuery($query);
		$db->execute();
		$db1= Factory::getDbo();
		$query1 = $db1->getQuery(true);	
		$query1->update($db1->quoteName('#__nhanghi_sp'))->set($db1->quoteName('TrangThaiSP') . ' = 1')->where($db1->quoteName('id') . ' = ' . $db1->quote($idsp));
		$db1->setQuery($query1);
		$db1->execute();

	}	

	public static function ghibill()
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$input = Factory::getApplication()->input;
		$user = Factory::getUser();
		$NhanVien = $user->get('username');
		$data = json_decode(file_get_contents("php://input"));
		$tenkh   = $data->tenkh;
		$cmnd   = $data->cmnd;
		$sdt   = $data->sdt;
		$idsp   = $data->idsp;
		$giovao = date('Y/m/d H:i:s');
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$columns = array('idSP','GioVao','GioRa','NhanVien','KhachHang','CMND','SDT');
		$values = array($db->quote($idsp),$db->quote($giovao),$db->quote($giovao),$db->quote($NhanVien),$db->quote($tenkh),$db->quote($cmnd),$db->quote($sdt));
		$query->insert($db->quoteName('#__nhanghi_bill'))->columns($db->quoteName($columns))->values(implode(',', $values));
		$db->setQuery($query);
		$db->execute();	
		NhanghiController::trangthaiphong($idsp,0);
		return $tenkh ;

	}
	
	public static function trangthaiphong($idsp,$trangthaisp)
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->update($db->quoteName('#__nhanghi_sp'))->set($db->quoteName('TrangThaiSP') . ' = '.$db->quote($trangthaisp))->where($db->quoteName('id') . ' = ' . $db->quote($idsp));	 
		$db->setQuery($query);
		$db->execute();
		//return $result;

	}	
	
	
	public static function doithoigian($time)
	{
	$nam = floor($time / (365*60*60*24));
	$thang = floor(($time - $nam * 365*60*60*24) / (30*60*60*24));
	$ngay = floor(($time - $nam * 365*60*60*24 - $thang*30*60*60*24) / (60*60*24));
	$gio = floor(($time - $nam * 365*60*60*24 - $thang*30*60*60*24 - $ngay*60*60*24) / (60*60));
	$phut = floor(($time - $nam * 365*60*60*24 - $thang*30*60*60*24 - $ngay*60*60*24 - $gio*60*60) / 60);
	$giay = floor(($time - $nam * 365*60*60*24 - $thang*30*60*60*24 - $ngay*60*60*24 - $gio*60*60 - $phut*60));
	$thoigian = array($nam,$thang,$ngay,$gio,$phut,$giay);
	return $thoigian;
	}
	public static function phuthu($t,$loaisp)
	{
			if($t<15)
			{
				$phuthu=0;
			}
			else if($t>=15 && $t<75)

			{

				if($loaisp==1){$phuthu = 30000;}
				else if($loaisp==2 || $loaisp==3){$phuthu = 20000;}
				else {$phuthu = 10000;}

			}

			else if($t>=75 && $t<135)
			{
				if($loaisp==1){$phuthu = 50000;}
				else if($loaisp==2 || $loaisp==3){$phuthu = 40000;}
				else {$phuthu = 20000;}

			}

			else if($t>=135 && $t<195)

			{
				if($loaisp==1){$phuthu = 70000;}
				else if($loaisp==2 || $loaisp==3){$phuthu = 60000;}
				else {$phuthu = 30000;}

			}

			else if($t>=195 && $t<255)

			{

				if($loaisp==1){$phuthu = 90000;}
				else if($loaisp==2 || $loaisp==3){$phuthu = 80000;}
				else {$phuthu = 40000;}

			}

			else if($t>=255 && $t<315)

			{

				if($loaisp==1){$phuthu = 110000;}
				else if($loaisp==2 || $loaisp==3){$phuthu = 100000;}
				else {$phuthu = 50000;}

			}
			else if($t>=315 && $t<375)

			{

				if($loaisp==1){$phuthu = 130000;}
				else if($loaisp==2 || $loaisp==3){$phuthu = 120000;}
				else {$phuthu = 60000;}

			}
			else if($t>=375 && $t<435)

			{

				if($loaisp==1){$phuthu = 150000;}
				else if($loaisp==2 || $loaisp==3){$phuthu = 140000;}
				else {$phuthu = 70000;}

			}
			else

			{

				$phuthu=1;

			}

			return $phuthu;
	}
	public static function tinhtien($giovao,$giora,$loaisp,$gia1,$gia2,$gia3,$gia4,$gia5)
	{	
		$giot = 0;
		$phutt =0;
		$ngayt = 0;
		$ngaytt =0;
		$phuthu=0;
		$tongtien = 0;
		$giatt = 0;
		$Hvao = date("H",strtotime($giovao));
		$Hra = date("H",strtotime($giora));
		$dvao = date("d",strtotime($giovao));
		$mvao = date("m",strtotime($giovao));
		$Yvao = date("Y",strtotime($giovao));
		$time = (strtotime($giora)-strtotime($giovao));
		$thoigian = NhanghiController::doithoigian($time);
		$t=$thoigian[2]*24*60+$thoigian[3]*60+$thoigian[4];
			if($t<435)
			{
				if($t<75){
					$giatt = $gia1;
					$giot = $thoigian[3];
					$phutt = $thoigian[4];
					}
					else if ($t>=75 && $t<195)
					{
						$giatt = $gia2;			
						$giot = $thoigian[3];
						$phutt = $thoigian[4];		
					}
					else if ($t>=195 && $t<315)
					{
						$giatt = $gia3;			
						$giot = $thoigian[3];
						$phutt = $thoigian[4];		
					}
					else {
					$giatt = $gia4; 			
					$giot = $thoigian[3];
					$phutt = $thoigian[4];	
						}		
					$tongtien = $giatt;	
			}
			else if ($t>=435 && $t<869)
			{

					$tongtien = $gia5;	
					$giot = $thoigian[3];
					$phutt = $thoigian[4];
				
			}
			else 
			{
			 if($Hvao<11)
				{
					$newt = date_format(date_create($Yvao."-".$mvao."-".$dvao." 11:00:00"),"Y-m-d H:i:s");
					$time2 = strtotime($newt) - strtotime($giovao);
					$thoigian2 = NhanghiController::doithoigian($time2);
					$t2=$thoigian2[2]*24*60+$thoigian2[3]*60+$thoigian2[4];
					$phuthu1 = NhanghiController::phuthu($t2,$loaisp);
						if($phuthu1==1)
						{
							$ngaytt++;
							$ngayt++;
						}
						else
						{
							$phuthu = $phuthu1;
							$giot = $thoigian2[3];
							$phutt = $thoigian2[4];
						}
					$time3 = strtotime($giora)-strtotime($newt);
					$thoigian3 = NhanghiController::doithoigian($time3);
					$ngaytt=$ngaytt+$thoigian3[2];
					$t3=$thoigian3[3]*60+$thoigian3[4];
					$phuthu2 = NhanghiController::phuthu($t3,$loaisp);
						if($phuthu2==1)
						{
							$ngaytt++;
							$ngayt++;
						}
						else
						{
							$phuthu = $phuthu+$phuthu2;
							$giot = $giot + $thoigian3[3];
							$phutt = $thoigian3[4];
						}
						if($phuthu>$gia5)
						{
							$phuthu = $gia5;
						}
					$ngayt = $ngayt+$thoigian3[2];
					$tongtien = $ngaytt*$gia5 + $phuthu;
				}
				else
				{
							$dvao++;
							$newt = date_format(date_create($Yvao."-".$mvao."-".$dvao." 11:00:00"),"Y-m-d H:i:s");
							$time2 = strtotime($giora) - strtotime($newt);
							if($time2<0)
							{
								$ngaytt = 1;
								$ngayt = 1;
							}
							else
							{
							$ngaytt ++;
							$thoigian2 = NhanghiController::doithoigian($time2);
							$ngaytt=$ngaytt+$thoigian2[2];
							$t2=$thoigian2[3]*60+$thoigian2[4];
							$phuthu2 = NhanghiController::phuthu($t2,$loaisp);
								if($phuthu2==1)
								{
									$ngaytt++;
								}
								else
								{
									$phuthu = $phuthu2;
								}
							$ngayt = $ngaytt;
							$giot = $thoigian2[3];
							$phutt = $thoigian2[4];
							
							}
							$tongtien = $ngaytt*$gia5 + $phuthu;
					
				}
			}
			$kqtinhtien = array($tongtien,$ngayt,$giot,$phutt);
			return $kqtinhtien;
	}
	
	
	
	
	
}

