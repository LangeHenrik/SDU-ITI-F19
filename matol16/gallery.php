<?php
    $time_0 = "";
    $time_1 = "";
    $time_2 = "";
    $time_3= "";
    $time_4 = "";
    $time_5 = "";
    $time_6 = "";
    $time_7 = "";
    $time_8 = "";
    $time_9 = "";
    $time_10 = "";
    $time_11 = "";
    $time_12 = "";
    $time_13 = "";
    $time_14 = "";
    $time_15 = "";
    $time_16 = "";
    $time_17 = "";
    $time_18 = "";
    $time_19 = "";
    $header_0 = "";
    $header_1 = "";
    $header_2 = "";
    $header_3 = "";
    $header_4 = "";
    $header_5 = "";
    $header_6 = "";
    $header_7 = "";
    $header_8 = "";
    $header_9 = "";
    $header_10 = "";
    $header_11 = "";
    $header_12 = "";
    $header_13 = "";
    $header_14 = "";
    $header_15 = "";
    $header_16 = "";
    $header_17 = "";
    $header_18 = "";
    $header_19 = "";
    $link_0 = "";
    $link_1 = "";
    $link_2 = "";
    $link_3 = "";
    $link_4 = "";
    $link_5 = "";
    $link_6 = "";
    $link_7 = "";
    $link_8 = "";
    $link_9 = "";
    $link_10 = "";
    $link_11 = "";
    $link_12 = "";
    $link_13 = "";
    $link_14 = "";
    $link_15 = "";
    $link_16 = "";
    $link_17 = "";
    $link_18 = "";
    $link_19 = "";
    $desc_0 = "";
    $desc_1 = "";
    $desc_2 = "";
    $desc_3= "";
    $desc_4 = "";
    $desc_5 = "";
    $desc_6 = "";
    $desc_7 = "";
    $desc_8 = "";
    $desc_9 = "";
    $desc_10 = "";
    $desc_11 = "";
    $desc_12 = "";
    $desc_13 = "";
    $desc_14 = "";
    $desc_15 = "";
    $desc_16 = "";
    $desc_17 = "";
    $desc_18 = "";
    $desc_19 = "";

require_once'db_config.php';

// connect to the database
$link = new PDO("mysql:host=$DB_servername;dbname=$DB_name", $DB_username, $DB_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if($link == false){
    die("Error: no connection");
}

$prepStm = $link->prepare("Select ID, MAX(ID) from pictures;");
$prepStm->execute();
$latestID = $prepStm->fetchColumn(0);
$prepStm = $link->prepare("Select * from pictures where ID > :ID");

$ID_value = $latestID-20;
$prepStm->bindParam(':ID', $ID_value);
$prepStm->execute();
$prepStm->setFetchMode(PDO::FETCH_NUM);
$table = $prepStm->fetchAll();
list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,,$r,$s,$t) = $table;
list($a_0,$time_0,$header_0,$link_0,$desc_0) = $a;
list($a_1,$time_1,$header_1,$link_1,$desc_1) = $b;
list($a_2,$time_2,$header_2,$link_2,$desc_2) = $c;
list($a_3,$time_3,$header_3,$link_3,$desc_3) = $d;
list($a_4,$time_4,$header_4,$link_4,$desc_4) = $e;
list($a_5,$time_5,$header_5,$link_5,$desc_5) = $f;
list($a_6,$time_6,$header_6,$link_6,$desc_6) = $g;
list($a_7,$time_7,$header_7,$link_7,$desc_7) = $h;
list($a_8,$time_8,$header_8,$link_8,$desc_8) = $i;
list($a_9,$time_9,$header_9,$link_9,$desc_9) = $j;
list($a_10,$time_10,$header_10,$link_10,$desc_10) = $k;
list($a_11,$time_11,$header_11,$link_11,$desc_11) = $l;
list($a_12,$time_12,$header_12,$link_12,$desc_12) = $m;
list($a_13,$time_13,$header_13,$link_13,$desc_13) = $n;
list($a_14,$time_14,$header_14,$link_14,$desc_14) = $o;
list($a_15,$time_15,$header_15,$link_15,$desc_15) = $p;
list($a_16,$time_16,$header_16,$link_16,$desc_16) = $q;
list($a_17,$time_17,$header_17,$link_17,$desc_17) = $r;
list($a_18,$time_18,$header_18,$link_18,$desc_18) = $s;
list($a_19,$time_19,$header_19,$link_19,$desc_19) = $t;



?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="galleryStyle.css">

</head>
<body>

    <div class="row">

        <div class="frame">
        <div id="left" class="col-4">

            <div class="frm">
                <div class="header">
                    <?php echo $header_0 ?>
                </div>
                <img src="<?php echo $link_0 ?>">
                <div class="desc">
                    <?php echo $desc_0 ?>
                </div>
                <div class="time">
                    <?php echo $time_0 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_2 ?>
                </div>
                <img src="<?php echo $link_2 ?>">
                <div class="desc">
                    <?php echo $desc_2 ?>
                </div>
                <div class="time">
                    <?php echo $time_2 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_4 ?>
                </div>
                <img src="<?php echo $link_4 ?>">
                <div class="desc">
                    <?php echo $desc_4 ?>
                </div>
                <div class="time">
                    <?php echo $time_4 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_6 ?>
                </div>
                <img src="<?php echo $link_6 ?>">
                <div class="desc">
                    <?php echo $desc_6 ?>
                </div>
                <div class="time">
                    <?php echo $time_6 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_8 ?>
                </div>
                <img src="<?php echo $link_8 ?>">
                <div class="desc">
                    <?php echo $desc_8 ?>
                </div>
                <div class="time">
                    <?php echo $time_8 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_10 ?>
                </div>
                <img src="<?php echo $link_10 ?>">
                <div class="desc">
                    <?php echo $desc_10 ?>
                </div>
                <div class="time">
                    <?php echo $time_10 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_12 ?>
                </div>
                <img src="<?php echo $link_12 ?>">
                <div class="desc">
                    <?php echo $desc_12 ?>
                </div>
                <div class="time">
                    <?php echo $time_12 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_14 ?>
                </div>
                <img src="<?php echo $link_14 ?>">
                <div class="desc">
                    <?php echo $desc_14 ?>
                </div>
                <div class="time">
                    <?php echo $time_14 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_16 ?>
                </div>
                <img src="<?php echo $link_16 ?>">
                <div class="desc">
                    <?php echo $desc_16 ?>
                </div>
                <div class="time">
                    <?php echo $time_16 ?>
                </div>
            </div>
            <div class="frm">
                <div class="header">
                    <?php echo $header_18 ?>
                </div>
                <img src="<?php echo $link_18 ?>">
                <div class="desc">
                    <?php echo $desc_18 ?>
                </div>
                <div class="time">
                    <?php echo $time_18 ?>
                </div>
            </div>
        </div>
            <div id="right" class="col-4">
                <div class="frm">
                    <div class="header">
                        <?php echo $header_1 ?>
                    </div>
                    <img src="<?php echo $link_1 ?>">
                    <div class="desc">
                        <?php echo $desc_1 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_1 ?>
                    </div>
                </div><div class="frm">
                    <div class="header">
                        <?php echo $header_3 ?>
                    </div>
                    <img src="<?php echo $link_3 ?>">
                    <div class="desc">
                        <?php echo $desc_3 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_3 ?>
                    </div>
                </div><div class="frm">
                    <div class="header">
                        <?php echo $header_5 ?>
                    </div>
                    <img src="<?php echo $link_5 ?>">
                    <div class="desc">
                        <?php echo $desc_5 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_5 ?>
                    </div>
                </div><div class="frm">
                    <div class="header">
                        <?php echo $header_7 ?>
                    </div>
                    <img src="<?php echo $link_7 ?>">
                    <div class="desc">
                        <?php echo $desc_7 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_7 ?>
                    </div>
                </div><div class="frm">
                    <div class="header">
                        <?php echo $header_9 ?>
                    </div>
                    <img src="<?php echo $link_9 ?>">
                    <div class="desc">
                        <?php echo $desc_9 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_9 ?>
                    </div>
                </div><div class="frm">
                    <div class="header">
                        <?php echo $header_11 ?>
                    </div>
                    <img src="<?php echo $link_11 ?>">
                    <div class="desc">
                        <?php echo $desc_11 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_11 ?>
                    </div>
                </div><div class="frm">
                    <div class="header">
                        <?php echo $header_13 ?>
                    </div>
                    <img src="<?php echo $link_13 ?>">
                    <div class="desc">
                        <?php echo $desc_13 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_13 ?>
                    </div>
                </div><div class="frm">
                    <div class="header">
                        <?php echo $header_15 ?>
                    </div>
                    <img src="<?php echo $link_15 ?>">
                    <div class="desc">
                        <?php echo $desc_15 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_15 ?>
                    </div>
                </div><div class="frm">
                    <div class="header">
                        <?php echo $header_17 ?>
                    </div>
                    <img src="<?php echo $link_17 ?>">
                    <div class="desc">
                        <?php echo $desc_17 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_17 ?>
                    </div>
                </div>
                <div class="frm">
                    <div class="header">
                        <?php echo $header_19 ?>
                    </div>
                    <img src="<?php echo $link_19 ?>">
                    <div class="desc">
                        <?php echo $desc_19 ?>
                    </div>
                    <div class="time">
                        <?php echo $time_19 ?>
                    </div>
                </div>


            </div>
        </div>


</body>
</html>
