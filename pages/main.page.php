<?php # main.inc.php

/* 
 *	This is the main content module.
 *	This page is included by index.php.
 */

// Redirect if this page was accessed directly:
if (!defined('BASE_URL')) {

	// Need the BASE_URL, defined in the config file:
	require_once ('../modules/config.inc.php');
	
	// Redirect to the index page:
	$url = BASE_URL . 'index.php';
	header ("Location: $url");
	exit;
	
} // End of defined() IF.
?>

<h2>Welcome to Leaves.</h2>
<p>Welcome to Leaves, a static, 3 column layout made with your usual CSS and XHTML. It is able to correctly accommodate any font size increases or shrinkages (Is that a word?). It seems to work fine in Firefox, Opera, Internet Explorer and Safari. It's more minimal than other designs, because I think images (drop shadows, giant header images) are being obsessively over used these days. I think it detracts from the content and shoves way too much information to a viewer all at the same time, so here you go: Leaves, a minimalist design. You are encouraged to change the design to fit your required look and feel.</p>
<h2>Why I like Latin Filler Text. </h2>
<p>Aenean eros arcu, condimentum nec, dapibus ut, tincidunt sit amet, urna. Quisque viverra, eros sed imperdiet iaculis, est risus facilisis quam, id malesuada arcu nulla luctus urna. Nullam et est. Vestibulum velit sem, faucibus cursus, dapibus vestibulum, pellentesque et, urna. Donec luctus. Donec lectus. Aliquam eget eros facilisis tortor feugiat sollicitudin. Integer lobortis vulputate sapien. Sed iaculis erat ac nunc. <a href="#">Etiam eu enim.</a> Mauris ipsum urna, rhoncus at, bibendum sit amet, euismod eget, dolor. Mauris fermentum quam vitae ligula. Vestibulum in libero feugiat justo dictum consectetuer. Vestibulum euismod purus eget elit. Nunc sed massa porta elit bibendum posuere. Nunc pulvinar justo sit amet odio. In sed est. Phasellus ornare elementum nulla. Nulla ipsum neque, cursus a, viverra a, imperdiet at, enim. Quisque facilisis, diam sed accumsan suscipit, odio arcu hendrerit dolor, quis aliquet massa nulla nec sem. </p>
<h2>Because I just do. </h2>
<p><a href="#">Proin sagittis leo in diam</a>. Vestibulum vestibulum orci vel libero. Cras molestie pede quis odio. Phasellus tempus dolor eu risus. Aenean tellus tortor, dignissim sit amet, tempus eu, eleifend porttitor, ipsum. Fusce diam. Suspendisse potenti. Duis consequat scelerisque lacus. Proin et massa. Duis adipiscing, lectus a euismod consectetuer, pede libero ornare dui, et lacinia ipsum ipsum nec lectus. Suspendisse sed nunc quis odio aliquet feugiat. Pellentesque sapien. Phasellus sed lorem eu augue luctus commodo. Nullam interdum convallis nunc. Fusce varius. Ut egestas. Fusce interdum iaculis pede. Sed vehicula vestibulum odio. <a href="#">Donec id diam. </a></p>