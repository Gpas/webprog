<?php
class Product {
	private $id;
	private $category;
	private $price;
	private $img;
	//multilanguage attributes
	private $name;
	private $description;
	
	//getters
	public function getId() {
		return $this->id;
	}
	public function getCategory() {
		return $this->category;
	}
	public function getPrice() {
		return $this->price;
	}
	public function getImg() {
		return $this->img;
	}
	public function getName() {
		return $this->name;
	}
	public function getDescription() {
		return $this->description;
	}
	//setters
	public function setCategory($category) {
		$this->category = $category;
	}
	public function setPrice($price) {
		$this->price = $price;
	}
	public function setImg($img) {
		$this->img = $img;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function __toString(){
		return sprintf("%d %s, %d, %s", $this->id, $this->getName(), $this->price, $this->description);
	}
	
	//functions
	public static function getProducts($orderBy="id", $lang_code="de"){
		$orderByStr = '';
		if (in_array($orderBy, ['id', 'price', 'name', 'description']) ) {
			$orderByStr = " ORDER BY $orderBy";
		}
		$products = array();
		$res = DB::doQuery("SELECT p.*, l.name AS 'name', l.description AS 'description' FROM products p LEFT OUTER JOIN products_lang l ON p.id = l.product_id WHERE l.lang_code = '$lang_code' $orderByStr");
		if ($res) {
			while ($product = $res->fetch_object(get_class())) {
				$products[] = $product;
			}
		}
		return $products;
	}
	
	public function render(){
		echo '<article class="product">
				<h3>'.$this->getName().'</h3>
				<img alt="Produktbild" src="/assets/images/'.$this->getImg().'">
				<section class="description">
					'.$this->getDescription().'
				</section>
	 			<form class="orderProduct" method="post" action="">
					<select name="quantity">';
		for ($i=1; $i <= 10 ; $i++) { 
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select>
				<input type="hidden" name="id" value='.$this->getId().' />
				<button class="order" name="addProduct" >Bestellen</button>
				</form>
				</article>';
	}
}
?>

<script>
	$(document).ready(function(){
			$("#order").on("click", function(){
					$.post("index.php?action=addProduct",
					$(".orderProduct").serialize(),
					function sucess(){
						$("#warenkorb").load("index.php?action=renderSideCart");
					}
				);
			});
	})
</script>
