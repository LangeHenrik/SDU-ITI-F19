<?php
require_once 'db_config.php';
$header = "";
$error_header = "";
$link = "";
$error_link = "";
$desc = "";
$error_desc = "";

$conn = new PDO("mysql:host=$DB_servername;dbname=$DB_name", $DB_username, $DB_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $header = trim($_POST["header"]);
    $link = trim($_POST["link"]);
    $desc = trim($_POST["desc"]);
    $stmt = $conn->prepare("INSERT INTO pictures ( header, picturelink, desc) VALUES (:header, :link, :desc)");
    $stmt->bindParam(':header', $header);
    $stmt->bindParam(':password', $link);
    $stmt->bindParam(':name', $desc);
    $stmt->execute();
    header("location: iFrame.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../MVC/public/css/register.css">
    <script src="myscripts.js"></script>
</head>
<body>
<div id="frm">
    <form onsubmit="return checkFields()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group <?php echo (!empty($error_header)) ? 'has-error' : ''; ?>" >
            <label>Title:</label><br>
            <input id="header" type="text" name="header" class="form-control" value="<?php echo $header; ?>">
            <span id="header-help" class="help-block"><?php echo $error_header; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($error_link)) ? 'has-error' : ''; ?>">
            <label>Link to the image:</label><br>
            <input id="link" type="text" name="link" class="form-control" value="<?php echo $link; ?>">
            <span id="link-help" class="help-block"><?php echo $error_link; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($error_desc)) ? 'has-error' : ''; ?>">
            <label>Description:</label><br>
            <input id="desc"type="text" name="desc" class="form-control" value="<?php echo $desc; ?>">
            <span id="desc-help" class="help-block"><?php echo $error_desc; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>

    </form>
</div>
<script>
    function checkFields(){
        var errors = 0;
        var header = document.getElementById("header").value;
        var link = document.getElementById("link").value;
        var desc = document.getElementById("desc").value;
        var regex = new RegExp("/(http|https)+\:+\\/+\S+\.+\.(jpg|png)/g")
        if (header.length <= 50){
            document.getElementsById("header-help").innerHTML = "The title can only be a maximum of 50 characters including spaces";
            errors++;
        }
        if (link.length <= 200) {
            errors++;
            document.getElementById("link-help").innerHTML = "The link can only have a maximum of 200 characters";
        }
        if (desc.length <= 200){
            errors++;
            document.getElementById("desc-help").innerHTML = "The description can only have a maximum of 200 characters";
        }
        if (regex.test(link)== true) {
            errors++;
            document.getElementById("link-help").innerHTML = "The link needs to be a valid link and eithe Jpeg or PNG";
        }
        if (errors == 0){
            return true;
        }else {
            return false;
        }
    }
</script>
</body>
</html>
