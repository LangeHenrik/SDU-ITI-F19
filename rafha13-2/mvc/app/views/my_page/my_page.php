<?php include '../app/views/partials/header.php';?>

			<div class="maincolumn">
				<?php $user = $this->model('Mypage')->loadData(); ?>


				<div class="profilebox">
					<h1> <?=$user[0]["username"]?> </h1>
					<p> Password: SECRET! </p>
					<p> First name: <?=$user[0]["user_Firstname"]?> </p>
					<p> Last name: <?=$user[0]["user_Lastname"]?> </p>
					<p> ZIP-code: <?=$user[0]["user_ZIP"]?> </p>
					<p> City: <?=$user[0]["user_City"]?> </p>
					<p> Email address: <?=$user[0]["user_Email"]?> </p>
					<p> Phone number: <?=$user[0]["user_phone"]?> </p>
				
					<?php if ($user[0]["user_Image"] == null) : ?> 
						<img class="profilepic" src="/rafha13-2/mvc/public/images/stock.jpg" >
					<?php  else : 
						echo '
							<img class="profilepic" src="data:' . $user[0]["user_img_type"] . '; base64, ' . base64_encode($user[0]["user_Image"]) . '"/>
							';
						endif;
					?>
						
					</br>
					
					<form action="/rafha13-2/mvc/public/mypage/change" method="POST" enctype="multipart/form-data" id="upload-picture">
						Change my profile picture:
						
						</br></br>
						<input type="file" name="profileImg">
						</br>
						<!--<input type="submit">-->
						<button type="submit"> Change ProfilePic </button>
					</form>
					</br> </br> </br> </br>
					
					<button onclick="ajaxfunction()"> Delete Account...! </button>
					</br>
					<div id="ajaxcall"></div>
				</div>
			</div>

<?php include '../app/views/partials/footer.php'; ?>
			


<script>
	//AJAX call:
	
		function ajaxfunction() {
		
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("ajaxcall").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "/rafha13-2/mvc/app/models/ajax_delete.php", true);
			xmlhttp.send();
		
		}        
</script>