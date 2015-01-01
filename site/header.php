<header>
	<img id="logo" src="/assets/images/logo.png" />
	<div id="slider">
		<div class="sliderQuery">
			<img src="/assets/images/pralinen.jpg" alt="" />
			<img src="/assets/images/schokolade_stapel.jpg" alt="" />
			<img src="/assets/images/schokoladen_bleche.jpg" alt="" />
		</div>
	</div>
</header>

<script>
	$(document).ready(function(){
	$('.sliderQuery').slick({
		slide: "img",
		autoplay: true,
		dots: true,
		arrows: false,
		fade: true
	});
	});
</script>