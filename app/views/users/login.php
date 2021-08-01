<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>
</div>

<?php
// var_dump($_SESSION);
?>

<!-- the first div will be the full width (100%) and the wrapper will be at 80% inside the full width -->
<div class="container-login">
	<div class="wrapper-login">
		<h2>Sign in</h2>

		<form action="<?php echo URLROOT; ?>/users/login" method="post">
			<input type="text" placeholder="Username" name="username">
			<span class="invalidFeedback">
				<?php echo $data['usernameError']; ?>
			</span>

			<input type="password" placeholder="Password" name="password">
			<span class="invalidFeedback">
				<?php echo $data['passwordError']; ?>
			</span>

			<button id="submit" type="submit" value="submit">Submit</button>

			<p class="options">Don't have an account? <a href="<?php echo URLROOT; ?>/users/register">Signup here</a> </p>
		</form>
	</div>
</div>
