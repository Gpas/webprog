<header>
	<img id="logo" src="/resource/logo.png" />
	<div id="slider">
		<div class="sliderQuery">
			<img src="/resource/pralinen.jpg" alt="" />
			<img src="/resource/schokolade_stapel.jpg" alt="" />
			<img src="/resource/schokoladen_bleche.jpg" alt="" />
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