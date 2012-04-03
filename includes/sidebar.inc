<!-- Start sidebar -->
<aside>
	<!-- Search Bar -->
	<section id="search">
		<h2>Search</h2>
		<form id="search" action="#" method="get">
			<input type="text" name="search_terms" placeholder="Search..." /> <input type="submit" value="Go" />
		</form>
	</section>
	<!-- Search Bar -->
	
	<!-- Featured Produce -->
	<section id="featured_produce">
    	<h2>Featured Produce</h2>
		<?php
		// We're not going to add a featured stat, but to make it seem featured we're going to get 3 random products.
		$query = $db->query("SELECT * FROM `products` ORDER BY RAND() LIMIT 0, 3");

		// Loop through the random produce
		while($product = $query->fetch_object()) {

			?><div class="product">
				<a href="<?php echo BASE_URL; ?>product?id=<?php echo $product->id; ?>">
					<h3><?php echo $product->title; ?></h3>
					<img src="<?php echo BASE_URL; ?>images/thumb/<?php echo $product->image; ?>" alt="<?php echo $product->title; ?>" class="product_img" />
					<p>£<?php echo $product->price; ?></p> 
				</a>
			</div><?php
		}
		?>
	</section>
	<!-- Featured Produce -->
</aside>
<!-- End sidebar -->