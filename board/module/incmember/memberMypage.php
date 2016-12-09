<?
if($is_member){
	$method="modify";
	$zipcode = explode("-",$member["ZipCode"]);
	$mobile = explode("-",$member["Mobile"]);
	$email = explode("@",$member["Email"]);
}else{
	GetAlert('로그인후 이용하시기 바랍니다.',$loc."/member/login.php");
	exit;
}

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {   //https 통신일때 daum 주소 js
	echo '<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>';
} else {  //http 통신일때 daum 주소 js
	echo '<script src="http://dmaps.daum.net/map_js_init/postcode.js"></script>';
}
//print_r2($ZipCode);
?>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />
<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
.bd0 { border:none; }
-->
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
<script type="text/javascript">
/* Korean initialisation for the jQuery calendar extension. */
/* Written by DaeKwon Kang (ncrash.dk@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ko'] = {
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

	$('.datepick').datepicker({
        showOn: 'button',
		buttonImage: '/board/admn/images/common/calendar.gif',
		buttonImageOnly: true,
        buttonText: "달력",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
        yearRange: 'c-99:c+99',
        maxDate: '+0d'
    }); 

	$('img.ui-datepicker-trigger').attr('align', 'absmiddle'); 
});
</script>
<form name="MemberForm" action="/board/module/incmember/member_ok.php" method="post">
<input type="hidden" name="method" value="<?=$method?>">
<input type="hidden" name="UserID" value="<?=$member["UserID"]?>">
<input type="hidden" name="UserName" value="<?=$member["UserName"]?>">
<input type="hidden" name="NickName" value="<?=$member["NickName"]?>">
<input type="hidden" name="namechk" value="No">
<input type="hidden" name="UserLevel" value='<?=$member["UserLevel"]?>'>
<input type="hidden" name="URI" value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='hpchk' value='Yes'>
<input type="hidden" name="mailchk" value="Yes">
<input type="hidden" name="oEmail" id="old_email" value="<?=$member["Email"]?>">
<input type="hidden" name="oMobile" id="old_mobile" value="<?=$member["Mobile"]?>">
<input type="hidden" id="old_mobile_company" value="<?=$member["MobileCompany"]?>">
<input type="hidden" name="mem_photo" value="<?=$member["mem_photo"]?>">
	<div class="input-form type-1">
		<dl>
			<dt class="bold-before">
				<label for="u-name">이름</label>
			</dt>
			<dd>
				<?=$member["UserName"]?>
			</dd>
			<dt class="bold-before">
				<label for="user-id">아이디</label>
			</dt>
			<dd class="user-dd user-id">
				<?=$member["UserID"]?>
			</dd>
			<dt class="card">
				<label for="point-card">포인트카드번호</label>
			</dt>
			<dd class="user-dd">
				<input type="text" id="point-card" class="form-control" placeholder="※ 포인트카드번호를 입력해 주세요.">
				<p class="btn-basics">
					<a href="#" class="btn" role="button">중복확인</a>
				</p>
				<p class="attention">
					※ 포인트카드번호를 입력해 주세요.
				</p>
			</dd>
			<dt class="bold-before">
				<label for="user-pw">비밀번호</label>
			</dt>
			<dd class="user-pw">
				<input type="password" id="user-pw" class="form-control exp" placeholder="※ 영문, 숫자 조합 6~12자" name="Password1" title="비밀번호">
				<p class="attention">
					※ 영문, 숫자 조합 6~12자
				</p>
			</dd>
			<dt class="bold-before">
				<label for="user-pw">새로운 비밀번호</label>
			</dt>
			<dd class="user-pw">
				<input type="password" id="user-pw" class="form-control" placeholder="※ 영문, 숫자 조합 6~12자" name="NPassword1" title="비밀번호">
				<p class="attention">
					※ 영문, 숫자 조합 6~12자
				</p>
			</dd>
			<dt class="bold-before">
				<label for="confirm-pw">새로운 비밀번호확인</label>
			</dt>
			<dd>
				<input type="password" id="confirm-pw" class="form-control" name="NPassword2" title="비밀번호">
			</dd>
			<dt class="bold-before">
				<label for="email">E-MAIL</label>
			</dt>
			<dd class="user-dd">
				<input type="text" id="email" class="form-control exp" name="Email" title="이메일" value="<?=$member["Email"]?>" />
				<p class="btn-basics">
					<a href="javascript:;" class="btn" role="button" onclick="mail_chk()">중복확인</a>
				</p>
			</dd>
			
			
			<dt class="bold-before">
				휴대폰번호
			</dt>
			<dd class="phone">
				<select class="form-control exp" name="mobile1" id="phone1" title="휴대폰번호">
					<option value="">선택</option>
					<option value="010" <?=$mobile[0]=="010"?"selected":""?>>010</option>
					<option value="011" <?=$mobile[0]=="011"?"selected":""?>>011</option>
					<option value="016" <?=$mobile[0]=="016"?"selected":""?>>016</option>
					<option value="017" <?=$mobile[0]=="017"?"selected":""?>>017</option>
					<option value="018" <?=$mobile[0]=="018"?"selected":""?>>018</option>
					<option value="019" <?=$mobile[0]=="019"?"selected":""?>>019</option>
				</select> &nbsp;&nbsp;-&nbsp;&nbsp;
				<label for="phone2" class="sr-only">두번째 번호</label>
				<input type="text" id="phone2" class="form-control exp" name="mobile2" value="<?=$mobile[1]?>" title="휴대폰번호"> &nbsp;&nbsp;-&nbsp;&nbsp;
				<label for="phone3" class="sr-only">마지막 번호</label>
				<input type="text" id="phone3" class="form-control exp" name="mobile3" value="<?=$mobile[2]?>" title="휴대폰번호">
			</dd>
			<dt class="bold-before">
				이메일수신동의
			</dt>
			<dd>
				<div class="check-box">
					<label><input type="checkbox" name="EmailFlag" id="EmailFlag1" value="Y" class="agrees" <?=$member["EmailFlag"]=="Y"?"checked":""?>>동의합니다.</label>
					<label><input type="checkbox" name="EmailFlag" id="EmailFlag2" value="N" class="agrees" <?=$member["EmailFlag"]=="N"?"checked":""?>>동의하지 않습니다.</label>
				</div>
			</dd>
		</dl>
	</div>
	<div class="btn-area">
		<p class="pull-left">
			<a href="javascript:;" class="btn btn-orange" role="button" onclick="FormOK()">완료</a>
			<a href="/" class="btn btn-default" role="button">취소</a>
		</p>
		<p class="pull-right">
			<a href="/member/member_leave.php" class="btn-leave">회원탈퇴</a>
		</p>
	</div>
</form>

<!-- form_Start -->
<iframe name="nullframe" width="100%" height="0" frameborder="0"></iframe>