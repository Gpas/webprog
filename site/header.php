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
		date = new Date();
        date.setTime(date.getTime()+(30*24*60*60*1000)); //30 Tage
        expires = date.toGMTString();
        document.cookie="lang="+$(this).html()+"; expires="+expires+"; path=/";
		$.get(
			"ajax.php?action=changeLang",
			function sucess(data){
				location.reload(true);
				//$("#warenkorb").html(data)
			}
		);
	});
	});
</script>
