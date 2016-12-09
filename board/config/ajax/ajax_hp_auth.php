<?
ob_start();
include $_SERVER["DOCUMENT_ROOT"].$loc."/board/config/use_db.php";

if($db = mysql_connect("localhost","CJSMS","bbbkorea!@#")){
	if(!mysql_select_db("CJSMS",$db)) echo "db선택실패";
	@mysql_query("set names 'utf8'");
}else{
	echo "db접속실패";
}

$auth_num = rand(1111,9999);

$sql = " insert into SMS_MSG set
						REQDATE = NOW(),
						PHONE = '".$Mobile."',
						CALLBACK = '02-725-9108',
						STATUS = '1',
						MSG = '비비비코리아 휴대폰 인증번호는 [".$auth_num."] 입니다.',
						TYPE = '0' ";
$result = sql_query($sql);

if(!$result){
	echo 9;
} else {
	echo $auth_num;
}
?>