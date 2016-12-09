<?
include $_SERVER['DOCUMENT_ROOT'].$loc."/board/config/use_db.php";
include $dir."/config/common_top.php";

foreach($_REQUEST as $KEY => $VALUES){
	if($KEY == "Content" || $KEY == "Etc1"){
		${$KEY} = get_text($VALUES);
		//echo $KEY." : ".${$KEY};
	} else {
		${$KEY} = preg_replace("/\"/", "&#034;", get_text($VALUES));
	}
}

$file_num = 1;

$UserIP = $_SERVER["REMOTE_ADDR"];
if(!$Email) $Email = $Email1."@".$Email2;
$Phone = $Phone1."-".$Phone2."-".$Phone3;
if($Phone=="--") $Phone = $phone1."-".$phone2."-".$phone3;

$Mobile = $Mobile1."-".$Mobile2."-".$Mobile3;
if($Mobile=="--") $Mobile = $mobile1."-".$mobile2."-".$mobile3;

$ZipCode = $ZipCode1."-".$ZipCode2;

$BirthDay = strtotime($_POST["BirthDay"]);

$Password = $Password1;

$Flag="Y";
/*
$sql_common = "
			AddressType = '$AddressType', ";
*/
if($method=="modify" &&  $user['ID']){

	$pw_row2 = get_member($user["ID"]);

	$old_couponid = $pw_row2["couponid"];

	if($NPassword1 != ""){
		$pwd1 = sql_password($Password);
		if($pwd1 == $pw_row2[Password]){
			$Password = $NPassword1;
		} else {
			err_back("잘못된 비밀번호입니다.");
		}
	}

	
	if($NPassword1 == "" && $Password){
		$pwd2 = sql_password($Password);
		if($pwd2 != $pw_row2[Password]){
			err_back("잘못된 비밀번호입니다.");
		}
	}

	if($NPassword1 == "" && $Password1 == "") err_back("Please Input Password.");

	if($Password) $sql_password = " Password = password('$Password'), ";

	$SQL  = "update ".$memberdb." set 
							UserName = '$UserName',
							BirthDay = '$BirthDay',
							Sex = '$Sex',
							Phone = '$Phone',
							Mobile = '$Mobile',
							Email = '$Email',
							NickName = '$NickName',
							ZipCode = '$ZipCode',
							Address1 = '$Address1',
							Address2 = '$Address2',
							Address3 = '$Address3',
							$sql_password
							$sql_common
							EmailFlag = '$EmailFlag'
						where
							UserID = '".$user["ID"]."' ";
	
	$Result = sql_query($SQL);

	if(!$Result){
	   err_back("수정 실패.");
	   exit;
	}
	err_move('회원정보를 수정하였습니다. 변경된 정보의 적용을 위해 로그아웃 합니다.',"/board/module/incmember/logout.php");

}else{


	if(!$UserID){
		err_back('잘못된 접근입니다.');
	}
	
	$NoID = array("admin","ADMIN","Admin","guest","GUEST","Guest","manager");
	$NoIDSize = count($NoID);
	//금지된 아이디인지 체크한다.
	for($i=0;$i<$NoIDSize;$i++){
	  if($NoID[$i]==$UserID){
		err_back("사용 불가능한 아이디입니다.");
		exit;
	  }
	}
	//ID중복체크
	$IdCheckSQL = "select * from ".$memberdb." where UserID='$UserID'";
	//echo $IdCheckSQL;
	$IdCheckResult = mysql_query($IdCheckSQL);
	$IdCheckCount = mysql_num_rows($IdCheckResult);
	if($IdCheckCount){
	   err_back("이미 사용중인 아이디입니다.");
	   exit;
	}

	//회원 생성.
	$SQL = " insert into ".$memberdb." set 
									UserID = '".$UserID."',
									UserName = '".$UserName."',
									memberType = '".$memberType."',
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
									Address3 = '".$Address3."',
									Content = '".$Content."',
									Flag = '".$Flag."',
									Point = '0',
									UserLevel = '".$UserLevel."',
									LoginIP = '".$UserIP."',
									LoginDate = '".time()."',
									$sql_common
									EmailFlag = '$EmailFlag',
									JoinDateTime = '".time()."',
									JoinDate = '".date("Y-m-d",time())."' ";

	$Result = mysql_query($SQL);

	if(!$Result){
	   //err_back("회원등록에 실패하였습니다.");
	   echo "<font color='white'>".mysql_error()."</font>";
	   exit;
	}

	$subject = "".$UserName."님의 ".$adminname." 회원가입을 축하드립니다.";
	
	$table_content ="
		<table width='80%' border='0' cellspacing='0' cellpadding='0'>
			<tr>
				<td width='26' height='30'></td>
				<td width='450' height='40' align='left' valign='middle'><strong>$UserName</strong> 님의 회원가입이 정상적으로 처리되었습니다. </td>
			</tr>
			<tr>
				<td width='26' height='30'></td>
				<td width='450' height='40' align='left' valign='middle'>$adminname은 회원님의 개인정보를 소중하게 여깁니다.. </td>
			</tr>
			<tr>
				<td width='26' height='30'></td>
				<td width='450' height='40' align='left' valign='middle'>입력하신 정보는 회원님의 동의 없이 공개되지 않으며 안전하게 보호를 받습니다 </td>
			</tr>
			<tr>
				<td width='26' height='30'></td>
				<td width='450' height='40' align='left' valign='middle'>$adminname 회원이 되신 것을 진심으로 축하 드립니다. </td>
			</tr>
			<tr>
				<td height='40' colspan='2' align='center' valign='middle'><table width='400' border='2' cellpadding='0' cellspacing='0' bordercolor='#EBEBEB'>
							<tr>
						<td><table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='#EBEBEB'>
							<tr>
								<td width='3%' height='30' align='left' valign='middle' bgcolor='f8f8f8'>&nbsp;</td>
								<td width='27%' align='left' valign='middle' bgcolor='f8f8f8'> 회원 아이디</td>
								<td width='70%'>&nbsp;$UserID</td>
							</tr>
							<tr align='left' valign='middle'>
								<td height='2' colspan='3' bgcolor='#EBEBEB'></td>
								</tr>
							<tr>
								<td height='30' align='left' valign='middle' bgcolor='f8f8f8'>&nbsp;</td>
								<td height='30' align='left' valign='middle' bgcolor='f8f8f8'> 회원 비밀번호</td>
								<td>&nbsp;$Password</td>
							</tr>
						</table></td>
					</tr>
					
				</table></td>
			</tr>
			<tr>
				<td height='10' colspan='2'></td>
			</tr>
		</table>";

//require $dir.$configDir."/mail.php";
	if(empty($URI)) $URI = "/";
}

GetAlert("","/member/sucess.php");

if(!empty($URI)) $loc = "/board/module/incmember/login_ok.php";
else $loc = "/";
include $dir.$configDir."/common_bottom.php";
?>
<form name="dform" method="post" action="<?=$loc?>">
<input type="hidden" name="UserID" value="<?=$UserID?>">
<input type="hidden" name="UserName" value="<?=$UserName?>">
<input type="hidden" name="Email" value="<?=$Email?>">
<input type="hidden" name="Password1" value="">
<input type="hidden" name="URI" value="<?=$URI?>">
</form>
<script type="text/JavaScript">
//	alert("회원 가입이 완료되었습니다.");
	<? if(!empty($URI)){ ?>
		document.dform.Password1.value = '<?=$Password?>';
	<? } ?>
	document.dform.submit();
</script>

