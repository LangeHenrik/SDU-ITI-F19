<?php
$search = $viewbag['search'];
$allAssets = $viewbag['allAssets'];

if ($search !== "") {
    ?><b>Results: </b> <?php
    $search = strtolower($search);
    $len = strlen($search);
    foreach ($allAssets as $tmp) {
        if (stristr($search, substr($tmp["headline"], 0, $len)) || stristr($search, substr($tmp["text"], 0, $len))) {
            ?>
            <figure id="<?php echo $tmp["fileID"]; ?>">
                <b>
                    <figcaption><?php echo $tmp["headline"]; ?></figcaption>
                </b>
                <img src=<?php echo "../../../upload/" . $tmp["fileID"]; ?>>
                <?php echo $tmp["text"]; ?> <br>
                <?php if ($tmp["username"] == $_SESSION["username"]) {
                    ?>
                    <form action="/jenav16/mvc/public/home/delete" enctype="multipart/form-data" id="fileForm" method="post">
                        <input type="hidden" name=fileID value='<?php echo $tmp["fileID"]; ?>'/>
                        <br><input id="deleteAssetButton" name="deleteAsset" type="submit"
                                   value="Delete <?php echo $tmp["headline"]; ?>">
                    </form>
                <?php } else { ?>
                    <i>This image was uploaded by: <?php echo $tmp["username"] ?></i>
                <?php } ?>
            </figure>
            <?php
        }
    }
} else {
    ?><b>All Assets: </b> <?php

    if ($allAssets != null) {
        foreach ($allAssets as $asset) {
            ?>
            <figure id="<?php echo $asset["fileID"]; ?>">
                <b>
                    <figcaption><?php echo $asset["headline"]; ?></figcaption>
                </b>
                <img src=<?php echo "../../../upload/" . $asset["fileID"]; ?>>
                <?php echo $asset["text"]; ?> <br>
                <?php if ($asset["username"] == $_SESSION["username"]) { ?>
                    <form action="/jenav16/mvc/public/home/delete" enctype="multipart/form-data" id="fileForm" method="post">
                        <input type="hidden" name=fileID value='<?php echo $asset["fileID"]; ?>'/>
                        <br><input id="deleteAssetButton" name="deleteAsset" type="submit"
                                   value="Delete <?php echo $asset["headline"]; ?>"><br>
                    </form>
                <?php } else { ?>
                    <i>This image was uploaded by: <?php echo $asset["username"] ?></i>
                <?php } ?>
            </figure>
            <?php
        }
    }
}
?>