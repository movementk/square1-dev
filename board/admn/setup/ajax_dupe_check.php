<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir.$configDir."/admin_check.php";

switch($workType){
	case "MG":
		if($old_name) $sql_common = "and grade_name != '".$old_name."' ";
		$sql = " select count(*) as cnt from ".$mode." where grade_name = '".$val."' {$sql_common} ";
		$row = sql_fetch($sql);
		if($row["cnt"] > 0) $str = "201";
		else $str = "100";

		if(mb_strwidth($val,'UTF-8') < $str_limit) $str = "200";
		break;
	case "LAN":
		if($old_name) $sql_common = "and language_name != '".$old_name."' ";
		$sql = " select count(*) as cnt from ".$mode." where language_name = '".$val."' {$sql_common} ";
		$row = sql_fetch($sql);
		if($row["cnt"] > 0) $str = "201";
		else $str = "100";

		if(mb_strwidth($val,'UTF-8') < $str_limit) $str = "200";
		break;
	case "JOB":
		if($old_name) $sql_common = "and job_name != '".$old_name."' ";
		$sql = " select count(*) as cnt from ".$mode." where job_name = '".$val."' {$sql_common} ";
		$row = sql_fetch($sql);
		if($row["cnt"] > 0) $str = "201";
		else $str = "100";

		if(mb_strwidth($val,'UTF-8') < $str_limit) $str = "200";
		break;
	case "CASES":
		if($old_name) $sql_common = "and case_name != '".$old_name."' ";
		$sql = " select count(*) as cnt from ".$mode." where case_name = '".$val."' {$sql_common} ";
		$row = sql_fetch($sql);
		if($row["cnt"] > 0) $str = "201";
		else $str = "100";

		if(mb_strwidth($val,'UTF-8') < $str_limit) $str = "200";
		break;
}

echo $str;
?>