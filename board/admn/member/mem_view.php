<?
include_once $_SERVER['DOCUMENT_ROOT']."/board/admn/include/head.php";
include $dir.$configDir."/admin_check.php";

$t400 = "top_mon";
$t401 = "navi_mon";
$left = "l4";

include_once $dir."/admn/include/admin_top.php";
include_once $dir."/admn/include/admin_left.php";

$mode = $site_prefix."member";
$workType = "I";

if($idx != ""){
	$workType = "M";
	$sql = "select * from ".$mode." where idx=".$idx;
	$write = sql_fetch($sql);
	$Email = explode("@",$write["Email"]);
	$mobile = explode("-",$write["Mobile"]);
	$zipcode = explode("-",$write["ZipCode"]);
}

$searchVal = "mtype=".$mtype."&sfl=".$sfl."&stx=".$stx."&page=".$page;

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {   //https 통신일때 daum 주소 js
	echo '<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>';
} else {  //http 통신일때 daum 주소 js
	echo '<script src="http://dmaps.daum.net/map_js_init/postcode.js"></script>';
}
?>
<div id="container">
	<div class="content_view">
		<div class="con_title">회원관리</div>
		<form name="MemberForm" method="post" action="/board/admn/_proc/member/_member_proc.php">
		<input type="hidden" name="workType" value="<?=$workType?>">
		<input type="hidden" name="URI" value="/board/admn/member/mem_lst.php?<?=$searchVal?>">
		<input type="hidden" name="old_email" id="old_email" value="<?=$write["Email"]?>">
		<? if($workType == "I"){ ?>
		<input type='hidden' name='idchk' value='No'>
		<input type='hidden' name='hpchk' value='No'>
		<input type="hidden" name="mailchk" value="No">
		<input type="hidden" name="mem_photo" value="">
		<? } ?>
		<table class="write_table mt15">
			<colgroup>
				<col width="15%">
				<col width="85%">
			</colgroup>
			<tbody>
			<tr>
				<th>아이디 </th>
				<td>
					<? if($workType == "I"){ ?>
					<input type="text" class="input wd140 exp" name="UserID" value="<?=$write["UserID"]?>" > <button type="button" class="btn_a_b" onclick="idCheck();">중복검사</button>
					<span id="span_idck"></span>
					<?
					} else {
						echo $write["UserID"];
						echo "<input type='hidden' name='UserID' value='".$write["UserID"]."'>";
						echo "<input type='hidden' name='idchk' value='Yes'>";
					}
					?>
				</td>
			</tr>
			<tr>
				<th>비밀번호 </th>
				<td><input type="password" class="input wd100" name="Password" ></td>
			</tr>
			<tr>
				<th>이름</th>
				<td>
					<? if($workType == "I"){ ?>
					<input type="text" class="input wd140 exp" name="UserName" value="<?=$write["UserName"]?>" >
					<?
					} else {
						echo $write["UserName"];
						echo "<input type='hidden' name='UserName' value='".$write["UserName"]."'>";
					}
					?>
				</td>
			</tr>
			<tr>
				<th>포인트카드번호 </th>
				<td><input name="mb_1" type="text" class="input" id="mb_1" style="width:100px;" title="포인트카드번호" value="<?=$write["mb_1"]?>"></td>
			</tr>
			<!--tr>
				<th>성별 </th>
				<td><input type="radio" name="Sex" id="male" value="M" <?=$write["Sex"]=="M"?"checked":""?>><label for="male" class="pl5 pr20">남자</label><input type="radio" name="Sex" id="female" value="F" <?=$write["Sex"]=="F"?"checked":""?>><label for="female" class="pl5 ">여자</label></td>
			</tr>
			<tr>
				<th>생년월일 </th>
				<td><input name="BirthDay" type="text" class="input datepick" id="BirthDay" readonly style="width:80px;" title="생년월일" value="<?=date("Y-m-d",$write["BirthDay"])?>" onchange="age_ck();"><span class="f95">* bbb 활동 규정상 미성년자는 봉사자로 신청할 수 없습니다.</span></td>
			</tr-->
			<tr>
				<th>핸드폰번호 </th>
				<td>
					<input type="text" class="input" name="Mobile1" id="phone1" style="width:50px;" value="<?=$mobile[0]?>" maxlength="3" > - <input type="text" class="input" name="Mobile2" id="phone2" style="width:50px;" value="<?=$mobile[1]?>" maxlength="4" > - <input type="text" class="input" name="Mobile3" id="phone3" style="width:50px;" value="<?=$mobile[2]?>" maxlength="4" >&nbsp;
				</td>
			</tr>
			<tr>
				<th>이메일 </th>
				<td>
					<input type="text" class="input wd100" name="Email1" value="<?=$Email[0]?>" > @ <input type="text" class="input wd100" name="Email2" value="<?=$Email[1]?>" > 
					<button type="button" class="btn_a_b" onclick="mail_chk();">중복검사</button>
					<? if($workType == "I"){ ?>
					<span id="span_mailck"></span>
					<? } else { ?>
					<span id="span_mailck"><input type='hidden' name='mailchk' value='Yes'></span>
					<? } ?>
				</td>
			</tr>
			<tr>
				<th>이메일수신동의 </th>
				<td><input type="radio" name="EmailFlag" id="EmailFlag1" value="Y" <?=$write["EmailFlag"]=="Y"?"checked":""?>><label for="EmailFlag1" class="pl5 pr20">동의함</label><input type="radio" name="EmailFlag" id="EmailFlag2" value="N" <?=$write["EmailFlag"]=="N"?"checked":""?>><label for="EmailFlag2" class="pl5 ">동의안함</label></td>
			</tr>
			<!--tr>
				<th>전화번호 </th>
				<td><input type="text" class="input" name="Phone1" style="width:50px;" value="<?=$phone[0]?>" maxlength="3" onkeyup="nextFocus('MemberForm','Phone1','Phone2');" > - <input type="text" class="input" name="Phone2" style="width:50px;" value="<?=$phone[1]?>" maxlength="4" onkeyup="nextFocus('MemberForm','Phone2','Phone3');" > - <input type="text" class="input" name="Phone3" style="width:50px;" value="<?=$phone[2]?>" maxlength="4" ></td>
			</tr>
			<tr>
				<th>주소 </th>
				<td>
					<input type="text" class="input" name="ZipCode1" readonly style="width:50px;" value="<?=$zipcode[0]?>" > - <input type="text" class="input" name="ZipCode2" readonly style="width:50px;" value="<?=$zipcode[1]?>" > <button type="button" class="btn_a_b" onclick="win_zip('MemberForm', 'ZipCode1', 'ZipCode2', 'Address1', 'Address2', 'Address3', 'AddressType');">우편번호찾기</button><br>
					<input type="text" class="input" name="Address1" id="Address1" readonly style="width:350px;" value="<?=$write["Address1"]?>"><br>
					<input type="text" class="input" name="Address2" id="Address2" style="width:350px;" value="<?=$write["Address2"]?>">
					<input name="Address3" type="text" class="input" id="Address3" readonly style="width:350px;" value="<?=$write["Address3"]?>">
					<input type="hidden" name="AddressType" value="<?=$write["AddressType"]?>">
				</td>
			</tr-->
			</tbody>
		</table>
		</form>

		<div class="mt5 btn_group">
			<button type="button" class="btn_a_n" onclick="board_check();"><?=$workType=="I"?"등 록":"수 정"?></button>&nbsp;
			<button type="button" class="btn_a_b" onclick="location.href='/board/admn/member/mem_lst.php?<?=$searchVal?>';">취 소</button>
		</div>
		<div class="cboth"></div>
	</div>
	<div class="mt100"></div>
</div>

<iframe name="nullframe" width="400" height="400" style="display:none;"></iframe>

<script language="javascript">
function mail_chk(){
	var f=  document.MemberForm;
	var val1 = f.Email1.value;
	var val2 = f.Email2.value;
	var val = val1 + "@" + val2;

	if($.trim(val1) == "" || $.trim(val2) == "") {
		alert("이메일 주소를 입력해주시기 바랍니다.");
		f.Email1.focus();
		return;
	}

	jQuery.ajax({
		url: "/board/config/ajax/ajax_mailck.php",
		type: 'POST',
		data: "val=" + val + "&old_email="+$("#old_email").val(),

		error: function(){
			alert('error');
		},
		success: function(data){
			var msg = "";
			var dupe_ck = false;

			switch(data){
				case "100":
					msg = "금지단어가 포함되어있습니다.";
					dupe_ck = false;
					break;
				case "110":
					msg = "이메일주소 형식에 맞지않습니다.";
					dupe_ck = false;
					break;
				case "120":
					msg = "이미 사용중인 이메일주소 입니다.";
					dupe_ck = false;
					break;
				case "000":
					msg = "사용 가능한 이메일주소 입니다.";
					dupe_ck = true;
					break;
			}

			alert(msg);
			if(dupe_ck) $("input[name='mailchk']").val("Yes");
		}
	});

}

function board_check(){
	var f = document.MemberForm;

	if(f.idchk.value == "No"){
		alert("아이디 중복검사를 해주시기 바랍니다.");
		return;
	}

	if(f.mailchk.value == "No"){
		alert("이메일 중복검사를 해주시기 바랍니다.");
		return;
	}

	var expCk = true;
	
	$(".exp").each(function(){
		if(expCk){
			if($(this).val() == ""){
				alert($(this).attr("title")+"은(는) 필수입력사항 입니다.");
				expCk = false;
			}
		}
	});

	if(expCk == true){
		document.MemberForm.submit();
	}
}

function idCheck() {
	var f = document.MemberForm;
	var val = document.MemberForm.UserID.value;

	if($.trim(val) == ""){
		alert('아이디를 입력해주시기 바랍니다.');
		f.UserID.focus();
		return;
	}

	jQuery.ajax({
		url: "/board/config/ajax/ajax_idck.php",
		type: 'POST',
		data: "val=" + val,

		error: function(){
			alert('error');
		},
		success: function(data){
			var msg = "";
			var dupe_ck = false;

			switch(data){
				case "100":
					msg = "사용할 수 없는 아이디 입니다.";
					dupe_ck = false;
					break;
				case "110":
					msg = "이미 사용중인 아이디 입니다.";
					dupe_ck = false;
					break;
				case "200":
					msg = "아이디의 첫글자는 영문이어야 합니다.";
					dupe_ck = false;
					break;
				case "210":
					msg = "아이디는 영문, 숫자, _ 만 사용할 수 있습니다.";
					dupe_ck = false;
					break;
				case "220":
					msg = "공백없이 3~16자로 영문 소문자, 숫자, _, 만 가능합니다.";
					dupe_ck = false;
					break;
				case "000":
					msg = "사용 가능한 아이디 입니다.";
					dupe_ck = true;
					break;
			}

			alert(msg);
			if(dupe_ck){
				$("input[name='idchk']").val("Yes");
				$("input[name='uid']").val(val);
				$("input[name='UserID']").attr("readonly",true).css({"background-color":"#dedede"});
			}
		}
	});
}


function hp_chk(){
	var hp1 = $("#phone1").val();
	var hp2 = $("#phone2").val();
	var hp3 = $("#phone3").val();

	if(!hp1 || !hp2 || !hp3){
		alert("휴대전화 번호를 입력해주시기 바랍니다.");
		$("#phone1").focus();
		return;
	}

	jQuery.ajax({
		url: "/board/config/ajax/ajax_hpck.php",
		type: "post",
		data: "Mobile="+hp1+"-"+hp2+"-"+hp3,
		
		error: function(){
			alert('error');
		},
		success: function(data){
			var msg = "";
			var dupe_ck = false;

			switch(data){
				case "100":
					msg = "숫자만 입력하시기 바랍니다.";
					dupe_ck = false;
					break;
				case "200":
					msg = "이미 등록된 휴대전화 입니다.";
					dupe_ck = false;
					break;
				case "000":
					msg = "사용 가능한 휴대전화번호 입니다.";
					dupe_ck = true;
					break;
			}

			alert(msg);
			if(dupe_ck) $("input[name='hpchk']").val("Yes");
		}
	});
}


var win_zip = function(frm_name, frm_zip1, frm_zip2, frm_addr1, frm_addr2, frm_addr3, frm_jibeon) {
    if(typeof daum === 'undefined'){
        alert("다음 juso.js 파일이 로드되지 않았습니다.");
        return false;
    }

    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
            // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
            var of = document[frm_name];
            of[frm_zip1].value = data.postcode1;
            of[frm_zip2].value = data.postcode2;
            of[frm_addr1].value = data.address1;
            of[frm_addr2].value = "";
            of[frm_addr3].value = "";

            if( data.addressType == "R" ){  //도로명이면
                of[frm_addr3].value = data.address2;
            }
            if(of[frm_jibeon] !== undefined){
                of[frm_jibeon].value = data.addressType;
            }

            of[frm_addr2].focus();
        }
    }).open();
}
</script>
<?
include_once $dir."/admn/include/tail.php";
?>