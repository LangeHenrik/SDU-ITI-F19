<style><?include("css/ajax.css");?></style>
<?ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>


    <!-- Ajax, get users from search bar without refresh -->
    <script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("user-search").innerHTML = "";
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("user-search").innerHTML = this.responseText;
                }
                console.log(str);
            };
            //xmlhttp.open("GET","../mvc/app/views/users/ajax.php?q="+str,true);
            xmlhttp.open("GET", "Users/search/" + str, true);
            xmlhttp.send();
        }
    }
    </script>

</head>
<div id="user-search"></div>
<?php 

//ajax get viewbag
if($viewbag) {
echo "<table>
  <tr>
  <th>UserID</th>
  <th>Username</th>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Zip</th>
  <th>City</th>
  <th>Email</th>
  <th>Phonenumber</th>
</tr>";
foreach($viewbag as $search) 
{
    echo "<br>";
    echo "<tr>";
    echo "<td>" . $search['UserID'] . "</td>";
    echo "<td>" . $search['Username'] . "</td>";
    echo "<td>" . $search['First_Name'] . "</td>";
    echo "<td>" . $search['Last_Name'] . "</td>";
    echo "<td>" . $search['Zip'] . "</td>";
    echo "<td>" . $search['City'] . "</td>";
    echo "<td>" . $search['Email'] . "</td>";
    echo "<td>" . $search['Phone_Number'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>";
} 

?>
</body>

</html>