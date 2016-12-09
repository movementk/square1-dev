<?
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";

if(!$URI || $URI=="/") $URI = '';
if(!$is_admin){
	$admin_id = $admin_id;
	$admin_pwd = sql_password($admin_pwd);
	
	$mode = $site_prefix."admin";

	$sql = "select * from $mode where admin_id='".$admin_id."'";
	$row = sql_fetch($sql);
	$count = count($row["admin_idx"]);
	if(!$count){
		GetAlert("존재하지 않는 아이디입니다.","BACK");
		exit;
	}
	
	if($admin_pwd != $row["admin_pwd"]){
		GetAlert("비밀번호가 맞지 않습니다.","BACK");
		exit;
	} else {
		setcookie("MemberIdx","", 0, '/');
		setcookie("MemberID","", 0, '/');
		setcookie("MemberName","", 0, '/');
		setcookie("MemberEmail","", 0, '/');
		setcookie("MemberBarCode","", 0, '/');
		setcookie("MemberLevel","", 0, '/');
		
		setcookie("admin_idx2", "",0, "/");
		setcookie("admin_id2", "",0, "/");
		setcookie("admin_email2", "",0, "/");
		setcookie("admin_name2", "",0, "/");
		setcookie("admin_level2", "",0, "/");
		
		setcookie("admin_idx2",$row["admin_idx"],0,'/');
		setcookie("admin_id2",$row["admin_id"],0,'/');
		setcookie("admin_email2",$row["admin_email"],0,'/');
		setcookie("admin_name2",$row["admin_name"],0,'/');
		setcookie("admin_level2",$row["admin_level"],0,'/');
		
		setcookie("MemberID",$row["admin_id"], 0, '/');
		setcookie("MemberName",$row["admin_name"], 0, '/');
		setcookie("MemberLevel",$row["admin_level"], 0, '/');
		setcookie("MemberEmail",$row["admin_email"],0,'/');

		$isql = " update ".$site_prefix."admin set logindate = now(), lastlogin = '".$row["logindate"]."' where admin_id = '".$admin_id."' ";
		$iresult = sql_query($isql);

		header("location:/board/admn/main.php".$URI);
	}
}else{
	setcookie("admin_idx2", "",0, "/");
	setcookie("admin_id2", "",0, "/");
	setcookie("admin_email2", "",0, "/");
	setcookie("admin_name2", "",0, "/");
	setcookie("admin_level2", "",0, "/");

	setcookie("MemberIdx","", 0, '/');
	setcookie("MemberID","", 0, '/');
	setcookie("MemberName","", 0, '/');
	setcookie("MemberEmail","", 0, '/');
	setcookie("MemberBarCode","", 0, '/');
	setcookie("MemberLevel","", 0, '/');

	header("location:/board/admn/index.php");
}
?>