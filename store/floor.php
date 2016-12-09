<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/dochead.php'); 
$g02 = "selected";
$s02 = "active";
?>
<link rel="stylesheet" href="/assets/css/sub.css">
<link rel="stylesheet" href="/assets/css/store.css">
</head>
<body class="sub store floor">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb_aside.php'); ?>
	<div id="wrapper">
		<div id="top-bn">
		</div>
		<header id="header">
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/top_nav.php'); ?>
			<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/gnb.php'); ?>
			<div class="jumbo">
				<h1><small>매장안내</small>SQUARE1 GUIDE</h1>
				<p>
					새로운 공간을 선두하는 스퀘어원의 라이프 스타일 공간입니다.<br>
					FASHION · F&amp;B · CGV · HOMEPLUS 등의 다양한 서비스를 소개합니다.
				</p>
			</div>
		</header>
		<main id="content">
			<?php 
			$s02 = "active";
			require_once($_SERVER['DOCUMENT_ROOT'].'/inc/lnb2.php');
			?>
			<div class="page-header">
				<h1><span class="square1">SQUARE<i>1</i></span> 층별안내</h1>
			</div>
			<!-- 컨텐츠 영역 -->
			<div class="page-summary">
				<div class="container">
					<h3>FASHION · F&amp;B · CGV · HOMEPLUS 등의 <br class="hidden-xs">다양한 서비스를 경험해 보세요</h3>
					<p>
						스퀘어원의 층별 매장을 소개합니다.
					</p>
				</div>
			</div>
			<div class="floor-tabs">
				<div class="container">
					<button class="btn btn-block" type="button">
						B1
					</button>
					<nav>
						<ul>
							<?
							if(!$Category) $Category = "B1";
							
							$sql = " select * from ".$site_prefix."board_setting where BoardName = 'floor' ";
							$row = sql_fetch($sql);
							
							$catAr = explode("|",$row["Category"]);

							for($i=0;$i<sizeof($catAr);$i++){
							?>
							<li class="<?=$Category==$catAr[$i]?"active":""?>"><a href="<?=$_SERVER["PHP_SELF"]?>?Category=<?=urlencode($catAr[$i])?>"><?=$catAr[$i]?></a></li>
							<? } ?>
						</ul>
					</nav>
				</div>
			</div>
			<?
			$sql = " select * from ".$site_prefix."board_floor where Category = '".$Category."' ";
			$row = sql_fetch($sql);
			$row["files"] = get_file($site_prefix."board_floor",$row["BoardIdx"]);
			?>
			<div class="floor-title">
				<div class="container">
					<h4><?=$Category?></h4>
					<hr>
					<small><?=$row["Title"]?></small>
				</div>
			</div>
			<div class="floor-plan">
				<div class="container">
					<p>
						<? 
						for($i=0;$i<$row["files"]["count"];$i++){
							switch($i){
								case 0:
									$visible = "visible-md visible-lg";
									break;
								case 1:
									$visible = "visible-sm";
									break;
								case 2:
									$visible = "visible-xs";
									break;
							}
							echo "<img class='img-responsive ".$visible."' src='".$row["files"][$i]["path"]."/".$row["files"][$i]["file_source"]."' />";
						}
						?>
					</p>
				</div>
			</div>
			<div class="store-list category-list">
				<div class="container">
					<ul class="row" id="brand_ul">
						<?
						$mode = $site_prefix."board_store";
						switch($Category){
							case "B1":
								$floor = "0";
								break;
							case "1F":
								$floor = "1";
								break;
							case "2F":
								$floor = "2";
								break;
							case "3F":
								$floor = "3";
								break;
							case "4F":
								$floor = "4";
								break;
						}

						$tsql = " select count(*) as cnt from ".$mode." where bd4 = '".$floor."' and Category != '퇴점' ";
						$trow = sql_fetch($tsql);

						$sql = " select * from ".$mode." where bd4 = '".$floor."' and Category != '퇴점' order by BoardIdx desc limit 0, 6";
						$result = sql_query($sql);
						for($i=0;$row = sql_fetch_array($result);$i++){
							$row["files"] = get_file($mode,$row["BoardIdx"]);
							switch($row["files"][0][image_type]){
								case "1":
								case "2":
								case "3":
									if(file_exists($fileURL."/thumbs/".$row["files"][0][file_source])){
										$row["img"] = "<img src='/board/upload/".$BoardName."/thumbs/".$row["files"][0][file_source]."' class='img-responsive' >";
									} else {
										if($row["files"][0]["image_width"] <= $thumb_width && $row["files"][0]["image_height"] <= $thumb_height){
											$row["img"] = "<img src='/board/upload/".$BoardName."/".$row["files"][0][file_source]."' class='img-responsive'>";
										} else {
											$row["img"] = makeThumbs($fileURL, $row["files"][0][file_source], $thumb_width, $thumb_height, $thmPath,"");
											$row["img"] = "<img src='/board/upload/".$BoardName."/thumbs/".$row["files"][0][file_source]."' class='img-responsive' >";
										}
									}
									break;
								case "6":
									$row["img"] = "<img src='".$row["files"][0]["path"]."/thumbs/".$row["files"][0][file_source]."' class='img-responsive'>";
									break;
								default:
									$row["img"] = "<img src='/assets/images/introduce/brand_logo01.jpg' class='img-responsive'/>";
							}

							switch($row["bd4"]){
								case "0":
									$floors = "B1";
									break;
								case "1":
								case "2":
								case "3":
								case "4":
								case "5":
								case "6":
								case "7":
									$floors = $row["bd4"]."F";
									break;
							}
						?>
						<li class="col-xs-12 col-sm-6">
							<div class="category-item">
								<div class="row">
									<div class="col-xs-6">
										<div class="figure">
											<p>
												<?=$row["img"]?>
											</p>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="details">
											<dl>
												<dt><?=$row["Title"]?></dt>
												<dd class="c-tel">
													<i class="icon-phone"></i>
													<a href="tel:<?=$row["bd6"]?>"><?=$row["bd6"]?></a>
												</dd>
												<dd class="c-clock">
													<i class="icon-clock"></i><?=$row["bd7"]?>
												</dd>
												<dd class="c-floor">
													<i class="icon-location"></i><?=$floors?>
												</dd>
											</dl>
										</div>
									</div>
								</div>
							</div>
						</li>
						<?
						}
						?>
					</ul>
				</div>
				<? if($trow["cnt"] >= $i && $trow["cnt"] > 0){ ?>
				<div class="btn-area">
					<p>
						<a href="javascript:;" class="btn btn-orange" role="button" id="storeLoad">더보기</a>
					</p>
				</div>
				<? } ?>
			</div>
			<!-- // 컨텐츠 영역 -->
		</main>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'); ?>
	</div>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/inc/docfoot.php'); ?>
	<script>
		(function($) {
			var page = 1;
			var isLoad = false;

			$(document).on('click', '#content .floor-tabs .btn', function() {
				$('#content .floor-tabs').toggleClass('open');
			});

			$(document).on("click", "#storeLoad", function(){
				if(isLoad == false){
					isLoad = true;
					jQuery.ajax({
						url: "ajax_store.php",
						type: 'POST',
						data: "page="+page+"&bd4=a<?=$floor?>",

						error: function(xhr,textStatus,errorThrown){
							alert('An error occurred! \n'+(errorThrown ? errorThrown : xhr.status));
						},
						success: function(data){
							$("#brand_ul").append(data);
						},
						complete: function(){
							page++;
							isLoad = false;
							if((page * 6) >= <?=$trow["cnt"]?>){
								$("#storeLoad").hide();
							}
						}
					});
				}
			});
		})(jQuery);
	</script>
</body>
</html>