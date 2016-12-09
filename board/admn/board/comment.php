<!-- 댓글 테이블 시작 -->
<?
$rp = $_SERVER['PHP_SELF'];

$is_comment_write = false;
//print_r2($user);
if($board_setting["CommentFlag"] == 1){
	$is_comment_write = true;
}

$csql = " select * from ".$site_prefix."board_comment where DBName = '$mode' and BoardIdx = '".$view[BoardIdx]."' order by comment_cnt, comment_reply ";
$cresult = sql_query($csql);

for($i=0;$crow = sql_fetch_array($cresult);$i++){
	$list[$i] = $crow;
}

for($i=0;$i<sizeof($list);$i++){
	$list[$i][content] = $list[$i][content1] = "비밀글 입니다.";

	if(strstr($list[$i][comment_option],"secret") || ($view[UserID] == $user[ID] && !empty($user[ID])) || ($list[$i][UserID] == $user[ID] && !empty($user[ID])) || $is_admin){
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
				$list[$i][del_link] = "./delete_comment.php?comment_id=".$list[$i][CommentIdx]."&bid=".$bid."&BoardIdx=".$BoardIdx."&page=".$page."&searchName=".$searchName."&searchTitle=".$searchTitle;
				$list[$i][is_edit] = true;
				$list[$i][is_del] = true;
			}
		} else {
			//비회원이 댓글 썼을때 처리 rootin. 나중에처리하자.
			if(!$list[$i][UserID]){
				$list[$i][del_link] = "./password.php?w=x&comment_id=".$list[$i][CommentIdx]."&bid=".$bid."&BoardIdx=".$BoardIdx."&page=".$page."&searchName=".$searchName."&searchTitle=".$searchTitle;
				$list[$i][is_del] = true;
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
<table class="commt_table mb20">
	<tbody class="tb">
<?
for ($i=0; $i<count($list); $i++) {
    $comment_id = $list[$i][CommentIdx];
	
	$inum = substr($cmember["memberType"],0,1);
	if(empty($inum)) $inum = "a";
?>
	<tr>
		<td>
			<table width='100%'  border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr>
					<td ><? for ($k=0; $k<strlen($list[$i][comment_reply]); $k++) echo "<img src='/board/admn/images/btn/bt_re.gif' class='pl5 pl5'/>"; ?></td>
					<td width="100%">
						<table width="100%">
							<tr>
								<td class="name">
									<strong><?=$list[$i]["UserName"]?></strong>&nbsp;
									<span class='d_bar'>|</span>&nbsp;
									<?=$list[$i][datetime]?>&nbsp;
									<span class='d_bar'>|</span>
									<? if ($list[$i]["is_reply"]){ ?><button type="button" class="sbtn_a_b" onclick="comment_box('<?=$comment_id?>','c');">R</button>&nbsp;<? } ?>
									<? if ($list[$i]["is_edit"]){ ?><button type="button" class="sbtn_a_b" onclick="comment_box('<?=$comment_id?>','cu');">E</button>&nbsp;<? } ?>
									<? if ($list[$i]["is_del"]){ ?><button type="button" class="sbtn_a_n" onclick="comment_delete('<?=$comment_id?>');">X</button><? } ?>
								</td>
							</tr>
							<tr>
								<td class="content">
									<?
									if (strstr($list[$i][comment_option], "secret")) echo "<span style='color:#ff6600;'>*</span> ";
									$str = $list[$i][content];
									if (strstr($list[$i][comment_option], "secret"))
										$str = "<span class='small' style='color:#ff6600;'>$str</span>";

									$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
									// FLASH XSS 공격에 의해 주석 처리 - 110406
									//$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
									$str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $str);
									echo $str;
									?>
								</td>
							</tr>
						</table>
						<div style='width:100%;'>
							<span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
							<span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
							<input type=hidden id='secret_comment_<?=$comment_id?>' value="<?=strstr($list[$i][wr_option],"secret")?>">
							<textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][content1], 0)?></textarea>
							<input type=hidden id='uname_comment_<?=$comment_id?>' value="<?=$list[$i]["UserName"]?>">
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<?
}
?>
	</tbody>
</table>
<div id="comment_write" style="display:none;">
<form name="fviewcomment" method="post" action="/board/admn/board/comment_ok.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
<input type="hidden" name="CommentIdx" id='CommentIdx'	value=''>
<input type="hidden" name="page"						value='<?=$page?>'>
<input type="hidden" name="idx"							value="<?=$view['BoardIdx']?>">
<input type="hidden" name="cmode" id="cmode"			value="c">
<input type="hidden" name="bidx"						value="<?=$bidx?>">
<input type="hidden" name="Category"					value="<?=$Category?>">
<input type="hidden" name="workType"					value="<?=$workType?>">
<input type="hidden" name="mode"						value="<?=$mode?>">
<input type="hidden" name="sT"							value="<?=$sT?>">
<input type="hidden" name="sF"							value="<?=$sF?>">
<input type="hidden" name="url"							value="<?=$_SERVER['PHP_SELF']?>">

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="write_table">
	<tr>
		<td class="bd0">
			<div style="width:100%;" class="pt5 pb5">작성자 : <input type="text" name="UserName" id="UserName" class="input wd100"> <input name="comment_secret" type="checkbox" id="comment_secret"  value="secret"/>비밀글</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" class="bd0"><textarea name="Comment" id="Comment" style="width:98%; height:40px;" class="textbox_white"><?=$Comment?></textarea></td>
					<td width="70" class="bd0"><button type="button" class="btn_a_b" onclick="this.form.submit();">등 록</button></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</div>
<!-- 댓글 테이블 끝 -->
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

	return true;
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
			document.getElementById('UserName').value = document.getElementById('uname_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('Comment', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('comment_secret').checked = true;
            else
                document.getElementById('comment_secret').checked = false;
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
	</td>
</tr>