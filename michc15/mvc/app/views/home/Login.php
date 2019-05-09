
		<?php include '../app/views/partials/menu.php'; ?>
		<div class= "container">
		<div class="row">
		<div class= "card card-body bg-light mt-5">
			<div class='content' id='login'>
				<form action="/michc15/mvc/public/Login/login" method="post" onsubmit="return checkFields()">
				<div class="form-row">
		<div class="col">
					<input type="text" placeholder="Username" name="username" class="form-control"  id="username" value='<?=$viewbag['username']?>' />
					</div>
					<div class="col">	
					<input type="password" placeholder="Password" name="password" class="form-control" id="password"/>
					</div>
					</div>
					<br>
					<div class="col text-center">
					<input type="submit" name="submit" class="btn btn-primary" id="submit" value='Login'/> 	
				</form> 
				<div class="col text-center">
				<br>
			<p>Don't have an account?	<a href="/michc15/mvc/public/Register" class='button'> Register </a>	</p>	
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
