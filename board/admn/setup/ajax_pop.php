<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";

//print_r2($_REQUEST);

//echo $sel_id;

$sql = " select * from ".$site_prefix."popup where Idx = '".$idx."' ";
$row = sql_fetch($sql);
$row["files"] = get_file($site_prefix."popup",$idx);
if($row["files"][0]["file_source"]){
	echo "<img src='".$row["files"][0]["path"]."/".$row["files"][0]["file_source"]."' id='pop_img' width='".$row["files"][0]["image_width"]."' style='cursor:pointer;' onclick='pop_close();'>";
}
?>