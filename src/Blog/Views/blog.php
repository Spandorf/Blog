	<body>
		Blog goes here	
		<a href="/Blog/postblog">New Post!</a>		
	</body>
			<div class="panel left">
				<h1>My Blog Posts</h1>
                <?php foreach($postfeed as $post){ ?>
		                <div class="postWrapper">
		                    <span class="name"><?php echo $post["post"]; ?></span> 
	                        <span class="time"><?php echo $post["time"]; ?></span>
		                </div>
		      <?php } ?>			
			</div>