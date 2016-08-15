<?php
// include("detailsHeader.php");
// include("left.php");
$variable = $_POST['variable'];
$user = "u1";
$query = array('Title' => $variable);
$cursorBook = $collection->find ($query);
foreach ( $cursorBook as $obj )
{
	$title = $variable;
	$author = $obj['Author'];
	$ISBN = $obj['ISBN'];
	$price = $obj['Price'];
	$description = $obj['Description'];
	$publication = $obj['Publisher'];
	$URL = $obj['URLs'];
}

?>
<script>
function addToCart(isbn,price,user) {
		alert(isbn);
		alert(price);
		alert(user);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","addToCart.php?isbn="+isbn+"&price="+price+"&user="+user,true);
        xmlhttp.send();
}
</script>
<div id="templatemo_content_right">
	<div class="templatemo_detailsPage_box">
		<h1>
			Book Title : <u><?php echo $title ?></u></span>
		</h1>
		<img src=<?php echo $URL ?> width=100 height=240 alt= <?php echo $title ?> />
		<div class="product_info">
			<p><?php echo $description ?></p>
			<h4>ISBN Number : <?php echo $ISBN?></h4>
			<h4>Publication : <?php echo $publication?></h4>
			<h4>Price : <?php echo $price ?>$</h4>
			<div class="detail_button">
				<a href=# onclick="addToCart('<?php echo $ISBN;?>','<?php echo $price;?>','<?php echo $user;?>')">Add to Cart</a>
				<h4 id="txtHint"><b></b></h4>
			</div>
		</div>
		<div class="cleaner">&nbsp;</div>
	</div>

	<div class="cleaner_with_height">&nbsp;</div>

	<div class="templatemo_product_box">
		<h1>
			Books from same Author</span>
		</h1>
		<img src="images/templatemo_image_03.jpg" alt="image" />
		<div class="product_info">
			<p>Ut fringilla enim sed turpis. Sed justo dolor, convallis at.</p>
			<h3>$65</h3>
			<div class="buy_now_button">
				<a href="subpage.html">Buy Now</a>
			</div>
			<div class="detail_button">
				<a href="subpage.html">Detail</a>
			</div>
		</div>
		<div class="cleaner">&nbsp;</div>
	</div>

	<div class="cleaner_with_width">&nbsp;</div>

	<div class="templatemo_product_box">
		<h1>
			Books of same Genre</span>
		</h1>
		<img src="images/templatemo_image_03.jpg" alt="image" />
		<div class="product_info">
			<p>Ut fringilla enim sed turpis. Sed justo dolor, convallis at.</p>
			<h3>$65</h3>
			<div class="buy_now_button">
				<a href="subpage.html">Buy Now</a>
			</div>
			<div class="detail_button">
				<a href="subpage.html">Detail</a>
			</div>
		</div>
		<div class="cleaner">&nbsp;</div>
	</div>

	<div class="cleaner_with_height">&nbsp;</div>

</div>
<!-- end of content right -->

<div class="cleaner_with_height">&nbsp;</div>
</div>
<!-- end of content -->
<?php
include ("footer.php");
?>
