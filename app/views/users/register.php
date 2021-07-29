<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>
</div>

<div class="container-login">
	<div class="wrapper-login">
		<h2>Sign up</h2>

		<form action="<?php echo URLROOT; ?>/users/register" method="post">
			<input type="text" placeholder="Username" name="username">
			<span class="invalidFeedback">
				<?php echo $data['usernameError']; ?>
			</span>

            <input type="email" placeholder="E-mail" name="email">
			<span class="invalidFeedback">
				<?php echo $data['emailError']; ?>
			</span>

			<input type="password" placeholder="Password" name="password">
			<span class="invalidFeedback">
				<?php echo $data['passwordError']; ?>
			</span>

            <input type="password" placeholder="Confirm Password" name="confirmPassword">
			<span class="invalidFeedback">
				<?php echo $data['confirmPasswordError']; ?>
			</span>

			<button id="submit" type="submit" value="submit">Submit</button>

			<p class="options">Already have an account? <a href="<?php URLROOT?>/users/register">Signin here</a> </p>
		</form>
	</div>
</div>
