<?
include $_SERVER['DOCUMENT_ROOT'].$loc."/board/config/use_db.php"; 

foreach($_REQUEST as $KEY => $VALUES){
	if($KEY == "Content" || $KEY == "con"){
		${$KEY} = get_text($VALUES);
		//echo $KEY." : ".${$KEY};
	} else {
		${$KEY} = preg_replace("/\"/", "&#034;", get_text($VALUES));
	}
}

switch($workType){
	case "D":
		$sql = " update ".$mode." set bd1 = '' where BoardIdx = '".$idx."' ";
		$result = sql_query($sql);
		echo "삭제되었습니다.";
		break;
	case "I":
		$sql = " update ".$mode." set bd1 = '".$con."' where BoardIdx = '".$idx."' ";
		$result = sql_query($sql);
		echo "등록되었습니다.";
		break;
}
?>