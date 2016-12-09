<script type="text/javascript">
<!--
function check_login() {
	var expCk = true;
	$(".exp").each(function(){
		if(expCk){
			if($(this).val() == ""){
				alert($(this).attr("title")+"은(는) 필수입력사항 입니다.");
				expCk = false;
			}
		}
	});

	if(expCk){
		document.loginForm.submit();
	}
}
//-->
</script>
<?
if(empty($URI)) $URI = "/";
if($is_member) GetAlert("",$URI); 
?>
<!--login start-->
<!-- Contents 시작 -->
<form name="loginForm" method="post" action="/board/module/incmember/login_ok.php">
<input type="hidden" name="URI" value="<?=$URI?>">

<div class="form-group">
	<input type="text" id="user-id" class="form-control exp" placeholder="아이디" name="UserID" title="아이디">
	<input type="password" id="user-pw" class="form-control exp" placeholder="비밀번호" name="Password1" title="비밀번호">
</div>
<div class="btn-area">
	<p>
		<a href="javascript:;" class="btn btn-gray" role="button" onclick="check_login()">로그인</a>
	</p>
</div>
</form>

