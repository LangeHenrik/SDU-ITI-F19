<?php
	class forms{

		function login(){
			if(isset($_COOKIE['user'])){
                		$user = $_COOKIE['user'];
        		}else{
				$user = "";
			}
	                echo "<form id=\"form\" action=\"login.php\" method=\"POST\">";
                        echo "<h1> LOGIN </h1>";
                        echo "<input type=\"text\" class=\"text\" placeholder=\"Username\" name=\"username\" value=\"$user\" >";
	                echo "<input type=\"password\" class=\"text\" placeholder=\"Password\" name=\"password\">";
                       // echo "<input type=\"checkbox\" value=\"checked\" name=\"save_cookie\">";
                        echo "<input type=\"submit\" class=\"text\" value=\"Login &#8605;\" id=\"submit\">";   
                	echo "</form>";
			echo "<a class=\"link\" href=\"signup.php\">Opret bruger</a> ";
		}

		function signup(){
	                echo "<form onsubmit=\"return checkForm()\" id=\"form\" action=\"signup.php\" method=\"POST\">";
                        echo "<h1> Signup </h1>";
                        echo "<input type=\"text\" class=\"text\" placeholder=\"Username\" name=\"username\" >";
                        echo "<input type=\"text\" class=\"text\" placeholder=\"E-mail\" name=\"mail\" >";
	                echo "<input id=\"password\"type=\"password\" class=\"text\" placeholder=\"Password\" name=\"password\">";
                        echo "<input type=\"submit\" class=\"text\" value=\"Opret Bruger\" id=\"submit\">";   
                	echo "</form>";
		}

	}
?>
