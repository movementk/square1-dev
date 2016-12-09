<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir.$configDir."/admin_check.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>:::아이비스안경원:::</title>
</head>
<body>
<?
foreach($_REQUEST as $KEY => $VALUES){
	if($KEY == "Content"){
		${$KEY} = get_text($VALUES);
		//echo $KEY." : ".${$KEY};
	} else {
		${$KEY} = preg_replace("/\"/", "&#034;", get_text($VALUES));
	}
}

$mode = $site_prefix."member";

$ZipCode = $ZipCode1."-".$ZipCode2;
$Address1 = $Address1;
$Address2 = $Address2;
$UserIP = $_SERVER["REMOTE_ADDR"];
$Email = $Email1."@".$Email2;
$Phone = $Phone1."-".$Phone2."-".$Phone3;
if($Phone=="--") $Phone = $phone1."-".$phone2."-".$phone3;
$Mobile = $Mobile1."-".$Mobile2."-".$Mobile3;
if($Mobile=="--") $Mobile = $mobile1."-".$mobile2."-".$mobile3;

$Flag="Y";
$sql_common = "EmailFlag = '$EmailFlag', mb_1 = '$mb_1', mb_2 = '$mb_2', mb_3 = '$mb_3', mb_4 = '$mb_4', mb_5 = '$mb_5', mb_6 = '$mb_6',";

switch($workType){
	case "D":
		$dsql = "delete from ".$mode." where idx=".$idx;
		$dresult = sql_query($dsql);
		$works = "삭제";
		break;
	case "I":
		$SQL = " insert into ".$mode." set
						UserID = '".$UserID."',
						UserName = '".$UserName."',
						Password = password('".$Password."'),
						NickName = '".$NickName."',
						Sex = '".$Sex."',
						UserIP = '".$UserIP."',
						BirthDay = '".$BirthDay."',
						Phone = '".$Phone."',
						Mobile = '".$Mobile."',
						Email = '".$Email."',
						ZipCode = '".$ZipCode."',
						Address1 = '".$Address1."',
						Address2 = '".$Address2."',
						Content = '".$Content."',
						Flag = 'Y',
						Point = '0',
						UseFlag = '".$UseFlag."',
						UserLevel = '".$UserLevel."',
						LoginIP = '".$UserIP."',
						LoginDate = ".time().",
						$sql_common
						JoinDate = ".strtotime(date("Y-m-d",time())).",
						JoinDateTime = ".time()." ";
		$Result = sql_query($SQL);

		$works = "입력";
		break;
	case "M":
		if(!empty($Password)) $sql_password = " Password = password('".$Password."'), ";
		$SQL = "update ".$mode." set 
							BirthDay = '$BirthDay',
							Sex = '$Sex',
							Phone = '$Phone',
							Mobile = '$Mobile',
							Email = '$Email',
							NickName = '$NickName',
							ZipCode = '$ZipCode',
							Address1 = '$Address1',
							Address2 = '$Address2',
							$sql_password
							$sql_common
							UseFlag = '$UseFlag'
						where UserID='".$UserID."' ";

		$Result = mysql_query($SQL);
		$works = "수정";
		break;
}



GetAlert("회원을 ".$works." 하였습니다",$URI);
?>
</body>
</html>