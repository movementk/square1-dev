<?
$rp = $_SERVER['PHP_SELF'];

$is_comment_write = false;
if($BoardDateRow["CommentFlag"] == 1){
	$is_comment_write = true;
	if($BoardDateRow["CommentAuthority"] > $member["UserLevel"] && !$is_admin) $is_comment_write = false;
	if($BoardDateRow["CommentAuthority"] == 0) $is_comment_write = true;
}

$PageBlock   = 10;  //넘길 페이지 갯수
$board_list_num = 20;                     //게시판 게시글 수
$pagebt1=$loc."/image/board_img/prev_btn02.gif";
$pagebt2=$loc."/image/board_img/prev_btn.gif";
$pagebt3=$loc."/image/board_img/next_btn.gif";
$pagebt4=$loc."/image/board_img/next_btn02.gif";

$csql = " select * from ".$site_prefix."board_comment where DBName = '$mode' and BoardIdx = '".$view[BoardIdx]."' order by comment_cnt, comment_reply  ";
$cresult = sql_query($csql);
$ctotalcount  = mysql_num_rows($cresult);

$total_page  = ceil($ctotalcount / $board_list_num);  // 전체 페이지 계산
if (!$cpage) { $cpage = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($cpage - 1) * $board_list_num; // 시작 열을 구함

$csql .= " limit $from_record, $board_list_num";
$cresult = mysql_query($csql);
$count = mysql_num_rows($cresult);

$write_pages = get_paging($PageBlock, $cpage, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=board_view&BoardIdx=".$view["BoardIdx"]."&page=".$page."&".$searchVal."&cpage=");

for($i=0;$crow = sql_fetch_array($cresult);$i++){
	$list[$i] = $crow;
}

for($i=0;$i<sizeof($list);$i++){
	$list[$i][content] = $list[$i][content1] = "비밀글 입니다.";

	if(!strstr($list[$i][comment_option],"secret") || ($view[UserID] == $user[ID] && !empty($user[ID])) || ($list[$i][UserID] == $user[ID] && !empty($user[ID])) || $is_admin){
		$list[$i][content1] = $list[$i][Comment];
		$list[$i][content] = conv_content($list[$i][Comment], 0);
	}

	$list[$i][datetime] = substr($list[$i][RegDate],2,14);
	
	$list[$i][is_reply] = false;
	$list[$i][is_edit] = false;
	$list[$i][is_del]  = false;

	if($is_comment_write){
		if($user[ID]){
			if($list[$i][UserID] == $user[ID] || $is_admin){
			//	$list[$i][del_link] = "./delete_comment.php?comment_id=".$list[$i][CommentIdx]."&bid=".$bid."&BoardIdx=".$BoardIdx."&page=".$page."&searchName=".$searchName."&searchTitle=".$searchTitle;
				$list[$i][is_edit] = true;
				$list[$i][is_del] = true;
			}
		} else {
			//비회원이 댓글 썼을때 처리 rootin. 나중에처리하자.
			if(!$list[$i][UserID]){
				$list[$i][del_link] = "/board/module/incboard/comment_password.php?w=d&comment_id=".$list[$i][CommentIdx]."&BoardIdx=".$BoardIdx."&page=".$page."&searchName=".$searchName."&searchTitle=".$searchTitle;
				$list[$i][is_del] = true;
				$list[$i][is_guest] = true;
			}
		}

		if(strlen($list[$i][comment_reply]) < 1){
			$list[$i][is_reply] = true;
		}
	}

	if($i > 0){
		if($list[$i][comment_reply]){
			$tmp_comment_reply = substr($list[$i][comment_reply],0,strlen($list[$i][comment_reply])-1);
			if($tmp_comment_reply == $list[$i-1][comment_reply]){
				$list[$i-1][is_edit] = false;
				$list[$i-1][is_del] = false;
			}
		}
	}
}
?>
<div class="pt30">
	<div id="comment_write" style="display:none;">
		<Div class="reply">
		<form name="fviewcomment" method="post" action="/board/module/incboard/comment_ok.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
		<input type="hidden" name="CommentIdx" id='CommentIdx'	value=''>
		<input type="hidden" name="page"						value='<?=$page?>'>
		<input type="hidden" name="BoardIdx"					value="<?=$view['BoardIdx']?>">
		<input type="hidden" name="cmode" id="cmode"			value="c">
		<input type="hidden" name="Category"					value="<?=$Category?>">
		<input type="hidden" name="workType"					value="<?=$workType?>">
		<input type="hidden" name="mode"						value="<?=$mode?>">
		<input type="hidden" name="sT"							value="<?=$sT?>">
		<input type="hidden" name="sF"							value="<?=$sF?>">
		<input type="hidden" name="url"							value="<?=$_SERVER['PHP_SELF']?>">
		<input type="hidden" name="cat"							value="<?=$cat?>">
		<div class="reply_t">
			<ul>
				<li>댓글쓰기</li>
			</ul>
		</div>
		<div class="reply_txt">
			<ul>
				<li><?=get_member_photo($member["UserID"])?></li>
				<li class="pl10"><textarea name="Comment" id="Comment" class="re_form" style="width:720px;" exp title="내용"></textarea></li>
				<li class="pl10"><input type="image" src="../image/board_img/re_send.jpg" alt="댓글쓰기"></li>
			</ul>
		</div>
		</form>
		</div>
	</div>
	
	<div class="reply_list">
		<?
		for ($i=0; $i<count($list); $i++) {
			$comment_id = $list[$i][CommentIdx];
		?>
		<!--01-->
		<div class="list_con">
			<p class="member_photo"><?=get_member_photo($list[$i]["UserID"])?></p>
			<div class="reply_con">
				<ul>
					<li class="f95"><?=$list[$i]["UserName"]?></li>
					<li class="f95 pl10 pr10">┃</li>
					<li class="f95"><?=$list[$i]["datetime"]?></li>
				</ul>
				<p class="reply_view">
					<?
					if (strstr($list[$i][comment_option], "secret")) echo "<span style='color:#ff6600;'>*</span> ";
					$str = $list[$i][content];
					if (strstr($list[$i][comment_option], "secret"))
						$str = "<span class='small' style='color:#ff6600;'>$str</span>";

					$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
					// FLASH XSS 공격에 의해 주석 처리 - 110406
					//$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
					$str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $str);
					echo nl2br($str);
					?>
				</p>
			</div>
			<div class="reply_btn">
				<ul>
					<? if ($list[$i][is_edit]) { echo "<li><a href=\"javascript:comment_box('{$comment_id}', 'cu');\"><img src='/image/board_img/re_modify_btn.jpg' class='pl5' border=0 align=absmiddle alt='수정'></a></li>"; } ?>
					<? if ($list[$i][is_del])  { echo "<li class='pl3'><a href=\"javascript:comment_delete('{$comment_id}');\"><img src='/image/board_img/re_delete_btn.jpg' class='pl5' border=0 align=absmiddle alt='삭제'></a></li>"; } ?>
				</ul>
			</div>
		</div>
		<div style='width:100%;'>
			<span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
			<span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
			<input type=hidden id='secret_comment_<?=$comment_id?>' value="<?=strstr($list[$i][wr_option],"secret")?>">
			<textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][content1], 0)?></textarea>
		</div>
		<!--//01-->
		<?
		}
		if(count($list) == 0) echo '<div class="list_con">댓글이 없습니다.</div>';
		?>
	</div>

</div>

<div class="bbs_page">
	<?
	if($count>0){
		$write_pages = str_replace("처음", "<img src='$pagebt1' border='0' align='absmiddle' class='pt2' title='처음'>", $write_pages);
		$write_pages = str_replace("이전", "<img src='$pagebt2' border='0' align='absmiddle' class='pt2' title='이전'>", $write_pages);
		$write_pages = str_replace("다음", "<img src='$pagebt3' border='0' align='absmiddle' class='pt2' title='다음'>", $write_pages);
		$write_pages = str_replace("맨끝", "<img src='$pagebt4' border='0' align='absmiddle' class='pt2' title='맨끝'>", $write_pages);
		//$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
		$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
		echo $write_pages;
	}
	?>
</div>

<script type="text/javascript">
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('Comment').value = document.getElementById('Comment').value.replace(pattern, "");
    
    if (!document.getElementById('Comment').value)
    {
        alert("코멘트를 입력하여 주십시오.");
        return false;
    }
	<? if(!$is_comment_write){ ?>
		alert('권한이 없습니다.');
		return false;
	<? } else { ?>
	return true;
	<? } ?>
}


function comment_box(comment_id, work)
{
    var el_id;
    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }
        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 코멘트 수정
        if (work == 'cu')
        {
            document.getElementById('Comment').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('Comment', 'char_count');
			/*
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('comment_secret').checked = true;
            else
                document.getElementById('comment_secret').checked = false;
				*/
        }

        document.getElementById('CommentIdx').value = comment_id;
        document.getElementById('cmode').value = work;

        save_before = el_id;
    }
}

function comment_delete(idx)
{
    if (!confirm("이 코멘트를 삭제하시겠습니까?")) return;

	var f = document.fviewcomment;
	f.CommentIdx.value = idx;
	f.cmode.value = "d";
	f.submit();
}

comment_box('', 'c'); // 코멘트 입력폼이 보이도록 처리하기위해서 추가 (root님)
</script>
