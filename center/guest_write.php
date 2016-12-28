<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); ?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/center.css">
</head>
<body class="sub center">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>고객센터</small>CUSTOMER</h1>
				<p>
					스퀘어원 고객님의 편의를 위한<br>
					정보와 서비스 내용을 안내드립니다.
				</p>
			</div>
		</header>
		<main id="content">
			<?php
			$s05 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb5.php');
			?>
			<div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> 고객의소리</h1>
                <h2>
                    스퀘어원과 관련된 궁금한 사항은<br>
                    무엇이든 물어보세요.
                </h2>
                <p>
                    제안ㆍ건의ㆍ만족ㆍ불만족 등과 관련된 고객님의<br class="visible-xs"> 
                    소중한 의견을 남겨주시면<br>
                    접수 후 빠른 대응을 하도록 하겠습니다.
                </p>
            </div>
			<div class="container">
				<section class="write">
					<div class="section-content">
						<div class="input-form type-1">
							<form name="write_form" action="<?=$loc?>/board/module/incboard/board_ok.php" method="post" ENCTYPE="MULTIPART/FORM-DATA" onsubmit="return write_chk();">
							<input type="hidden" name="mode" value="<?=$site_prefix?>board_guests">
							<input type="hidden" name="BoardType" value="<?=$BoardType?>">
							<input type="hidden" name="BoardIdx" value="<?=$write["BoardIdx"]?>">
							<input type="hidden" name="Ref" value="<?=$_REQUEST["Ref"]?>">
							<input type="hidden" name="ReStep" value="<?=$_REQUEST["ReStep"]?>">
							<input type="hidden" name="ReLevel" value="<?=$_REQUEST["ReLevel"]?>">
							<input type="hidden" name="UserID" value="<?=$write[UserID]?>">
							<input type="hidden" name="URI" value="<?=$_SERVER["PHP_SELF"]?>">
							<input type="hidden" name="FileCnt" value="<?=$BoardDateRow[FileCnt]?>">
							<input type="hidden" name="HtmlChk" value="N">
							<input type="hidden" name="wr_key_enabled"  id="wr_key_enabled"   value="" />
								<dl>
									<dt>상담유형</dt>
									<dd>
										<select class="form-control exp" id="performance" name="Category" title="상담유형">
											<option value="">선택하세요</option>
											<option value="제안">제안</option>
											<option value="건의">건의</option>
											<option value="만족">만족</option>
											<option value="불만족">불만족</option>
										</select>
									</dd>
									<dt><label for="subject">제목</label></dt>
									<dd class="subject"><input type="text" id="subject" class="form-control exp" name="Title" title="제목"></dd>
									<dt>첨부파일</dt>
									<dd class="file">
										<input type="file" id="file" class="form-control" name='bf_file[]'>
										<label for="file">
											<i class="icon-upload">
												<span class="sr-only">파일올리기</span>
											</i>
										</label>
									</dd>
									<dt>내용 <br class="hidden-xs"><i>(0자/2000자)</i></dt>
									<dd>
										<textarea class="form-control" name="Content" id="Content"></textarea>
									</dd>
									<? if($is_guest){ ?>
									<dt>자동입력방지</dt>
									<dd><?php echo $captcha_html ?></dd>
									<? } ?>
								</dl>
								<div class="btn-area">
									<p>
										<a href="javascript:;" class="btn btn-orange" role="button" onclick="write_chk();">전송</a>
										<a href="javascript:;" class="btn btn-default" role="button" onclick="location.reload();">취소</a>
									</p>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<script src="/board/config/recaptcha/recaptcha.js"></script>
	<script>
		function write_chk(){
			var expCk = true;
			<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

		//	if($("#agree-check").prop("checked") == false){
		//		alert("개인정보취급방침에 동의하셔야합니다.");
		//		expCk = false;
		//	}
			
			$(".exp").each(function(){
				if(expCk){
					if($(this).val() == ""){
						alert($(this).attr("title")+"은(는) 필수입력사항 입니다.");
						expCk = false;
					}
				}
			});

			if(expCk == true){
				document.write_form.submit();
			}
		}
	</script>
</body>
</html>