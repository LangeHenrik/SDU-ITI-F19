<div class="signin">
				<!--Button for fetching the sign up modal-->
				<button onclick="document.getElementById('id01').style.display='block'" class="signUP" >Sign Up</button>

				<div id="id01" class="modal">

					<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
				  
					<form class="modal-content" onsubmit="checkFields()" action="/flore17/mvc/public/users/makeUser/" method="POST" >
					<!--Form for making a user (checks inputs as the are entered)-->
						<div class="container">
					
							<h1>Sign Up</h1>
					  
							<p>Please fill in this form to create an account.</p>
					  
							<hr>

							<label for="name">Choose Username:</label>

							<input onblur="checkUsernameFree()" type="text" name="newusername" id="newusername" placeholder="Username" required> 

							<label for="password">Enter a Password:</label>

							<input onblur="checkPassword()" type="password" name="passw" id="passw" placeholder="Password" required> 

							<label for="password">Repeat Password:</label>

							<input onblur="checkPasswordMatch()" type="password" name="enterPassword" id="enterPassword" placeholder="Password"required> 

							<label for="fname">Enter Firstname:</label>

							<input onblur="checkFirstname()" type="text" name="firstname" id="firstname" placeholder="Firstname"required> 

							<label for="name">Enter Lastname:</label>

							<input onblur="checkLastname()" type="text" name="lastname" id="lastname" placeholder="Lastname"required> 

							<label for="phone">Enter Phone Number:</label>

							<input onblur="checkPhone()" type="text" name="phone" id="phone" placeholder="+45********"required> 

							<label for="email">Enter Email Address:</label>

							<input onblur="checkEmail()" type="text" name="email" id="email" placeholder="Mail"required>
	 
							<label for="zip">Enter Zip:</label>

							<input onblur="checkZip()" type="text" name="zip" id="zip" placeholder="Zip-code"required> 

							<label for="city">Enter City:</label>
	 
							<input onblur="checkCity()" type="text" name="city" id="city" placeholder="City"required> 
					  
							<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

							<div class="clearfix">
						
								<button type="submit" class="signupbtn">Sign Up</button>
					  
								<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
						
							</div>
					  
						</div>
					
					</form>
				
				</div>
			  
			</div>