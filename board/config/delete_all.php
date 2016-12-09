<?
include "./use_db.php";

$tmp_array = array();
$tmp_array = $_POST[chk_idx];

if($is_admin == "ok"){
	for($i=0;$i<count($tmp_array);$i++){
		$fsql = " select * from ".$file_table." where board_table = '".$mode."' and board_idx = '".$tmp_array[$i]."' order by file_no asc ";
		$fresult = mysql_query($fsql);
		$j=1;
		while($frow = mysql_fetch_array($fresult)){
			if($frow[file_no] == $j){
				if(file_exists($dir."/upload/".$BoardName."/".$frow["file_source"])){
					unlink($dir."/upload/".$BoardName."/".$f_row["file_source"]);
					if(file_exists($dir."/upload/".$BoardName."/s_".$frow["file_source"])){
						unlink($dir."/upload/".$BoardName."/s_".$frow["file_source"]);
					}
					$fSQL = "delete from ".$fileTable." where board_table='".$mode."' and board_idx=".$tmp_array[$i]." and file_no=".$j;
					$fResult = mysql_query($fSQL);
				}
			}
			$j++;
		}

		$SQL = "delete from ".$mode." where BoardIdx=".$tmp_array[$i];
		$Result = mysql_query($SQL);
		if(!$Result){
			err_back("Delete Fail");
		}
	}
}

err_move('Delete Success',$_POST[returnpage]);
?>