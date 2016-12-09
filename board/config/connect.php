<?
include $dir.$configDir."/mysql_class.php";  // db class

$date = date("Ymd");
$db = new db_mysql;
$db -> HOST = "localhost";
$db -> USER = "square1";
$db -> PASS = "mksquare10421";
$db -> DNS = "square1";
$db -> log_file = $dir."/db_log/".$date."_log.txt";
$db -> con();

$conn = mysqli_connect("localhost", $db -> USER, $db -> PASS, $db -> DNS); 

$dbip = "218.151.227.37:1433";
$dbuid = "movek";
$dbpwd = "kmove2016!";
$dbname = "CRM_SQ1";
$mconn = mssql_connect($dbip,$dbuid,$dbpwd);
if(!$mconn) die("couldn't connect to MS-SQL server");
if(!mssql_select_db($dbname,$mconn)){
	echo "테이블 선택실패";
}

$company_name = "";
$site_prefix = "mk_";

?>