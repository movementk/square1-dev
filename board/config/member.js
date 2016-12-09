function id_chk(){
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
function mail_chk(){
	var f=  document.MemberForm;
	var val = f.Email.value;

	if($.trim(val) == ""){
		alert("이메일주소를 입력해주시기 바랍니다.");
		f.Email1.focus();
		return;
	}

	jQuery.ajax({
		url: "/board/config/ajax/ajax_mailck.php",
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
		data: "Mobile="+hp2+"-"+hp3+"-"+hp4,
		
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

function FormOK(){
	var form = document.MemberForm;
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
		if(form.Password1.value != form.Password2.value){
			alert("비밀번호가 일치하지 않습니다.");
			form.Password1.value == "";
			form.Password2.value == "";
			form.Password1.focus();
			expCk = false;
			return;
		}

		if(form.idchk.value=="No"){
			alert("아이디 중복확인을 해주시기 바랍니다.");
			$("#UserID").focus();
			expCk = false;
			return;
		}

		if(form.mailchk.value == "No"){
			alert("이메일 중복확인을 해주시기 바랍니다.");
			$("#Email1").focus();
			expCk = false;
			return;
		}

		/*
		if(form.hpchk.value == "No"){
			alert("휴대폰 중복확인을 해주시기 바랍니다.");
			$("input[name='mobile1']").focus();
			expCk = false;
			return;
		}
		*/
	}

	if(expCk){
		form.submit();
	}
}

var win_zip = function(frm_name, frm_zip, frm_addr1, frm_addr2, frm_addr3, frm_jibeon) {
    if(typeof daum === 'undefined'){
        alert("다음 우편번호 postcode.v2.js 파일이 로드되지 않았습니다.");
        return false;
    }

    var zip_case = 2;   //0이면 레이어, 1이면 페이지에 끼워 넣기, 2이면 새창

    var complete_fn = function(data){
        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

        // 각 주소의 노출 규칙에 따라 주소를 조합한다.
        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
        var fullAddr = ''; // 최종 주소 변수
        var extraAddr = ''; // 조합형 주소 변수

        // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
            fullAddr = data.roadAddress;

        } else { // 사용자가 지번 주소를 선택했을 경우(J)
            fullAddr = data.jibunAddress;
        }

        // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
        if(data.userSelectedType === 'R'){
            //법정동명이 있을 경우 추가한다.
            if(data.bname !== ''){
                extraAddr += data.bname;
            }
            // 건물명이 있을 경우 추가한다.
            if(data.buildingName !== ''){
                extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
            }
            // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
            extraAddr = (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
        }

        // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
        var of = document[frm_name];

        of[frm_zip].value = data.zonecode;

        of[frm_addr1].value = fullAddr;
        of[frm_addr3].value = extraAddr;

        if(of[frm_jibeon] !== undefined){
            of[frm_jibeon].value = data.userSelectedType;
        }

        of[frm_addr2].focus();
    };

    switch(zip_case) {
        case 1 :    //iframe을 이용하여 페이지에 끼워 넣기
            var daum_pape_id = 'daum_juso_page'+frm_zip,
                element_wrap = document.getElementById(daum_pape_id),
                currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
            if (element_wrap == null) {
                element_wrap = document.createElement("div");
                element_wrap.setAttribute("id", daum_pape_id);
                element_wrap.style.cssText = 'display:none;border:1px solid;left:0;width:100%;height:300px;margin:5px 0;position:relative;-webkit-overflow-scrolling:touch;';
                element_wrap.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-21px;z-index:1" class="close_daum_juso" alt="접기 버튼">';
                jQuery('form[name="'+frm_name+'"]').find('input[name="'+frm_addr1+'"]').before(element_wrap);
                jQuery("#"+daum_pape_id).off("click", ".close_daum_juso").on("click", ".close_daum_juso", function(e){
                    e.preventDefault();
                    jQuery(this).parent().hide();
                });
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                    // iframe을 넣은 element를 안보이게 한다.
                    element_wrap.style.display = 'none';
                    // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                    document.body.scrollTop = currentScroll;
                },
                // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분.
                // iframe을 넣은 element의 높이값을 조정한다.
                onresize : function(size) {
                    element_wrap.style.height = size.height + "px";
                },
                width : '100%',
                height : '100%'
            }).embed(element_wrap);

            // iframe을 넣은 element를 보이게 한다.
            element_wrap.style.display = 'block';
            break;
        case 2 :    //새창으로 띄우기
            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                }
            }).open();
            break;
        default :   //iframe을 이용하여 레이어 띄우기
            var rayer_id = 'daum_juso_rayer'+frm_zip,
                element_layer = document.getElementById(rayer_id);
            if (element_layer == null) {
                element_layer = document.createElement("div");
                element_layer.setAttribute("id", rayer_id);
                element_layer.style.cssText = 'display:none;border:5px solid;position:fixed;width:300px;height:460px;left:50%;margin-left:-155px;top:50%;margin-top:-235px;overflow:hidden;-webkit-overflow-scrolling:touch;z-index:10000';
                element_layer.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" class="close_daum_juso" alt="닫기 버튼">';
                document.body.appendChild(element_layer);
                jQuery("#"+rayer_id).off("click", ".close_daum_juso").on("click", ".close_daum_juso", function(e){
                    e.preventDefault();
                    jQuery(this).parent().hide();
                });
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                    // iframe을 넣은 element를 안보이게 한다.
                    element_layer.style.display = 'none';
                },
                width : '100%',
                height : '100%'
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';
    }
}

$(document).on("click", ".agrees", function(){
	var ckId = $(this).attr("id");
	$("input[name='"+$(this).attr("name")+"']").each(function(){
		$(this).prop("checked",false);
	});

	$("#"+ckId).prop("checked",true);
});