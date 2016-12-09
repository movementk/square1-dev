<?
define("_MKBOARD_", TRUE);

$connect_ok = "ok";
$memberdb=$site_prefix."member";
$fileTable = $site_prefix."file";
$CommentName = $site_prefix."board_comment";
$site_charset = "UTF-8";
$naver_client_id = "";
$naver_client_secret = "";
$daum_map_api_key = "";
$site_url = "http://".$_SERVER["HTTP_HOST"];

$is_admin = false;

$controlLevel = 99;
if($_COOKIE["admin_id2"]){
	$is_admin = true;
}

foreach($_REQUEST as $KEY => $VALUES){
	${$KEY} = $VALUES;
}

$is_member = false;
$is_guest = true;
$is_mk = false;
$member_use = true;
$category_use = false;

$company_name = ""; //아이디비밀번호찾기 메일제목의 회사명

if($_SERVER['REMOTE_ADDR'] == "112.216.114.162") $is_mk = true;

$loc_ck = explode("/",$_SERVER['PHP_SELF']);

$TableConfigDB = $site_prefix."board_setting";

$user['ID']=$_COOKIE["MemberID"];

if(!empty($user["ID"])){
	$is_member = true;
	$is_guest = false;
}

$auth_array_tit[0] = "일반회원";
$auth_array_val[0] = "2";
$auth_array_tit[1] = "관리자";
$auth_array_val[1] = "99";
?>