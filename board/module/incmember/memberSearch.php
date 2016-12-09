<script type="text/javascript">
<!--
function chk_id(f){
	var expCk = true;
	var target = $("form[name='"+f+"']").find(".exp");
	target.each(function(){
		if(expCk){
			if($(this).val() == ""){
				alert($(this).attr("title")+"은(는) 필수입력사항 입니다.");
				expCk = false;
			}
		}
	});

	if(expCk){
		$("form[name='"+f+"']").submit();
	}
}

function form_reset(f){
	$("form[name='"+f+"']").each(function(){
		this.reset();
	});
}

//-->
</script>

<div class="section-content">
	<h3>아이디 찾기</h3>
	<div class="id-find">
		<form name="idform1" method="post" action="/board/module/incmember/memberSearch_ok.php">
		<input type="hidden" name="workType" value="ID1">
		<input type="hidden" name="URI" value="/member/login.php">
			<div class="find-form">
				<dl>
					<dt><label for="u-name">이름</label></dt>
					<dd><input type="text" id="u-name" class="form-control exp" name="UserName" title="이름"></dd>
					<dt class="mt-dt"><label for="u-mail">E-MAIL</label></dt>
					<dd>
						<input type="email" id="u-mail" class="form-control exp" name="Email" title="이메일">
						<p class="reference">가입하신 이메일 주소로 아이디가 발송됩니다.</p>
					</dd>
				</dl>
			</div>
			<div class="btn-area">
				<p>
					<a href="javascript:;" onclick="chk_id('idform1');" class="btn btn-orange" role="button">확인</a>
					<a href="javascript:;" onclick="form_reset('idform1');" class="btn btn-default" role="button">취소</a>
				</p>
			</div>
		</form>
	</div>
	<h3>비밀번호 찾기</h3>
	<div class="pw-find">
		<form name="pwform1" method="post" action="/board/module/incmember/memberSearch_ok.php">
		<input type="hidden" name="workType" value="PW1">
		<input type="hidden" name="URI" value="/member/login.php">
			<div class="find-form">
				<dl>
					<dt><label for="u-name2">이름</label></dt>
					<dd><input type="text" id="u-name2" class="form-control exp" name="UserName" title="이름"></dd>
					<dt class="mt-dt"><label for="u-id">아이디</label></dt>
					<dd><input type="text" id="u-id" class="form-control exp" name="UserID" title="아이디"></dd>
					<dt class="mt-dt"><label for="u-mail2">E-MAIL</label></dt>
					<dd>
						<input type="email" id="u-mail2" class="form-control exp" name="Email" title="이메일">
						<p class="reference">가입하신 이메일 주소로 아이디가 발송됩니다.</p>
					</dd>
				</dl>
			</div>
			<div class="btn-area">
				<p>
					<a href="javascript:;" onclick="chk_id('pwform1');" class="btn btn-orange" role="button">확인</a>
					<a href="javascript:;" onclick="form_reset('pwform1');" class="btn btn-default" role="button">취소</a>
				</p>
			</div>
		</form>
	</div>
</div>