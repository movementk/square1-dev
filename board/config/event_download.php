<?
include "../config/use_db.php";


	$Idx = $_REQUEST["fid"];

	$sql = " select * from nims_event_file where Idx = '".$Idx."' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$BoardNameArr = explode("_",$row[board_table]);
	$BoardNameArrSize = count($BoardNameArr);
	$BoardName = $BoardNameArr[$BoardNameArrSize-1];
	$filepath = $dir."/upload/event/register/".$row[file_source];
	$filepath = addslashes($filepath);
	if(!is_file($filepath) || !file_exists($filepath)) err_back("파일이 존재하지 않습니다.");

	$original = urlencode($row[file_name]);



if(preg_match("/msie/i", $_SERVER[HTTP_USER_AGENT]) && preg_match("/5\.5/", $_SERVER[HTTP_USER_AGENT])) {
    header("content-type: doesn/matter");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else {
    header("content-type: file/unknown");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");
}
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen("$filepath", "rb");

// 4.00 대체
// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
//if (!fpassthru($fp)) {
//    fclose($fp);
//}

while(!feof($fp)) { 
    echo fread($fp, 100*1024); 
    flush(); 
} 
fclose ($fp); 
flush();
?>
?>