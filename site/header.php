<header>
	<img id="logo" src="/assets/images/logo.png" />
	<div id="lang">
		<button type="button" class="pure-button langBtn">de</a>
		<button type="button" class="pure-button langBtn">en</a>
	</div>
	<div id="slider">
		<div class="sliderQuery">
			<a href = "index.php?action=produktansicht&produkt_id=6">
			<img alt="" src="/assets/images/dunkleSchokoladeNEU.jpg" ></a>
			<a href = "index.php?action=produktansicht&produkt_id=8">
			<img alt="" src="/assets/images/MilchSchokolade.jpg"></a>
			<a href = "index.php?action=produktansicht&produkt_id=7">
			<img alt="" src="/assets/images/weisseSchokolade.jpg"></a>
		</div>
	</div>
</header>

<script>
	$(document).ready(function(){
	$('.sliderQuery').slick({
		slide: "a",
		autoplay: true,
		dots: true,
		arrows: false,
		fade: true
	});
	$(".langBtn").on("click", function(){
		$.post(
			"index.php?action=changeLang&lang=" + $(this).html(),
			function sucess(){
				location.reload();
			}
		);
	});
	});
</script>
