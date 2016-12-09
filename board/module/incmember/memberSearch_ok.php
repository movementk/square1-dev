<?
include $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir."/config/common_top.php";

$newpw = uniqid(rand(1111,9999));

if(isset($Email)){
	$emailck = email_func($Email);

	if(!$emailck) GetAlert("이메일주소 형식이 맞지않습니다.","BACK");
}

switch($workType){
	case "ID1":
		if(!isset($UserName) || !isset($Email)) GetAlert("이름과 이메일주소를 입력해주시기 바랍니다.","BACK");

		$sql = " select UserID from ".$memberdb." where UserName = '".$UserName."' and Email = '".$Email."' ";
		$row = sql_fetch($sql);

		if(empty($row["UserID"])){
			GetAlert("회원 정보가 없습니다. 이름과 이메일 주소를 확인해주시기 바랍니다.","BACK");
			exit;
		}
		GetAlert("회원님의 아이디는 ".$row["UserID"]." 입니다.","/member/login.php");
/*
		$mailcontent ="<table width='80%' border='0' cellpadding='0' cellspacing='0' bordercolor='#EBEBEB'>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
				<tr>
					<td width='5%' height='30' align='left' valign='middle' bgcolor='f8f8f8'>&nbsp;</td>
					<td width='25%' align='left' valign='middle' bgcolor='f8f8f8'> 회원 아이디</td>
					<td width='70%'>&nbsp;$row[UserID]</td>
				</tr>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
				<tr>
					<td height='30' align='left' valign='middle' bgcolor='f8f8f8'>&nbsp;</td>
					<td height='30' align='left' valign='middle' bgcolor='f8f8f8'> 임시 비밀번호</td>
					<td>&nbsp;$newpw</td>
				</tr>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
			</table>";

		$subject = $company_name." 아이디/비밀번호 찾기 결과 입니다.";
		$fname = $company_name;
		$fmail = "admin@".$_SERVER['HTTP_HOST'];
		$to = $Email;
		
		mailer($fname, $fmail, $to, $subject, $content,1);

		GetAlert("회원님의 메일로 아이디를 발송하였습니다.","/");
		*/
		break;
	case "ID2":
		$mobile = $mobile1."-".$mobile2."-".$mobile3;
		if(!isset($UserName) || $mobile == "--") GetAlert("이름과 휴대전화번호를 입력해주시기 바랍니다.","BACK");

		$sql = " select UserID from ".$memberdb." where UserName = '".$UserName."' and Mobile = '".$mobile."' ";
		$row = sql_fetch($sql);

		if(empty($row["UserID"])){
			GetAlert("회원 정보가 없습니다. 이름과 휴대전화번호를 확인해주시기 바랍니다.","BACK");
			exit;
		}

		GetAlert("회원님의 아이디는 ".$row["UserID"]." 입니다.","/member/login.php");
		break;
	case "PW1":
		if(!isset($UserID) || !isset($UserName) || !isset($Email)) GetAlert("아이디와 이름과 이메일주소를 입력해주시기 바랍니다.","BACK");

		$sql = " select * from ".$memberdb." where UserID = '".$UserID."' and UserName = '".$UserName."' and Email = '".$Email."' ";
		$row = sql_fetch($sql);

		if(empty($row["UserID"])){
			GetAlert("회원 정보가 없습니다. 이름과 이메일주소를 확인해주시기 바랍니다.","BACK");
			exit;
		}

		$usql = " update ".$memberdb." set Password = password('".$newpw."') where UserID = '".$UserID."' ";
		$uresult = sql_query($usql);

		$mailcontent ="<table width='80%' border='0' cellpadding='0' cellspacing='0' bordercolor='#EBEBEB'>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
				<tr>
					<td width='5%' height='30' align='left' valign='middle' bgcolor='f8f8f8'>&nbsp;</td>
					<td width='25%' align='left' valign='middle' bgcolor='f8f8f8'> 회원 아이디</td>
					<td width='70%'>&nbsp;$row[UserID]</td>
				</tr>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
				<tr>
					<td height='30' align='left' valign='middle' bgcolor='f8f8f8'>&nbsp;</td>
					<td height='30' align='left' valign='middle' bgcolor='f8f8f8'> 임시 비밀번호</td>
					<td>&nbsp;$newpw</td>
				</tr>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
			</table>";

		$subject = $company_name." 아이디/비밀번호 찾기 결과 입니다.";
		$fname = $company_name;
		$fmail = "admin@".$_SERVER['HTTP_HOST'];
		$to = $Email;
		
		mailer($fname, $fmail, $to, $subject, $mailcontent,1);

		GetAlert("회원님의 메일로 임시 비밀번호를 발송하였습니다.","/");
		break;
	case "PW2":
		$mobile = $mobile1."-".$mobile2."-".$mobile3;
		if(!isset($UserID) || !isset($UserName) || $mobile == "--") GetAlert("아이디와 이름과 휴대전화번호를 입력해주시기 바랍니다.","BACK");

		$sql = " select * from ".$memberdb." where UserID = '".$UserID."' and UserName = '".$UserName."' and Mobile = '".$mobile."' ";
		$row = sql_fetch($sql);

		if(empty($row["UserID"])){
			GetAlert("회원 정보가 없습니다. 이름과 휴대전화번호를 확인해주시기 바랍니다.","BACK");
			exit;
		}

		$usql = " update ".$memberdb." set Password = password('".$newpw."') where UserID = '".$UserID."' ";
		$uresult = sql_query($usql);

		$mailcontent ="<table width='80%' border='0' cellpadding='0' cellspacing='0' bordercolor='#EBEBEB'>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
				<tr>
					<td width='5%' height='30' align='left' valign='middle' bgcolor='f8f8f8'>&nbsp;</td>
					<td width='25%' align='left' valign='middle' bgcolor='f8f8f8'> 회원 아이디</td>
					<td width='70%'>&nbsp;$row[UserID]</td>
				</tr>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
				<tr>
					<td height='30' align='left' valign='middle' bgcolor='f8f8f8'>&nbsp;</td>
					<td height='30' align='left' valign='middle' bgcolor='f8f8f8'> 임시 비밀번호</td>
					<td>&nbsp;$newpw</td>
				</tr>
				<tr align='left' valign='middle'><td height='2' colspan='3' bgcolor='#EBEBEB'></td></tr>
			</table>";

		$subject = $company_name." 아이디/비밀번호 찾기 결과 입니다.";
		$fname = $company_name;
		$fmail = "admin@".$_SERVER['HTTP_HOST'];
		$to = $Email;
		
		mailer($fname, $fmail, $to, $subject, $mailcontent,1);

		GetAlert("회원님의 메일로 임시 비밀번호를 발송하였습니다.","/");
		break;
}
?>
<form name="search_form" method="post" action="<?=$action?>">
<input type="hidden" name="uid" value="<?=$UserID?>">
<input type="hidden" name="uname" value="<?=$row["UserName"]?>">
<input type="hidden" name="newpw" value="<?=$newpw?>">
</form>
<Script>
document.search_form.submit();
</script>
<?
include $dir."/config/common_bottom.php";
?>