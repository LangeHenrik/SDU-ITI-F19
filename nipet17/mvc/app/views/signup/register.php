<?php

include '../app/views/partials/menu.php';
?>

<br><br><br>

		<main>
			<form onsubmit="return isValidForm()" class="fifty" method="post" action="/nipet17/mvc/public/user/">
				<?php
					if ($_SESSION['count'] > 0) {
						echo "<h2>".$_SESSION['message']."</h2><br>";
					}
				?>
				<fieldset>
				<legend><h3>Sign up</h3></legend>
					<label for="Name" id="lname">Name</label>
					<br>
					<input type="name" name="name" id="name" placeholder="Fullname here.."/>
					<img src="/nipet17/mvc/app/views/partials/fejl.png" alt="error" id="ename">
					<br>

					<label for="username" id="luser">Username</label>
					<br>
					<input type="username" name="username" id="username" placeholder="Username here.."/>
					<img src="/nipet17/mvc/app/views/partials/fejl.png" alt="error" id="euser">
					<br>

					<label for="email" id="lemail">E-mail</label>
					<br>
					<input type="text" name="email" id="email" placeholder="E-mail here.."/>
					<img src="/nipet17/mvc/app/views/partials/fejl.png" alt="error" id="eemail">
					<br>

					<label for="phone" id="lphone">Phone</label>
					<br>
					<input type="text" name="phone" id="phone" placeholder="Phone here.."/>
					<img src="/nipet17/mvc/app/views/partials/fejl.png" alt="error" id="ephone">
					<br>

					<label for="zip" id="lzip">Zip code</label>
					<br>
					<input type="text" name="zip" id="zip" placeholder="Zip code here.."/>
					<img src="/nipet17/mvc/app/views/partials/fejl.png" alt="error" id="ezip">
					<br>

					<label for="city" id="lcity">City</label>
					<br>
					<input type="text" name="city" id="city" placeholder="City here.."/>
					<img src="/nipet17/mvc/app/views/partials/fejl.png" alt="error" id="ecity">
					<br>

					<label for="password" id="lpassword">Password</label>
					<br>
					<input type="password" name="password" id="password" placeholder="Password here.."/>
					<img src="/nipet17/mvc/app/views/partials/fejl.png" alt="error" id="epassword">
					<br>

					<label for="password2" id="lpassword2">Verify password</label>
					<br>
					<input type="password" name="password2" id="password2" placeholder="Password here.."/>
					<img src="/nipet17/mvc/app/views/partials/fejl.png" alt="error" id="everify">
					<br><br>

					<input type="submit" name="submit_btn" id="submit"/>
					<br><br>
				</fieldset>
			</form>
		</main>

	</body>

<?php
include '../app/views/partials/foot.php';
