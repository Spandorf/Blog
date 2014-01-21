<?php

Class model{

	function test()
	{
		// Create connection
		$con=mysqli_connect("localhost","root","password");

		// Check connection
		if (mysqli_connect_errno($con))
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		else
		{
/*			$result = mysqli_query($con,"SELECT * FROM Bands");

			while($row = mysqli_fetch_array($result))
			{
				echo '-----------' . PHP_EOL;
				echo $row['BandID'] . PHP_EOL;
				echo $row['BandName'] . PHP_EOL;
				echo '-----------' . PHP_EOL;

			}
*/		}
	}

	function connect(){
		$con = mysqli_connect("localhost","root","");
		if (mysqli_connect_errno($con))
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		return $con;
	}

	function encode($text) {

    	return str_rot13($text);
	}

	function postBlog($post) {
		$con = $this->connect();
		$thePost = $post;
		$timePosted = new DateTime('NOW',new DateTimeZone('America/Chicago'));
			
		$query = $con->prepare("INSERT INTO steve.blogpost(post, timestamp) VALUES (?,?)");
			
		$query->bind_param("ss",$thePost,$timePosted->format('Y-m-d H:i:s'));
			
		$query->execute();
				
		//close connection
		mysqli_close($con);
	} 

	function getBlogPosts(){
		$i=0;
		$con = $this->connect();
		$posts = array();
		$query = $con->prepare("SELECT * FROM steve.blogpost");
		$query->execute();
			
		$result = $query->get_result();
							
		while($row = mysqli_fetch_array($result))
		{
				$post = array("post" => $row['post'], "time" => $row['timestamp']);				
				$posts[$i] = $post;				
				$i++;
		}
		return $posts;
		mysqli_close($con);
	}





}