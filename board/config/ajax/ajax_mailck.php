<?
ob_start();
include $_SERVER["DOCUMENT_ROOT"].$loc."/board/config/use_db.php";

$val = $_REQUEST["val"];

if(preg_match("/(admin|manager)/i",$val)){
	echo "100"; //사용불가 아이디
//	echo "<font color='#e00000'><strong>사용할 수 없는 메일주소입니다. 다른 메일주소를 입력해주세요</strong></font><input type='hidden' name='idchk' value='No'>";
	exit;
}

if($old_email) $sql_common = " and Email != '".$old_email."' ";

$sql = " select * from ".$memberdb." where Email = '".$val."' $sql_common ";
$result = mysql_query($sql);
$cnt = mysql_num_rows($result);

$emailck = email_func($val);

if(!$emailck){
	echo "110"; //이미 사용중인 아이디
//	$msg = "<font color='#e00000'><strong>이메일 형식이 맞지않습니다.</strong></font><input type='hidden' name='mailchk' value='No'>";
	exit;
}

if($cnt > 0){
	echo "120"; //이미 사용중인 아이디
//	$msg = "<font color='#e00000'><strong>이미 사용중인 이메일 입니다.</strong></font><input type='hidden' name='mailchk' value='No'>";
} else {
	echo "000"; //이미 사용중인 아이디
//	$msg = "<font color='#3530ff'><strong>사용가능한 이메일 주소입니다.</font><input type='hidden' name='mailchk' value='Yes'>";
}
?>
