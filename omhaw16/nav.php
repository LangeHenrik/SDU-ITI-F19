
<?php 
    
    echo "NavBar goes here.   ";
$loginChecker = "";

if ($_SESSION['userName'] = "oooomar" && $_SESSION['userID'] = 1) { 
    
    echo "Hello, " . $_SESSION['userName'];

}

else if ($_SESSION['userName'] = "omarr" && $_SESSION['userID'] = 2) { 
    
    echo "Hello " . $_SESSION['userName'];

} else {

	echo "Hello guest.";
}

if ($_SESSION["login"] = 1) { 

    $loginChecker = $_SESSION['login'];
    echo "Logged in.";

} else { 
    
        echo "Session not logged in.";
        
    }
?>
