<header>
	<img id="logo" src="/assets/images/logo.png" />
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
	});
</script>