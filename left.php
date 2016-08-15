<?php
	$connection = new MongoClient ();
	$dbconnection = $connection->bookDB;
	$collection = $dbconnection->project;
	$cursor = $collection->find ();
	$cursor = $cursor->sort (array('Rating'=>-1));
	$cursor = $cursor->limit (5);
		
	$map = new MongoCode("function() { emit(this.Genre,1); }");
	$reduce = new MongoCode("function(key, values) {return Array.sum(values)}");
	$mapreduceOutput = $dbconnection->command(array(
			"mapreduce" => "project",
			"map" => $map,
			"reduce" => $reduce,
			"out" => array("replace" => "genreCounts")));
	$cursorGenre = $dbconnection->selectCollection($mapreduceOutput['result'])->find();
	$cursorGenre = $cursorGenre->skip(1);
	
	$map2 = new MongoCode("function() {
                       emit( this.Author , { rating : this.Rating , count : 1 } );
                    }");
	$reduce2 = new MongoCode("function(keySKU, countObjVals) {
                     reducedVal = { count: 0, rating: 0 };

                     for (var idx = 0; idx < countObjVals.length; idx++) {
                         reducedVal.count += countObjVals[idx].count;
                         reducedVal.rating += countObjVals[idx].rating;
                     }

                     return reducedVal;
                  }");
	$finalize2 = new MongoCode("function (key, reducedVal) {

                       reducedVal.avg = reducedVal.rating/reducedVal.count;

                       return reducedVal;

                    }");
	
	$mapreduceOutput2 = $dbconnection->command(array(
			"mapreduce" => "project",
			"map" => $map2,
			"reduce" => $reduce2,
			"finalize" => $finalize2,
			"out" => array("replace" => "Author_Collection")));
	$cursorAuthor = $dbconnection->selectCollection($mapreduceOutput2['result'])->find();
	$cursorAuthor = $cursorAuthor->sort (array("value.avg" => -1));
	$cursorAuthor = $cursorAuthor->limit(5);
?>
<div id="templatemo_content">

	<div id="templatemo_content_left">
		<div class="templatemo_content_left_section">
			<h1>Top picks</h1>
			<ul>
            	<?php								
					foreach ( $cursor as $obj ) 
					{ ?>
						<li><a href="bookDetails.php?var=<?php echo $obj['Title'];?>"> <?php echo $obj['Title']; ?> </a></li>
				<?php } ?>
            </ul>
		</div>
		<div class="templatemo_content_left_section">
			<h1>Top Author</h1>
			<ul>
				<?php								
					foreach ( $cursorAuthor as $obj ) 
					{ ?>
						<li><a href="bookAuthorSearch.php?page=1&var=<?php echo $obj['_id'];?>"> <?php echo $obj['_id']; ?> </a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="templatemo_content_left_section">
			<h1>Genre</h1>
			<ul>
				<?php foreach ($cursorGenre as $obj) {
					?><li><a href="bookGenreSearch.php?page=1&var=<?php echo $obj['_id'];?>"> <?php echo $obj['_id'] ?> (<?php echo $obj['value'] ?>) </a></li>				
				<?php } ?>
			</ul>
		</div>
	</div>
	<!-- end of content left -->