<?
$dir = $_SERVER["DOCUMENT_ROOT"].$loc."/board";
$configDir="/config";
require $dir.$configDir."/connect.php";
require $dir.$configDir."/config.php";
include_once $dir."/config/Snoopy.class.php";
require $dir.$configDir."/func.php";
require $dir.$configDir."/recaptcha/recaptcha.lib.php";
$captcha_html = '';
$captcha_js   = '';
if ($is_guest) {
	$captcha_html = captcha_html();
	$captcha_js   = chk_captcha_js();
}

if($is_admin){
	$asql = " select * from ".$site_prefix."admin where admin_id = '".$_COOKIE['admin_id2']."' ";
	$admin = sql_fetch($asql);
	$admin["ID"] = $admin["admin_id"];
	$admin["Name"] = $admin["admin_name"];
}

$sql = " select it_ip from mk_intercept where 1=1 ";
$result = sql_query($sql);
for($i=0;$row = sql_fetch_array($result);$i++){
	$ipAr = explode(".",$row["it_ip"]);
	for($j=0;$j<sizeof($ipAr);$j++){
		if($ipAr[$j] == "*"){
			if(preg_match("/".$row["it_ip"]."/i",$_SERVER["REMOTE_ADDR"])){
				echo "대역폭 접근제어";
				exit;
			}
		}
	}
	if($row["it_ip"] == $_SERVER["REMOTE_ADDR"]){
		echo "아이피 접근제어";
		exit;
	}
}

if($is_member) $member = get_member($user["ID"]);

// 불법접근을 막도록 토큰생성
if($is_guest && ($board_code == "board_view" || $board_code == "board_write")) {
	$token = md5(uniqid(rand(), true));
	set_session("ss_token", $token);
	session_unregister("scaptcha_code");  // 자동등록방지 세션 초기화
}

$is_mobile = false;
$mobile_device = false;
$arr_mobile= array ("iPhone","iPod","IEMobile","Mobile","lgtelecom","Android");

for($i = 0 ; $i < count($arr_mobile) ; $i++) {
	if(strpos($_SERVER['HTTP_USER_AGENT'],$arr_mobile[$i]) == true){   //strpos 해당문자열이 포함 되었는지 확인 해준다
		// 모바일 브라우저가 아니면 
		$is_mobile = true;

		if(strpos($_SERVER["HTTP_USER_AGENT"], "Android")){
			$deviceCorp = "android";
		}
		if(strpos($_SERVER["HTTP_USER_AGENT"], "iPhone") || strpos($_SERVER["HTTP_USER_AGENT"], "iPod") ){
			$deviceCorp = "iphone";
		}
	}
}

if($_GET["device"]){
	
	if(!$_SESSION["device"]) $_SESSION["device"] = $_GET["device"];

	switch($_SESSION["device"]){
		case "pc":
			set_session("is_pc", "Y");
			if(preg_match("/\/mobile\//i",$_SERVER["PHP_SELF"])) GetAlert("","/");
			break;
		case "mobile":
			set_session("is_pc", "N");
			if(!preg_match("/\/mobile\//i",$_SERVER["PHP_SELF"])) GetAlert("","/mobile");
			break;
	}
}

if($_SESSION["is_pc"] == "Y"){
	$is_mobile = false;
}
?>