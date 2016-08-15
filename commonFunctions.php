<?php
	function fnConnection($db, $col)
	{
		//echo "inside fnConnection";
		$connection = new MongoClient ();
		$dbconnection = $connection->$db;
		$collection = $dbconnection->$col;
		return $collection;
	}
	
	function fnGenreList($collection, $genre, $noOfList)
	{
		$genreQuery = array('Genre' => $genre);
		$genreCursor = $collection->find ($genreQuery);
		$genreCursor = $genreCursor->sort (array('Rating'=>-1));
		$genreCursor = $genreCursor->limit ($noOfList);
		return $genreCursor;
	}
	
	function urlDataInsert($pageInd, $url, $time, $uuid)
	{	
		$ch2 = curl_init();
		
		$insert = array(
			'id' => $uuid,
			'pageInd' => $pageInd,
			'url' => $url,
			'time' => $time
		);
		 
		$payload = json_encode($insert);
		 
		curl_setopt($ch2, CURLOPT_URL, 'http://127.0.0.1:5984/logs/'.$insert['id']);
		curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'PUT'); /* or PUT */
		curl_setopt($ch2, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
			'Content-type: application/json',
			'Accept: */*'
		));
		 
		 
		$response = curl_exec($ch2);
		 
		curl_close($ch);
	}
?>