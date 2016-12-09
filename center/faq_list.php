<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g05 = "selected";
$s03 = "active";
?>
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
			$s03 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb5.php');
			?>
			<div class="page-header">
                <h1><span class="square1">SQUARE<i>1</i></span> FAQ</h1>
                <p class="txt-m">스퀘어원과 관련한 궁금한 사항은<br class="visible-xs"> 무엇이든 찾아보세요</p>
            </div>
			<div class="container">
				<section class="faq">
					<div class="section-content">
						<nav class="board-list">
							<ul class="row">
								<li class="col-xs-4 col-sm-2 <?=!$Category?"active":""?>">
									<a href="<?=$_SERVER["PHP_SELF"]?>">ALL</a>
								</li>
								<li class="col-xs-4 col-sm-2 <?=$Category == "매장안내"?"active":""?>">
									<a href="<?=$_SERVER["PHP_SELF"]?>?Category=<?=urlencode("매장안내")?>">매장안내</a>
								</li>
								<li class="col-xs-4 col-sm-2 <?=$Category == "이벤트"?"active":""?>">
									<a href="<?=$_SERVER["PHP_SELF"]?>?Category=<?=urlencode("이벤트")?>">이벤트</a>
								</li>
								<li class="col-xs-4 col-sm-2 <?=$Category == "편의시설"?"active":""?>">
									<a href="<?=$_SERVER["PHP_SELF"]?>?Category=<?=urlencode("편의시설")?>">편의시설</a>
								</li>
								<li class="col-xs-4 col-sm-2 <?=$Category == "주차/교통"?"active":""?>">
									<a href="<?=$_SERVER["PHP_SELF"]?>?Category=<?=urlencode("주차/교통")?>">주차/교통</a>
								</li>
								<li class="col-xs-4 col-sm-2 <?=$Category == "기타"?"active":""?>">
									<a href="<?=$_SERVER["PHP_SELF"]?>?Category=<?=urlencode("기타")?>">기타</a>
								</li>
							</ul>
						</nav>
						<?
						$sql_common = "";
						$mode = $site_prefix."board_faq";

						$PageBlock   = 5;  //넘길 페이지 갯수
						if(!$board_list_num) $board_list_num = 5;                     //게시판 게시글 수

						if($Category){
							$sql_common .= " and Category = '".$Category."' ";
						}

						$TotalSQL = "select * from ".$mode." where Notice != '1' $sql_common order by RegDate desc, Ref desc, ReLevel asc, ReStep asc";
						$TotalResult = mysql_query($TotalSQL);
						$TotalCount  = mysql_num_rows($TotalResult);

						$total_page  = ceil($TotalCount / $board_list_num);  // 전체 페이지 계산
						if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
						$from_record = ($page - 1) * $board_list_num; // 시작 열을 구함

						$SQL = $TotalSQL." limit $from_record, $board_list_num";
						$Result      = mysql_query($SQL);
						$Count       = mysql_num_rows($Result);
						$searchVal .= "&list_type=".$list_type."&board_list_num=".$board_list_num."&bd4=".$bd4."&bd5=".$bd5;

						$write_pages = get_paging($PageBlock, $page, $total_page, $_SERVER["PHP_SELF"]."?".$searchVal."&board_code=".$board_code."&category=".$category."&page=");
						?>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<?
							$num = $TotalCount - ($page-1)*$board_list_num;
							for($i=0;$row = sql_fetch_array($Result);$i++){
								$Title = $row[Title];
							?>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading<?=$row["BoardIdx"]?>">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$row["BoardIdx"]?>" aria-expanded="true" aria-controls="collapse<?=$row["BoardIdx"]?>">
										<i class="hidden-xs"><?=$num?></i><h3><?=$row["Category"]?></h3> <p><?=$row["Title"]?></p>
									</a>
								</div>
								<div id="collapse<?=$row["BoardIdx"]?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$row["BoardIdx"]?>">
									<div class="panel-body">
										<div><?=$row["Content"]?></div>
									</div>
								</div>
							</div>
							<?
								$num--; 
							}
							if($Count == 0){ echo "<div>등록된 자주묻는질문이 없습니다</div>"; }
							?>
						</div>
						<nav aria-label="Page navigation" class="paging">
							<ul class="pagination">
								<?
								if($Count>0){
									echo $write_pages;
								}
								?>
							</ul>
						</nav>
					</div>
				</section>
			</div><!-- container -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
</body>
</html>