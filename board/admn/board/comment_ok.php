<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/config/use_db.php";
include $dir.$configDir."/admin_check.php";

foreach($_REQUEST as $KEY => $VALUES){
	if($KEY == "Comment"){
		${$KEY} = get_text($VALUES);
	} else {
		${$KEY} = trim(preg_replace("/\"/", "&#034;", get_text($VALUES)));
	}
}
//print_r2($_REQUEST);
$getParam = "?Category=".$Category."&sT=".$sT."&sF=".$sF."&bidx=".$bidx."&idx=".$idx;

if (substr_count($Comment, "&#") > 50) {
    err_move("내용에 올바르지 않은 코드가 다수 포함되어 있습니다.".$url.$getParam);
    exit;
}

/*
$UserID = $user[ID];
if($user[ID]){
	$UserName = $user[NAME];
	if($is_admin){
		$usql = " select * from ".$site_prefix."admin where admin_id = '".$UserID."' ";
		$urow = sql_fetch($usql);
		$UserPW = sql_password($urow['admin_pwd']);
	} else {
		$usql = " select * from ".$site_prefix."member where UserID = '".$UserID."' ";
		$urow = sql_fetch($usql);
		$UserPW = $urow['Password'];
	}
} else {
	$UserPW = sql_password($UserPW);
}
*/
$UserID = $user["ID"];
$usql = " select * from ".$site_prefix."admin where admin_id = '".$UserID."' ";
$urow = sql_fetch($usql);
$UserPW = sql_password($urow['admin_pwd']);

$comment_table = $site_prefix."board_comment";

$sql = " select MD5(CONCAT(UserIP,Comment)) as prev_md5 from ".$comment_table;
if($w == "cu"){
	$sql .= " where CommentIdx <> '$CommentIdx' ";
}
$sql .= " order by CommentIdx desc limit 1 ";
$row = sql_fetch($sql);
$curr_md5 = md5($_SERVER['REMOTE_ADDR'].$Comment);
if($row[prev_md5] == $curr_md5 && $cmode != "cu"){
	err_move("동일한 내용을 연속해서 등록할 수 없습니다.",$url.$getParam);
	exit;
}

$sql = " select * from ".$mode." where BoardIdx = '".$idx."' ";
$row = sql_fetch($sql);
if(!$row[BoardIdx]){
	err_move("글이 존재하지 않습니다.\\n\\n글이 삭제되었을 수 있습니다",$url.$getParam);
	exit;
}

switch($cmode){
	case "d" :
		$sql = " select * from ".$comment_table." where CommentIdx = '".$CommentIdx."' ";
		$comment = sql_fetch($sql);
		
		if(!$comment[CommentIdx]){
			err_move("삭제할 코멘트가 없습니다.",$url.$getParam);
			exit;
		}

		$comment_member		= get_member($comment[UserID]);

		if($is_admin){
			;
		} else if($comment_member[UserLevel] > $user[Level]){
			err_move("자신보다 권한이 높은 회원의 코멘트이므로 삭제할 수 없습니다.",$url.$getParam);
			exit;
		} else {
			if($comment[UserID] != $UserID){
				err_move("자신의 글이 아니므로 삭제할 수 없습니다.",$url.$getParam);
				exit;
			}
		}

		$len = strlen($comment[comment_reply]);
		if($len < 0) $len = 0;
		$comment_reply = substr($comment[comment_reply],0, $len);

		$sql = " select count(*) as cnt from ".$comment_table." where comment_reply like '".$comment_reply."%' and CommentIdx <> '".$CommentIdx."' and comment_cnt = '".$comment[comment_cnt]."' and DBName = '".$comment[DBName]."' and BoardIdx = '".$comment[BoardIdx]."' ";
		$row = sql_fetch($sql);

		if($row[cnt]){
			err_move("이 코멘트와 관련된 답변코멘트가 존재하므로 삭제 할 수 없습니다.",$url.$getParam);
			exit;
		}

		$sql = " delete from ".$comment_table." where CommentIdx = '".$CommentIdx."' ";
		$result = sql_query($sql);

		break;
	case "c" :
		if ($CommentIdx) {
			$sql = " select CommentIdx, comment_cnt, comment_reply, DBName, BoardIdx from ".$comment_table." where CommentIdx = '".$CommentIdx."'";
			$reply_array = sql_fetch($sql);

			if(!$reply_array[CommentIdx]){
				err_move("답변할 코멘트가 없습니다.\\n답변하는 동안 코멘트가 삭제되었을 수 있습니다.",$url.$getParam);
				exit;
			}

			$tmp_comment = $reply_array[comment_cnt];

			if(strlen($reply_array[comment_reply]) == 5){
				err_move("더 이상 답변하실 수 없습니다.\n답변은 5단계 까지만 가능합니다.",$url.$getParam);
				exit;
			}

			$reply_len = strlen($reply_array[comment_reply]) + 1;

			$begin_reply_char = "A";
			$end_reply_char = "Z";
			$reply_number = +1;
			$sql = " select MAX(SUBSTRING(comment_reply, $reply_len, 1)) as reply from ".$comment_table." where comment_cnt = '$tmp_comment' and SUBSTRING(comment_reply, $reply_len, 1) <> '' and DBName = '$reply_array[DBName]' and BoardIdx = '$reply_array[BoardIdx]' ";
			if($reply_array[comment_reply]){
				$sql .= " and comment_reply like '$reply_array[comment_reply]%' ";
			}
			$row = sql_fetch($sql);

			if(!$row[reply]){
				$reply_char = $begin_reply_char;
			} else if($row[reply] == $end_reply_char){
				err_move("더 이상 답변하실 수 없습니다.\\n답변은 26개 까지만 가능합니다.",$url.$getParam);
				exit;
			} else {
				$reply_char = chr(ord($row[reply]) + $reply_number);
			}

			$tmp_comment_reply = $reply_array[comment_reply].$reply_char;
		} else {
			$sql = "select max(comment_cnt) as max_comment from ".$comment_table." where BoardIdx = '".$idx."' ";
			$row = sql_fetch($sql);
			$row[max_comment] += 1;
			$tmp_comment = $row[max_comment];
			$tmp_comment_reply = "";
		}

		$sql = "insert into ".$comment_table." set
					DBName		= '".$mode."',
					BoardIdx		= '".$idx."',
					Comment			= '".$Comment."',
					UserID			= '".$UserID."',
					UserName		= '".$UserName."',
					UserPW			= '".$UserPW."',
					UserIP			= '".$_SERVER['REMOTE_ADDR']."',
					comment_cnt		= '".$tmp_comment."',
					comment_reply	= '".$tmp_comment_reply."',
					comment_option	= '".$comment_secret."',
					RegDate			= now() ";
		$result = sql_query($sql);
		break;
	case "cu" :

		$sql = " select * from ".$comment_table." where CommentIdx = '".$CommentIdx."' ";
		$comment = $reply_array = sql_fetch($sql);
		$tmp_comment = $reply_array[comment_cnt];
		
		$len = strlen($reply_array[comment_reply]);
		if($len < 0) $len = 0;
		$comment_reply = substr($reply_array[comment_reply],0, $len);

		$comment_member		= get_member($comment[UserID]);

		if($is_admin){
			;
		} else if($comment_member[memberLv] > $admin[memberLv]){
			err_move("자신보다 권한이 높은 회원의 코멘트이므로 수정할 수 없습니다.",$url.$getParam);
			exit;
		} else {
			if($comment[memberID] != $UserID){
				err_move("자신의 글이 아니므로 수정할 수 없습니다.",$url.$getParam);
				exit;
			}
		}

		$sql = " select count(*) as cnt from ".$comment_table." where comment_reply like '".$comment_reply."%' and CommentIdx <> '".$CommentIdx."' and comment_cnt = '".$tmp_comment."' and DBName = '".$comment[DBName]."' and BoardIdx = '".$comment[BoardIdx]."'";
		$row = sql_fetch($sql);
		if($row[cnt]){
			err_move("이 코멘트와 관련된 답변코멘트가 존재하므로 수정 할 수 없습니다.",$url.$getParam);
			exit;
		}
		$sql_ip = "";

		$sql_ip = " , UserIP = '".$_SERVER['REMOTE_ADDR']."' ";

		if($comment_secret){
			$sql_secret = " , comment_option = '".$comment_secret."' ";
		}

		$sql = " update ".$comment_table." set
					Comment = '".$Comment."',
					UserName = '".$UserName."'
					$sql_ip
					$sql_secret
				where
					CommentIdx = '".$CommentIdx."' ";
		$result = sql_query($sql);
		break;
}

switch($cmode){
	case "d":
		$works = "삭제";
	case "cu":
		if(!$works) $works = "수정";
	case "c" : 
		if(!$works) $works = "입력";
		err_move("댓글이 {$works}되었습니다.",$url.$getParam);
		break;
}
?>
