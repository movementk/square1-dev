<?
$PageBlock   = 10;  //넘길 페이지 갯수
$board_list_num = 10;                     //게시판 게시글 수
$pagebt1="../img/bbs/arrow_first.jpg";
$pagebt2="../img/bbs/arrow_prev.jpg";
$pagebt3="../img/bbs/arrow_next.jpg";
$pagebt4="../img/bbs/arrow_last.jpg";


if(isset($_REQUEST["page"]) && $page !=""){
 $page = $_REQUEST["page"];
}else{
 $page = 1;
}
if(isset($_REQUEST["start_page"]) && $_REQUEST["start_page"] != ""){
  $start_page  = $_REQUEST["start_page"]; 
}else{
  $start_page  = 0;
}

$start_for = ($PageBlock*$start_page)+1; //for문 처음 시작 수
$last_for  = ($start_for+$PageBlock)-1;  //for문 끝나는 수
$start_list_num = ($page - 1)*$board_list_num; //게시글 시작 번호


if($memo_code == "recv"){
	//echo "1";
	$tit1 = "보낸";
	$tit2 = "내가 ";
	$totalsql1 = " select * from ".$site_prefix."memo where recv_mb_id = '".$user[ID]."' ";
	$totalsql1 .= " and memo_flag = 'yes' ";
	$totalsql1 .= " order by send_datetime desc ";
	$sql1 = $totalsql1." limit ".$start_list_num.",".$board_list_num;
	
	$result1 = mysql_query($sql1);
	$totalresult1 = mysql_query($totalsql1);
	$TotalCount = mysql_num_rows($totalresult1);
	for($i=0;$row1=mysql_fetch_array($result1);$i++){
		$recv_memo_list[$i] = $row1;
		$recv_memo_list[$i]["Nick"] = $row1["send_mb_nick"];
	}
	$Count = count($recv_memo_list);
	$memo_list = $recv_memo_list;
} else if($memo_code == "send"){
	//echo "2";
	$tit1 = "받는";
	$tit2 = "상대가 ";
	$totalsql2 = " select * from ".$site_prefix."memo where send_mb_id = '".$user[ID]."' ";
	$totalsql2 .= " and memo_flag2 = 'yes' ";
	$totalsql2 .= " order by send_datetime desc ";
	$sql2 = $totalsql2." limit ".$start_list_num.",".$board_list_num;
	
	$result2 = mysql_query($sql2);
	$totalresult2 = mysql_query($totalsql2);
	$TotalCount = mysql_num_rows($totalresult2);
	for($i=0;$row2=mysql_fetch_array($result2);$i++){
		$send_memo_list[$i] = $row2;
		$send_memo_list[$i]["Nick"] = $row2["recv_mb_nick"];		
	}
	$Count = count($send_memo_list);
	$memo_list = $send_memo_list;
}

$TotalPage   = $TotalCount/$board_list_num;
$TotalPage   = (int)$TotalPage;

if($TotalCount%$board_list_num != 0){
   $TotalPage++;                           //총 페이지 수
}
if($TotalPage >= $PageBlock){
	$last_page = ($TotalPage/$PageBlock)-1;
	$last_page   = (int)$last_page;

	if($TotalPage%$PageBlock != 0){
	   $last_page++;                           //마지막 페이지
	}
}
else{
    $last_page = 0;
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


//echo $memo_code;
//echo $sql;
//print_r2($memo_list);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
		
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="115"><img src="../img/bbs/popup_note_tab1<?=$ton1?>.gif" name="tab_btn1" id="tab_btn1" style="cursor:pointer" onClick="location.href='popup_note.php?tn=1'"></td>
					<td width="115"><img src="../img/bbs/popup_note_tab2<?=$ton2?>.gif" name="tab_btn2" id="tab_btn2" style="cursor:pointer" onClick="location.href='popup_note.php?tn=2'"></td>
					<td width="115"><img src="../img/bbs/popup_note_tab3<?=$ton3?>.gif" name="tab_btn3" id="tab_btn3" style="cursor:pointer" onClick="location.href='popup_note.php?tn=3'"></td>
					<td align="right">전체 쪽지 <strong><?=$TotalCount;?></strong>통</td>
				</tr>
			</table>
			
		</td>
	</tr>
	<tr>
		<td valign="top">
			<!-- list Begin -->
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td height="1" colspan="7" align="center" bgcolor="#c5c5c5"></td>
				</tr>
				<tr>
					
					<td width="30" align="center" bgcolor="#f4f4f4" class="txt_green_b"><input onclick="if (this.checked) all_checked(true,'<?=$Count?>','<?=$memo_code?>'); else all_checked(false,'<?=$Count?>','<?=$memo_code?>');" type="checkbox"></td>					
					<td width='100' height="25" align="center" bgcolor="#f4f4f4" class="txt_green_b"><?=$tit1?>사람</td>
					<td width='130' align="center" bgcolor="#f4f4f4" class="txt_green_b">보낸시간</td>
					<td align="center" bgcolor="#f4f4f4" class="txt_green_b">내용</td>
					<td width='130' align="center" bgcolor="#f4f4f4" class="txt_green_b"><?=$tit2?>읽은시간</td>
					<? if($memo_code == "recv"){ ?>
					<td width="80" align="center" bgcolor="#f4f4f4" class="txt_green_b">답장하기</td>
					<? } ?>
					
					<td width='80' align="center" bgcolor="#f4f4f4" class="txt_green_b">쪽지삭제</td>
					
				</tr>
				<tr>
					<td height="1" colspan="7" align="center" bgcolor="#c5c5c5"></td>
				</tr>
				<? for($i=0;$i<$Count;$i++){ ?>
				<?
				if(date("Y-m-d",time()) == substr($memo_list[$i][send_datetime],0,10)){
					$sendtime = substr($memo_list[$i][send_datetime],10,9);
				} else {
					$sendtime = substr(substr($memo_list[$i][send_datetime],0,10),2,10);
				}
				if(date("Y-m-d",time()) == substr($memo_list[$i][read_datetime],0,10)){
					$readtime = substr($memo_list[$i][read_datetime],10,9);
				} else if($memo_list[$i][read_datetime] == "0000-00-00 00:00:00"){
					$readtime = "읽지않음";
				} else {
					$readtime = substr(substr($memo_list[$i][read_datetime],0,10),2,10);
				}
				?>
				<form name="memo_<?=$memo_code?>_list<?=$i?>" method="post" onsubmit="return Mlist_submit(this);">
				<input type="hidden" name="memo_idx" value="<?=$memo_list[$i]["idx"]?>">
				<input type="hidden" name="tn" value="<?=$tn?>">
				<input type="hidden" name="memo_work_type" value="del">
				<input type="hidden" name="memo_code" value="<?=$memo_code?>">
				<tr>
					
					<td align="center" class="line_bt"><input type=checkbox name="chk_<?=$memo_code?>_id[<?=$i?>]" value="<?=$memo_list[$i][idx]?>"></td>					
					<td height="30" align="center" class="line_bt"><?=$memo_list[$i]["Nick"]?></td>
					<td align="center" class="line_bt"><?=$sendtime?></td>
					<td align="center" class="line_bt"><a href="popup_note.php?tn=<?=$tn?>&memo_idx=<?=$memo_list[$i][idx]?>&memo_code=<?=$memo_code?>"><?=cut_mb_string($memo_list[$i]["memo"],30,"..")?></a></td>
					<td align="center" class="line_bt"><?=$readtime?></td>
					<? if($memo_code == "recv"){ ?>
					<td align="center" class="line_bt"><a href="popup_note.php?tn=3&sunick=<?=$memo_list[$i]["Nick"]?>"><img src="../img/bbs/btn_re.gif" alt="답장" style="cursor:hand;"></a></td>
					<? } ?>
					
					<td align="center" class="line_bt"><input type="image" src="../img/bbs/btn_delete4.gif" alt=" 삭제"></td>
					
				</tr>
				</form>
				<? } ?>
				<tr>
					<td align="center" colspan="7" height="40">
						<!--page start-->
						<? if($Count>0){ ?>
						<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
							<TR>
								<TD align="center" height="40">
								<? if($pagebt1){?>
									<a href="<?=$_SERVER["PHP_SELP"]?>?tn=<?=$tn?>&page=1&start_page=0"><img src="<?=$pagebt1?>" align="absmiddle" /></a>
								<? }?>
								<?if($page > $PageBlock ){?>
									<a href="<?=$_SERVER["PHP_SELP"]?>?tn=<?=$tn?>&page=<?=$start_for-$PageBlock?>&start_page=<?=$start_page-1?>"><img src="<?=$pagebt2?>" align="absmiddle" />&nbsp;</a>
								<? } for($i=$start_for;$i<=$last_for;$i++){ if($i > $TotalPage){ continue; } ?>
								&nbsp;<a href="<?=$_SERVER["PHP_SELP"]?>?tn=<?=$tn?>&page=<?=$i?>&start_page=<?=$start_page?>">
								<?if($page == $i){ echo "<font color='#ec7ea5'><strong>".$i."</strong></font>"; }else{ echo "<font color='#666666'>".$i."</font>"; } ?></a>&nbsp;
								<?
								} if(!$Count || $page == ""){
									echo "<font color='#666666'><strong> 1 </strong></font>";
								}
								?>
								<?if($start_for+$PageBlock <= $TotalPage){?>
									<a href="<?=$_SERVER["PHP_SELP"]?>?tn=<?=$tn?>&page=<?=$start_for+$PageBlock?>&start_page=<?=$start_page+1?>&key=<?=$key?>&keyword=<?=$keyword?>&date_idx=<?=$date_idx?>">&nbsp;&nbsp;<img src="<?=$pagebt3?>" align="absmiddle" /></a>
								<?}?>
								<? if($pagebt1){?>
									<a href="<?=$_SERVER["PHP_SELP"]?>?tn=<?=$tn?>&page=<?=$TotalPage?>&start_page=<?=$last_page?>"><img src="<?=$pagebt4?>"  align="absmiddle"/></a>
								<? }?>
							</TD>
						</TR>
					</table>
					<? } ?>
					<!--page end-->
					</td>
				</tr>
				<tr>
					<td height="30" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
			<!-- list End -->		
		</td>
	</tr>
	<tr>
        <td height="40" align="right" valign="bottom" style="padding-right:10px;padding-top:20px;"><a href="javascript:all_del('<?=$memo_code?>','<?=$Count?>','<?=$tn?>')"><img src="/img/bbs/btn_delete.gif"></a>&nbsp;<a href="javascript:parent.close();"><img src="../img/bbs/btn_close.jpg" alt="close" /></a></td>
    </tr>
</table>

<script type="text/javascript">
function Mlist_submit(f){
	if(!confirm("정말 쪽지를 삭제하시겠습니까?")) return false;
	f.action = "../../../board/module/incmember/memo_ok.php";
	return true;
}

</script>