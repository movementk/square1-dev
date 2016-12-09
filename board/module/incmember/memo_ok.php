<?
include "../../../board/config/use_db.php";

$send_mb_nick = $_REQUEST["send_mb_nick"];
$send_mb_id = $_REQUEST["send_mb_id"];
$recv_array = explode(",",$_REQUEST["recv_mb_nick"]);
$memo = $_REQUEST["memo"];
$memo_idx = $_REQUEST["memo_idx"];
$tn = $_REQUEST["tn"];
$memo_work_type = $_REQUEST["memo_work_type"];

$ck_memo_del_id = explode(",",$_REQUEST["ck_memo_del_id"]);

//print_r2($ck_memo_del_id);

if($ck_memo_del_id[0] != ""){
	$tn = $_REQUEST["d_tn"];
	for($i=0;$i<count($ck_memo_del_id);$i++){
		if($ck_memo_del_id[$i] == "") continue;
		$sql = " select * from ".$site_prefix."memo where idx ='".$ck_memo_del_id[$i]."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		//echo $sql;
		if($tn > 1){
			if($row["read_datetime"] != "0000-00-00 00:00:00"){
				$update_sql = " update ".$site_prefix."memo set memo_flag2 = 'no' where idx='".$ck_memo_del_id[$i]."' ";
				$update_result = mysql_query($update_sql);
				err_move("쪽지삭제 성공","../../../members/popup_note.php?tn=".$tn);
				exit;
			}
			$update_sql = " delete from ".$site_prefix."memo where idx ='".$ck_memo_del_id[$i]."' ";
			$update_result = mysql_query($update_sql);
			if(!$update_result) err_back("메모삭제 오류 1-1");
		} else {
			$update_sql = " update ".$site_prefix."memo set memo_flag = 'no' where idx='".$ck_memo_del_id[$i]."' ";
			$update_result = mysql_query($update_sql);
			if(!$update_result) err_back("메모삭제 오류 1-2");
		}
	}
	err_move("쪽지삭제 성공","../../../members/popup_note.php?tn=".$tn);
	exit;
} else {
	
	if($memo_work_type == "del"){
		$sql = " select * from ".$site_prefix."memo where idx ='".$memo_idx."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		if($tn > 1){
			if($row["read_datetime"] != "0000-00-00 00:00:00"){
				$update_sql = " update ".$site_prefix."memo set memo_flag2 = 'no' where idx='".$memo_idx."' ";
				$update_result = mysql_query($update_sql);
				err_move("쪽지삭제 성공","../main.php?category=$category&tn=".$tn);
				exit;
			}
			$update_sql = " delete from ".$site_prefix."memo where idx ='".$memo_idx."' ";
			$update_result = mysql_query($update_sql);
			if(!$update_result) err_back("메모삭제 오류 1-1");
		} else {
			$update_sql = " update ".$site_prefix."memo set memo_flag = 'no' where idx ='".$memo_idx."' ";
			$update_result = mysql_query($update_sql);
			if(!$update_result) err_back("메모삭제 오류 1-2");
		}
		err_move("쪽지삭제 성공","../../../members/popup_note.php?tn=".$tn);
		//echo "<script>location.href='../../../members/popup_note.php?tn=".$tn."';</script>";
	} else {
		if($_REQUEST["memo"] == ""){
			err_back("내용이 없습니다.");
		}
		for($i=0;$i<count($recv_array);$i++){
			${"recv_mb_nick".$i} = trim($recv_array[$i]);

			$find_sql = " select * from ".$site_prefix."member where UserName = '".${"recv_mb_nick".$i}."'";
			$find_result = mysql_query($find_sql);
			$find_row = mysql_fetch_array($find_result);

			if(${"recv_mb_nick".$i} == "관리자"){
				$fond_row[UserID] = "admin";
			}

			${"recv_mb_id".$i} = $find_row[UserID];

			//print_r2($find_row);
			
			if(!$find_row) err_back("받는사람 (".${"recv_mb_nick".$i}.") 닉네임이 존재하지 않습니다.");

			if($find_row[UserID] == $send_mb_id) err_back("본인에게 보낼 수 없습니다.");

			if($bf_insert_id == ${"recv_mb_nick".$i}) err_back("한명에게 같은내용을 두번 보낼 수 없습니다.\\n새로 작성해서 보내주세요");
			

			$SQL = "insert into ".$site_prefix."memo (";
			$SQL .= "recv_mb_nick,";
			$SQL .= "send_mb_nick,";
			$SQL .= "recv_mb_id,";
			$SQL .= "send_mb_id,";
			$SQL .= "send_datetime,";		
			$SQL .= "memo) values('";
			$SQL .= ${"recv_mb_nick".$i}."', '";
			$SQL .= $send_mb_nick."', '";
			$SQL .= ${"recv_mb_id".$i}."', '";
			$SQL .= $send_mb_id."', ";
			$SQL .= "now(), '";
			$SQL .= $memo."' ) ";
			$Result = mysql_query($SQL);

			//echo $SQL;

			$bf_insert_id = ${"recv_mb_nick".$i};
			if(!$Result){
				err_back("insert error");
			}
		}

		err_move("쪽지보내기 성공.","../../../members/popup_note.php?tn=".$tn);
		//echo "<script>location.href='../../../members/popup_note.php?tn=".$tn."';</script>";
	}
}
?>
