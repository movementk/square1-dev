<?
include $_SERVER['DOCUMENT_ROOT'].$loc."/board/config/use_db.php";

if($tp == "ev"){
	$Idx = $_REQUEST["ei"];

	$sql = " select * from nims_event_part where Idx = '".$Idx."' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	$filepath = $dir."/upload/event/part/".$row[UpFile1];
	$filepath = addslashes($filepath);
	if(!is_file($filepath) || !file_exists($filepath)) err_back("파일이 존재하지 않습니다.");

	$row[UpFileName1] = str_replace(" ","_",$row[UpFileName1]);
	$original = urlencode($row[UpFileName1]);

}else if($tp == "vd"){
	$Idx = $_REQUEST["vi"];

	$sql = " select * from nims_event_file where Idx = '".$Idx."' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$filepath = $dir."/upload/event/vod/".$row[file_source];
	$filepath = addslashes($filepath);
	if(!is_file($filepath) || !file_exists($filepath)) err_back("파일이 존재하지 않습니다.");

	$row[file_name] = str_replace(" ","_",$row[file_name]);

	$original = urlencode($row[file_name]);

}else if($tp == "ev2"){
	$Idx = $_REQUEST["ei"];

	$sql = " select * from nims_event_part_file where Idx = '".$Idx."' and seq = '".$seq."' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	$filepath = $dir."/upload/event/part/".$row[Upfile1];


	$filepath = addslashes($filepath);
	if(!is_file($filepath) || !file_exists($filepath)) err_back("파일이 존재하지 않습니다.");
	$row[UpFileName1] = str_replace(" ","_",$row[UpFileName1]);
	$original = urlencode($row[UpFileName1]);

}else {
	$Idx = $_REQUEST["fid"];

	$sql = " select * from ".$fileTable." where Idx = '".$Idx."' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$BoardNameArr = explode("_",$row[board_table]);
	$BoardNameArrSize = count($BoardNameArr);
	$BoardName = $BoardNameArr[$BoardNameArrSize-1];

	$fsql = " select FileCnt from ".$row["board_table"]." where BoardIdx = '".$row["board_idx"]."' ";
	$frow = sql_fetch($fsql);
	if($frow["FileCnt"] > 0){
		$filepath = $dir."/upload/".$BoardName."/olddata/".$row["file_source"];
	} else {
		$filepath = $dir."/upload/".$BoardName."/".$row[file_source];
	}

	$filepath = addslashes($filepath);
	if(!is_file($filepath) || !file_exists($filepath)) err_back("파일이 존재하지 않습니다.");
	$row[file_name] = str_replace(" ","_",$row[file_name]);
	$original = urlencode($row[file_name]);
}


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