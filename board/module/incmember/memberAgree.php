<?
if($is_member) err_back("Already Login.");
?>
<script>
function chk_frm(){
	var f = document.agree;
	if(f.agree11.checked == false){
		alert('회원가입약관에 동의하시기 바랍니다.');
		return false;
	} else if(f.agree21.checked == false){
		alert('개인정보 취급방침에 동의하시기 바랍니다.');
		return false;
	}
/*
	if(f.mailchk.value == "No"){
		alert("회원가입여부를 확인해주시기 바랍니다.");
		return false;
	}
*/
	if(FormCheck(f) == true){
		f.action = "/member/join2.php";
		f.submit();
	}
}
function email_ck(){
	jQuery.ajax({
		url: "/board/config/ajax/ajax_mailck.php",
		type: 'POST',
		data: "val=" + $("#Email1").val() + "@" + $("#Email2").val(),

		error: function(xhr,textStatus,errorThrown){
			alert('An error occurred! by cv \n'+(errorThrown ? errorThrown : xhr.status));
		},
		success: function(data){
			$("#span_dupeck").html(data);
		}
	});
}
</script>
<form name="agree" method="post" onsubmit="return chk_frm();">
<!--이용약관동의-->
<div class="pt60">
	<div class="st_line">이용약관</div>
	<div class="pt20">
		<div name="use" readonly="readonly" class="agree_form" id="use" style="width:98%;overflow-y:auto;"><?=get_agree(1)?></div>
	</div>
	<div class="agree_txt"><input type="checkbox" name="agree1" id="agree11" value="1"><label for="agree01" class="pl5">이용약관에 동의합니다.</label></div>
</div>
<!--//이용약관동의-->

<!--개인정보취급방침-->
<div class="pt60">
	<div class="st_line">개인정보취급방침</div>
	<div class="pt20">
		<div name="privacy" id="privacy" readonly="readonly" class="agree_form" style="width:98%;overflow-y:auto;"><?=get_agree(2)?></div>
	</div>
	<div class="agree_txt"><input type="checkbox" name="agree2" id="agree21" value="1"><label for="agree02" class="pl5">개인정보 취급방침에 동의합니다.</label></div>
</div>
<!--//개인정보취급방침-->

<div class="fcenter">
	<ul class="btn2">
		<li><input type="image" src="../image/member_img/next_step_btn.jpg" alt="다음단계"></a></li>
		<li class="pl5"><a href="/"><img src="../image/member_img/cancel_btn.jpg" alt="취소"></a></li>
	</ul>
</div> 

</form>
