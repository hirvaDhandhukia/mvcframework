<?php
// var_dump($_SESSION);
// this is html file page details

// var_dump($data);
// foreach ($data['users'] as $user) {
// 	echo "Information: " . $user->user_name . " " . $user->user_email;
// 	echo "<br>";
// }
?>

<div id="section-landing">
<?php
require APPROOT . '/views/includes/head.php';
?>
<div class="navbar">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>
</div>

<?php if(isLoggedIn()) : ?>
	<div class="wrapper-loggedin">
		<h2>You are logged in!</h2>
		<h3>Buy Here:</h3>
		<hr size=0>
	</div>
<?php else : ?>
	<div class="wrapper-landing">
		<h1>Find your favourite E-books here</h1>
		<h2>Login to purchase</h2>
		<!-- eat sleep read repeat -->
	</div>
<?php endif; ?>

</div>
