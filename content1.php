<?php
	$genreFictionCursor = fnGenreList($collection, 'Fiction', 3);
	$genreComicsCursor = fnGenreList($collection, 'Comics', 3);
	$genreScienceCursor = fnGenreList($collection, 'Science', 3);
	$genreEconomicsCursor = fnGenreList($collection, 'Tourism', 3);
?>
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
<div id="templatemo_content_right">
	<div class="templatemo_product_box">
		<h1>
			Top Comics Books <span>(by Rating)</span>
		</h1>
		<?php
		foreach ( $genreComicsCursor as $obj ) {
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
			Top Fictional Books <span>(by Rating)</span>
		</h1>
            	<?php
													foreach ( $genreFictionCursor as $obj ) {
														?>
						<div class="book"><a href="bookDetails.php?var=<?php echo $obj['Title'];?>"><img
			class="abcimg" width=80 height=150
			style="background: url('images/abc.png');"
			src=<?php echo $obj['URLs'];?> alt=<?php echo $obj['Title'];?> /><div class="title" ><?php echo $obj['Title'];?></div></a></div>
				<?php } ?>
		<div class="cleaner">&nbsp;</div>
	</div>

	<div class="cleaner_with_height">&nbsp;</div>

	<div class="templatemo_product_box">
		<h1>
			Top Science Books <span>(by Rating)</span>
		</h1>
		<?php
		foreach ( $genreScienceCursor as $obj ) {
			?>
						<div class="book"><a href="bookDetails.php?var=<?php echo $obj['Title'];?>"><img
			class="abcimg" width=80 height=150
			style="background: url('images/abc.png');"
			src=<?php echo $obj['URLs'];?> alt=<?php echo $obj['Title'];?> /><div class="title" ><?php echo $obj['Title'];?></div></a></div>
				<?php } ?>
		<div class="cleaner">&nbsp;</div>
	</div>

	<div class="cleaner_with_width">&nbsp;</div>
	
	<div class="templatemo_product_box">
		<h1>
			Top Tourism Books <span>(by Rating)</span>
		</h1>
		<?php
		foreach ( $genreEconomicsCursor as $obj ) {
			?>
						<div class="book"><a href="bookDetails.php?var=<?php echo $obj['Title'];?>"><img
			class="abcimg" width=80 height=150
			style="background: url('images/abc.png');"
			src=<?php echo $obj['URLs'];?> alt=<?php echo $obj['Title'];?> />
		<div class="title" ><?php echo $obj['Title'];?></div></a></div>
				<?php } ?>
		<div class="cleaner">&nbsp;</div>
	</div>

	<div class="cleaner_with_height">&nbsp;</div>

	
</div>
<!-- end of content right -->

<div class="cleaner_with_height">&nbsp;</div>
</div>
<!-- end of content -->