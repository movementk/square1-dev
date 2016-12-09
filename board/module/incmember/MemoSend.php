<?

$memo_idx = $_REQUEST["memo_idx"];

$sql = " select * from ".$site_prefix."member where UserID = '".$user[ID]."' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

if($memo_idx){
	$read_sql = " select * from ".$site_prefix."memo where idx = '".$memo_idx."' ";
	$read_result = mysql_query($read_sql);
	$read_row = mysql_fetch_array($read_result);

	if($tn == "1"){
		$update_sql = " update ".$site_prefix."memo set ";
		$update_sql .= " read_datetime = now() ";
		$update_sql .= " where idx = '".$memo_idx."' ";
		$update_result = mysql_query($update_sql);
		if(!$update_result) err_back("읽은시간 수정 실패.");
	}
}

for($j=1;$j<4;$j++){
	${"ton".$j} = "_off";
}

if($tn == "1"){
	$ton1 = "_on";
} else if($tn == "2"){
	$ton2 = "_on";
} else if($tn == "3"){
	$ton3 = "_on";
}
if($memo_code == "recv"){
	$tit1 = "보낸";
	
} else if($memo_code == "send"){
	$tit1 = "받는";
	
}

//echo $sunick;

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="115"><img src="../img/bbs/popup_note_tab1<?=$ton1?>.gif" name="tab_btn1" id="tab_btn1" style="cursor:pointer" onClick="location.href='popup_note.php?tn=1'"></td>
					<td width="115"><img src="../img/bbs/popup_note_tab2<?=$ton2?>.gif" name="tab_btn2" id="tab_btn2" style="cursor:pointer" onClick="location.href='popup_note.php?tn=2'"></td>
					<td width="115"><img src="../img/bbs/popup_note_tab3<?=$ton3?>.gif" name="tab_btn3" id="tab_btn3" style="cursor:pointer" onClick="location.href='popup_note.php?tn=3'"></td>
					<td align="right">&nbsp;</td>
				</tr>
			</table>                                
		</td>
	</tr>
	<tr>
		<td valign="top">
			<!-- list Begin -->
			<table width="100%" cellpadding="0" cellspacing="0">
			<form name="memo_write" method="post" action="../../../board/module/incmember/memo_ok.php">
			<input type="hidden" name="send_mb_nick" value="<?=$row[UserName]?>">
			<input type="hidden" name="send_mb_id" value="<?=$row[UserID]?>">
			<input type="hidden" name="memo_idx" value="<?=$memo_idx?>">
			<input type="hidden" name="tn" value="<?=$tn?>">

				<tr>
					<td width="100" valign="top" bgcolor="#f4f4f4" class="txt_green_b" style="padding-left:10px; padding-top:10px;"><?=$tit1?> 회원별명</td>
					<td bgcolor="#f4f4f4" class="pt10">
						<? if($tn == "3"){ ?>
						<? if($sunick != ""){ ?>
						<input type="text" name="recv_mb_nick" id="recv_mb_nick" class="textbox_nobg" style="width:400px;" value="<?=$sunick?>"><br>
						<? } else if($_POST["uname"] == ""){ ?>
						<input type="text" name="recv_mb_nick" id="recv_mb_nick" class="textbox_nobg" style="width:400px;" value="<?=$read_row["recv_mb_nick"]?>"><br>
						<? } else { ?>
						<input type="text" name="recv_mb_nick" id="recv_mb_nick" class="textbox_nobg" style="width:400px;" value="<?=$_POST["uname"]?>"><br>
						<? } ?>
						* 여러회원에게 보낼때는 컴마(,)로 구분하세요.
						<? } else { ?>
						<?=$read_row["recv_mb_nick"]?>
						<? } ?>
					</td>
				</tr>
				<tr>
					<td bgcolor="#f4f4f4">&nbsp;</td>
					<td align="left" bgcolor="#f4f4f4">
						<? if($tn == "3"){ ?>
						<textarea name="memo" id="memo" cols="45" rows="10" class="textbox_nobg" style="width:650px; height:150px;"><?=$read_row["memo"]?></textarea>
						<? } else { ?>
						<table width="95%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td bgcolor="#ffffff" height="180" style="padding:10px;" valign="top">
									<?=nl2br($read_row["memo"])?>
								</td>
							</tr>
						</table>
						<? } ?>
					</td>
				</tr>
				
				<tr>
					<td colspan="2" height="45" align="center" bgcolor="#f4f4f4"><? if($tn=="3"){ ?><input type="image" src="../img/bbs/btn_note_send.gif" alt="쪽지 보내기"><? } else { ?><a href="popup_note.php?tn=<?=$tn?>"><img src="../img/bbs/btn_list_view.jpg"></a><? } ?></td>
				</tr>
				
			</form>
			</table>
			<!-- list End --> 			                              
		</td>
	</tr>
	
</table>
