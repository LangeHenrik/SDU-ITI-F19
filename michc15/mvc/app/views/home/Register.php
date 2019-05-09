
		<?php include '../app/views/partials/menu.php'; ?>
		<div class= "container">
		<div class= "card card-body bg-light mt-5">

				<form action="/michc15/mvc/public/Register/register" method="POST" onsubmit="return checkUserFields(){" enctype='multipart/form-data'>
					<div class="form-row">
					<div class="col">
					<?php if(!$viewbag['user_exists']){ ?>
						<input type='text' placeholder="Username" name='username'class="form-control" id='username' value='<?=$viewbag['username']?>' />
					<?php } else { ?>
						<input type='text'placeholder="Username" name='username'class="form-control" id='username' value='<?=$viewbag['username']?>' style='border:2px solid red;'/>
					<?php } ?>
					</div>
					<div class="col">
					<?php if(!$viewbag['email_exists']){ ?>
						<input type='text' placeholder="Email" name='email'class="form-control" id='email' value='<?=$viewbag['email']?>' />
					<?php } else { ?>
						<input type='text'placeholder="Email" name='email'class="form-control" id='email'  value='<?=$viewbag['email']?>' style='border:2px solid red;'/>
					<?php } ?>
					</div>
					</div>
					<br>
					<div class="form-row">
					<div class="col">
					<input type="password" placeholder="Password" name="password"class="form-control" id="password" />
					</div>
					<div class="col">
					<input type="password" placeholder= "Repeat Password" name="password_repeat"class="form-control" id="password_repeat" />
					</div>
					</div>
					<br>
					<div class="form-row">
					<div class="col">
					<input type="text" placeholder= "First name"name="first_name"class="form-control" id="first_name" value='<?=$viewbag['first name']?>' />
					</div>
					<div class="col">
					<input type="text" placeholder="Last name" name="last_name"class="form-control" id="last_name" value='<?=$viewbag['last name']?>' />
					</div>
					</div>
					<br>
					<div class="form-row">
    				<div class="form-group col-md-6">
					<input type="text" placeholder= "Phone number" name="phone"class="form-control" id="phone" value='<?=$viewbag['phone']?>' />
					</div>
					<div class="form-group col-md-4">
					<input type="text"placeholder="City" name="city"class="form-control" id="city" value='<?=$viewbag['city']?>' />
					</div>
					<div class="form-group col-md-2">
					<input type="text" placeholder= "ZIP" name="zip"class="form-control" id="zip" value='<?=$viewbag['zip']?>' />
					</div>
					</div>
					<div class="col text-center">
					<i class="fa fa-picture-o fa-2x mr-2"></i>
					<label class="btn btn-primary" for="file-selector">
    				<input id="file-selector" name='image' type="file" class="d-none">
  					 Upload
					</label>
					</div>
					<br>
					<input type="submit"  name="submit" id="submit" value='Register now'class="btn btn-primary btn-block"/>
					</div>	
				</form>
			</div>
			</div>
			</div>
		</div>
	</body>
</html>