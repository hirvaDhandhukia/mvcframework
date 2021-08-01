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

<?php if(isset($_SESSION['user_id'])) : ?>
	<div class="wrapper-landing">
		<h1>buy</h1>
	</div>
<?php else : ?>
	<div class="wrapper-landing">
		<h1>Find your favourite E-books here</h1>
		<h2>Login to purchase</h2>
		<!-- eat sleep read repeat -->
	</div>
<?php endif; ?>

</div>
