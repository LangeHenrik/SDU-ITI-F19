<style><?include("css/home.css");?></style>
<style><?include("css/bootstrap.css");?></style>

<?php
if(!isset($_SESSION['user_id']))
{    
        exit("not logged in");
}
session_start();
include("./common/nav.php");
include("./common/dao.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHOTO WALL</title>
</head>
<body>
        <div id="landing">
            <div id="landing-text">
                <div id="landing-text-inner">
                    <h1><b>PHOTO WALL</b></h1>
                    <h6>EXPLORE STUNNING PHOTOGRAPHS</h6>
                </div>
            </div>
        </div>
        <?php
        $searchItems = array('dog','skyscrapper','poverty','happy','love','bike','house', 'food','dog'
        ,'skyscrapper','poverty','happy','love','bike','house', 'food','dog','skyscrapper','poverty','happy','love'
        ,'bike','house', 'food', 'dog','skyscrapper','poverty','happy','love','bike','house', 'food');
        for($i = 1; $i <= 20; $i++)
        {
           $search = $searchItems[$i];
            print '            
            </div>
            <!--random billede-->
            <img src='."https://source.unsplash.com/1600x900/?.'$search".' alt="">
            <!--Random caption ord - lorem 10 /tab-->
            <div class="caption">
                <h3>Photo '.$i.'</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, perferendis minus repudiandae, 
                    pariatur cumque qui commodi tempora enim tempore dignissimos ex omnis debitis at eius 
                    quibusdam fugit inventore rem expedita!</p>
            </div>
            
            ';
        }
        ?>
</body>
</html>
