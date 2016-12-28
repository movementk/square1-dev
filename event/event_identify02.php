<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php');
$g04 = "selected";
$s02 = "active";

foreach($_REQUEST as $KEY => $VALUES){
	if($KEY == "Content" || $KEY == "Etc1"){
		${$KEY} = get_text($VALUES);
		//echo $KEY." : ".${$KEY};
	} else {
		${$KEY} = preg_replace("/\"/", "&#034;", get_text($VALUES));
	}
}

switch($workType){
	case "RER": //이미 접수되었는데 2중접수한경우
		$sql = " select * from ".$site_prefix."event_request where idx = '".$idx."' ";
		$row = sql_fetch($sql);
		$already_request = true;
		break;
	case "RIR": //성공적으로 접수후에 결과 확인페이지로 넘어왔을경우
		if(trim($idx) == ""){
			GetAlert("정상적인 접근이 아닙니다.","BACK");
			exit;
		}
		$sql = " select * from ".$site_prefix."event_request where idx = '".$idx."' ";
		$row = sql_fetch($sql);
		$request_result = true;
		break;
	case "RS": //접수결과 확인페이지에서 넘어왔을경우
		if(trim($idx) == ""){
			GetAlert("정상적인 접근이 아닙니다.","BACK");
			exit;
		}

		if(trim($UserName) == ""){
			GetAlert("이름을 입력해주시기 바랍니다.","BACK");
			exit;
		}

		$phone = $phone1."-".$phone2."-".$phone3;
		if($phone == "--"){
			GetAlert("전화번호를 입력해주시기 바랍니다.","BACK");
			exit;
		}

		$sql = " select * from ".$site_prefix."event_request where eidx = '".$idx."' and uname = '".$UserName."' and phone = '".$phone."' ";
		$row = sql_fetch($sql);
		if($row["idx"]){
			$request_result = true;
		} else {
			$request_result = false;
		}
		break;
}

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
				<section class="square1-event event-identify02">
					<div class="section-content">
						<?
						if($idx){
						?>
						<div class="event-img">
							<?
							if($view["HtmlChk"]=="Y"){
								$view["Content"] = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' \\2 \\3", $view["Content"]);
								echo $view["Content"];
							} else {
								echo nl2br($view["Content"]);
							}
							?>
						</div>
						<?
						}
						?>

						<? if($request_result && $workType != "RER"){ ?>
						<div class="identify">
							<h3>당신의 또다른 LIFE STYLE,<br class="visible-xs"> <span>SQUARE<i>1</i></span></h3>
							<p class="sucess-txt">접수가 완료 되었습니다.</p>
							<dl>
								<dt>접수일자</dt>
								<dd><?=date("Y-m-d",strtotime($row["RegDate"]))?></dd>
								<dt>참가일자</dt>
								<dd><?=date("Y-m-d",strtotime($row["er1"]))?></dd>
								<!--dt>신청 조</dt>
								<dd>1조 [15:00~15:50]</dd-->
							</dl>
						</div>
						<? } ?>

						<? if(!$request_result && $workType != "RER"){ ?>
						<div class="identify">
							<h3>당신의 또다른 LIFE STYLE,<br class="visible-xs"> <span>SQUARE<i>1</i></span></h3>
							<p class="sucess-txt">접수 내역이 없습니다.</p>
							<!--dl>
								<dt>접수일자</dt>
								<dd><?=date("Y-m-d",strtotime($row["RegDate"]))?></dd>
								<dt>신청 조</dt>
								<dd>1조 [15:00~15:50]</dd>
							</dl-->
						</div>
						<? } ?>

						<? if($already_request){ ?>
						<!-- 이미 행사를 참여했을 경우 -->
						<div style="margin-top: 30px;"><!-- 사용시 div 박스 삭제 -->
							<div class="identify">
								<h3>당신의 또다른 LIFE STYLE,<br class="visible-xs"> <span>SQUARE<i>1</i></span></h3>
								<p class="sucess-txt">행사 참여가 이미 완료되었습니다.</p>
								<dl>
									<dt>접수일자</dt>
									<dd><?=date("Y-m-d",strtotime($row["RegDate"]))?></dd>
									<dt>참가일자</dt>
									<dd><?=date("Y-m-d",strtotime($row["er1"]))?></dd>
									<!--dt>신청 조</dt>
									<dd>1조 [15:00~15:50]</dd-->
								</dl>
								<!--p class="reset-count">2초 후에 첫 등록화면으로 이동합니다.</p-->
							</div>
						</div>
						<? } ?>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>