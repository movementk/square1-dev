<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr id="tab1">
		<td valign="top" style="padding-top:5px;">
			<?
			$memo_code = "recv";
			if($memo_idx){
				include "../board/module/incmember/MemoSend.php";
			} else {
				include "../board/module/incmember/MemoList.php";
			}
			?>
		</td>
	</tr>
	<tr id="tab2" style="display:none">
		<td valign="top" style="padding-top:5px;">
			<?
			$memo_code = "send";
			if($memo_idx){
				include "../board/module/incmember/MemoSend.php";
			} else {
				include "../board/module/incmember/MemoList.php";
			}
			?>
		</td>
	</tr>
	<tr id="tab3" style="display:none">
		<td valign="top" style="padding-top:5px;">
			<?						
			include "../board/module/incmember/MemoSend.php";
			?>			
		</td>
	</tr>
</table>
<script>
function all_checked(sw,ct,dv) {
	
	for (var i=0; i<ct; i++) {
		if(dv == "recv"){
			document.getElementById("chk_recv_id["+i+"]").checked = sw;
		} else {
			document.getElementById("chk_send_id["+i+"]").checked = sw;
		}
	}
}
</script>