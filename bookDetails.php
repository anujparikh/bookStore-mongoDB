<style>
.title {
	clear: left;
	float: left;
	width: 80px;
}
.book{
float : left;

}
</style>
<?php
include("commonFunctions.php");
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
date_default_timezone_set("America/New_York");
$time = date("h:i:sa");
$uuid = uniqid();
urlDataInsert("BookDetailsPage", $actual_link, $time, $uuid);
include("detailsHeader.php");
include("left.php");
$variable = $_GET['var'];
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
	$Genre = $obj['Genre'];
}

$query = array('Author' => $author);
$cursorAuthor1 = $collection->find ($query);
$cursorAuthor1 = $cursorAuthor1->skip (1);
$cursorAuthor1 = $cursorAuthor1->limit(3);

$query = array('Genre' => $Genre);
$cusorGenre1 = $collection->find ($query);
$cusorGenre1 = $cusorGenre1->sort (array('Rating'=>-1));
$cusorGenre1 = $cusorGenre1->skip (1);
$cusorGenre1 = $cusorGenre1->limit(3);

?>
<script>
function addToCart(isbn,price,user) {
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
		<?php
		foreach ( $cursorAuthor1 as $obj ) {
			?>
					<div class="book">	<a href="bookDetails.php?var=<?php echo $obj['Title'];?>"><img
			class="abcimg" width=80 height=150
			style="background: url('images/abc.png');"
			src=<?php echo $obj['URLs'];?> alt=<?php echo $obj['Title'];?> /><div class="title" ><?php echo $obj['Title'];?></div></a></div>
				<?php } ?>
		<div class="cleaner">&nbsp;</div>
	</div>

	<div class="cleaner_with_width">&nbsp;</div>

	<div class="templatemo_product_box">
		<h1>
			Books of same Genre</span>
		</h1>
		<?php
		foreach ( $cusorGenre1 as $obj ) {
			?>
					<div class="book">	<a href="bookDetails.php?var=<?php echo $obj['Title'];?>"><img
			class="abcimg" width=80 height=150
			style="background: url('images/abc.png');"
			src=<?php echo $obj['URLs'];?> alt=<?php echo $obj['Title'];?> /><div class="title" ><?php echo $obj['Title'];?></div></a></div>
				<?php } ?>
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