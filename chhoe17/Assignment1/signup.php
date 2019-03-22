<?php
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>signup</h2>
		<form class="signup-form" action="includes/signup.inc.php" method="POST">
			<input type="text" name="phone" placeholder="phone">
			<input type="text" name="zip" placeholder="zip">
			<input type="text" name="email" placeholder="E-mail">
			<input type="text" name="name" placeholder="name">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" name="submit">Sign up</button>
		</form>
	</div>
</section>

<?php
	include_once 'footer.php';
?>