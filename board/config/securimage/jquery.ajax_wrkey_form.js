// 자동방지코드 검사
function reg_wr_key_check() {
   if($('#reg_wr_key').val().length > 4){
      $.ajax({
        url: wrkey_skin_path + "/ajax_wr_key_check.php",
        data: "reg_wr_key="+encodeURIComponent($('#reg_wr_key').val()),
        async: false,
        success: function(msg){
            return_reg_wr_key_check(msg);
        }
      });
    } else {
        return_reg_wr_key_check('120');
    }
}

function return_reg_wr_key_check(req) {
    var msg = $('#msg_wr_key');
    switch(req) {
        case '110' : msg.text('숫자만 입력하세요.').css( "color", "red" ); break;
        case '120' : msg.text('5자리 숫자를 입력하세요.').css( "color", "red" ); break;
        case '130' : msg.text('정확한 자동가입방지 코드를 입력하세요.').css( "color", "red" ); break;
        case '000' : msg.text('자동가입방지 숫자를 정확히 입력하셨습니다.').css( "color", "blue" );break;
        default : alert( '잘못된 접근입니다.\n\n' + req ); break;
    }
    $('#mb_wr_key_enabled').val(req);    
}
