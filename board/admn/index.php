<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
if($is_admin){	
	GetAlert("","main.php?".$URI);
}
?>
<div id="login_content">
	<div class="login_left">
		<div class="login_logo">
			<img src="images/login_logo.gif">
		</div>
	</div>
	<div class="login_right">
		<div class="login_box">
			<form name="frm" action="/board/admn/_proc/admin_login_ok.php" method="post" onsubmit="return admin_check();">
			<input type="hidden" name="URI" value="<?=$URI?>">
			<table>
				<colgroup>
					<col style="width:100px;"></col>
					<col style="width:230px;"></col>
					<col style=""></col>
				</colgroup>
				<tbody>
				<tr>
					<th><img src="images/login_id.gif"></th>
					<td><input type="text" name="admin_id"  id='admin_id' maxlength='20' exp title="아이디" style="ime-mode:inactive;" class="login_input" tabindex="1"></td>
					<td rowspan="2"><input type="image" src="images/login_btn.gif"></td>
				</tr>
				<tr>
					<th><img src="images/login_pw.gif"></th>
					<td><input type="password" name="admin_pwd" id='admin_pwd' maxlength='20' exp title="비밀번호" class="login_input" tabindex="2"></td>
				</tr>
				<tr>
					<th></th>
					<td colspan="2"><img src="images/login_txt.gif"></td>
				</tr>
				</tbody>
			</table>
			</form>
		</div>
	</div>
</div>

<script language="javascript">
function admin_check(){
	var f = document.frm;
	if(FormCheck(f) == true){
		return true;
	} else {
		return false;
	}
}
$("#admin_id").focus();
</script>
<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/tail.php";
?>