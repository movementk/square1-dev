<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g04 = "selected";
$s02 = "active";

if($idx){
	$mode = $site_prefix."board_square1";
	$sql = " select * from ".$mode." where BoardIdx = '".$idx."' ";
	$view = sql_fetch($sql);
	if($view["bd2"] < date("Y-m-d")){
		$gubun = "end";
	} else {
		$gubun = "ing";
	}
}
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/event.css">
</head>
<body class="sub event">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>이벤트&amp;뉴스</small>EVENT &amp; NEWS</h1>
				<p>
					복합문화 쇼핑공간 스퀘어원만의 이벤트 소식과<br>
					보도자료를 전해드립니다.
				</p>
			</div>
		</header>
		<main id="content">
			<?php
			$s02 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb4.php');
			?>
			<div class="page-header has-snb"><!-- SNB를 포함할 경우 has-snb 클래스 추가-->
				<h1><span class="square1">SQUARE<i>1</i></span> 이벤트</h1>
				<div class="snb">
					<div class="container">
						<button class="btn btn-block" type="button">
							진행 중 이벤트
						</button>
						<nav>
							<ul>
								<li class="<?=$gubun=="ing"?"active":""?>"><a href="square1_event_list.php?gubun=ing">진행 중 이벤트</a></li>
								<li class="<?=$gubun=="end"?"active":""?>"><a href="square1_event_list.php?gubun=end">지난 이벤트</a></li>
								<li><a href="/event/prizewinner_list.php">당첨자 발표</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<div class="container">
				<section class="square1-event event-identify01">
					<div class="section-content">
						<?
						if($idx){
						?>
						<div class="event-img">
							<?
							if($view["HtmlChk"]=="Y"){
								$view["Content"] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' class='img-responsive' \\2 \\3", $view["Content"]);
								echo $view["Content"];
							} else {
								echo nl2br($view["Content"]);
							}
							?>
						</div>
						<?
						}
						?>
						<div class="event-form">
							<form name="searchForm" method="post" action="event_identify02.php" onsubmit="return write_chk();">
							<input type="hidden" name="workType" value="RS" />
								<h3>접수/응모확인</h3>
								<div class="form-group">
									<dl>
										<dt><label for="u-name">이벤트선택</label></dt>
										<dd>
											<?
											if($idx){
												echo "<span style='line-height:30px;'>".$view["Title"]."</span><input type='hidden' name='idx' value='".$idx."' />";
											} else {
											?>
											<select class="form-control exp" name="idx" title="이벤트">
												<option value="">선택</option>
												<?
												$sql = " select * from ".$mode." where 1=1 order by BoardIdx desc ";
												$result = sql_query($sql);
												for($i=0;$row = sql_fetch_array($result);$i++){
													echo "<option value='".$row["BoardIdx"]."'>".$row["Title"]."</option>";
												}
												?>
											</select>
											<?
											}
											?>
										</dd>
										<dt><label for="u-name">이름</label></dt>
										<dd><input type="text" id="u-name" class="form-control exp" name="UserName" title="이름"></dd>
										<dt class="dl-mb">휴대폰번호</dt>
										<dd class="phone dl-mb">
											<select class="form-control exp" name="phone1" title="휴대폰번호">
												<option value="">선택</option>
												<option value="010">010</option>
												<option value="011">011</option>
												<option value="016">016</option>
												<option value="016">018</option>
												<option value="019">019</option>
											</select>
											-
											<input type="text" id="phone-2" class="form-control exp" name="phone2" title="휴대폰번호"> -
											<label for="phone-2" class="sr-only">중간 번호</label>
											<input type="text" id="phone-3" class="form-control exp" name="phone3" title="휴대폰번호">
											<label for="phone-3" class="sr-only">마지막 번호</label>
										</dd>
									</dl>
								</div>
								<div class="btn-area">
									<p class="float-r">
										<button type="submit" class="btn btn-orange">응모확인</button>
										<a href="/event/square1_event_list.php" class="btn btn-default" role="button">취소</a>
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
	<script>
	function write_chk(){
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
			return true;
		} else {
			return false;
		}
	}
	</script>
</body>
</html>