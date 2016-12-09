<?
ob_start();
include $_SERVER["DOCUMENT_ROOT"].$loc."/board/config/use_db.php";

$val = $_REQUEST["val"];

if(preg_match("/(admin|manager|bbbkorea)/i",$val)){
	echo "100"; //사용불가 아이디
//	echo "<font color='#e00000'><strong>이미 사용중인 아이디 입니다.</strong></font><input type='hidden' name='idchk' value='No'>";
	exit;
}

if(strlen($val) < 3 || strlen($val) > 16){
	echo "220"; //글자수 제한
}

$sql = " select * from ".$memberdb." where UserID = '".$val."' ";
$result = mysql_query($sql);
$cnt = mysql_num_rows($result);

if($cnt > 0){
	echo "110"; //이미 사용중인 아이디
//	echo " <font color='#e00000'><strong>이미 사용중인 아이디 입니다.</strong></font><input type='hidden' name='idchk' value='No'>";
} else {
	if(!preg_match("/^[a-z]/", $val)) {
		echo "200"; //아이디 첫글자 영문
	//	echo "<font color='#e00000'><strong>아이디의 첫글자는 영문이어야 합니다.</strong></font><input type='hidden' name='idchk' value='No'>";
	} else if(preg_match("/[^a-z^0-9^_]/", $val)) {
		echo "210"; // 사용불가 문자열 포함
	//	echo "<font color='#e00000'><strong>아이디는 영문, 숫자, _ 만 사용할 수 있습니다.</strong></font><input type='hidden' name='idchk' value='No'>";
	} else {
		echo "000"; //사용가능
	//	echo "<font color='#3530ff'>사용 가능한 아이디 입니다.</font><input type='hidden' name='idchk' value='Yes'>";
	}
}
?>
