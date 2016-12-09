<form name="pass_form" method="post" action="<?=$returnpage?>">
<input type="hidden" name="BoardIdx" value="<?=$BoardIdx?$BoardIdx:$board_idx?>">
<input type="hidden" name="board_code" value="<?=$board_code?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="Category" value="<?=$Category?>">
<input type="hidden" name="workType" value="<?=$workType?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="sT" value="<?=$sT?>">
<input type="hidden" name="sF" value="<?=$sF?>">
<input type="hidden" name="URI" value="<?=$URI?>">
<section class="confirm">
	<div class="section-header">
		<h2>SQUARE<i>1</i> 1:1문의</h2>
		<h3>
			스퀘어원과 관련된 궁금한 사항은<br>
			무엇이든 물어보세요.
		</h3>
		<p>
			제안ㆍ건의ㆍ만족ㆍ불만족 등과<br class="visible-xs">
			관련된 고객님의 소중한 의견을 남겨주시면<br>
			접수후 빠른 대응을 하도록하겠습니다.
		</p>
	</div>
	<div class="section-content">
		<div class="confirm-form">
			<form>
				<h4>비밀번호확인</h4>
				<p class="circle"><i></i><i></i><i></i><i></i></p>
				<p class="c-txt">고객님의 비밀번호를 입력해주세요.</p>
				<div class="form-group">
					<input type="password" id="u-pw" class="form-control exp" placeholder="비밀번호" name="password1">
					<label for="u-pw" class="sr-only">비밀번호 확인</label>
					<p class="btn-basics">
						<a href="javascript:pwd_submit();" class="btn btn-gray" role="button">확인</a>
					</p>
				</div>
			</form>
		</div>
	</div>
</section>
</form>
<script language='JavaScript'>
document.pass_form.password1.focus();

function pwd_submit(){
	var form = document.pass_form;
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
		form.submit();
	}
}
</script>