<!DOCTYPE html>
<html>
    <head>
        <title>PHP API test</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
        <div class="jumbotron">
            <h1 class="display-3">PHP API test</h1>
            <hr/>
            <p class="lead">Click <strong>"Test API's"</strong> to start</p>
        </div>

        <style>
            .pass {
                color: green;
            }
            .fail, .fail pre {
                color: red;
            }
        </style>


        <form method="POST">
        
            <input type="hidden" name="port" id="port" value="8081" />
            <input type="hidden" name="username" id="username" value="hl" />
            <input type="hidden" name="password" id="password" value="Hl123456" />
            <button type="submit" class="btn btn-primary"><i class="fas fa-question"></i> Test API's</button>
        
        </form>

        <?php
            error_reporting(E_ERROR | E_PARSE);
            if(isset($_POST['port'])) :
                
                $dirs = array_filter(glob('*'), 'is_dir');
                
                ?>
                <table style="border: 1px solid black">
                <tr>
                    <th>Endpoint</th>
                    <th>Get Users</th>
                    <th>Has User-name</th>
                    <th>Get Picture</th>
                    <th>Has Right Picture</th>
                    <th>Not have wrong picture</th>
                </tr>
                
                <?php
                foreach ($dirs as $dir) :
                    ?><tr><?php
                    $userId = -1;
                    //TESTING GET USERS API
                    $url = 'http://localhost:' . $_POST['port'] 
                            . '/' . $dir
                            . '/mvc/public/api/users' 
                            //. '/index.php'
                            ;

                    echo '<td><a href="'.$url.'">' . $url . '</a></td>';
                    
                    $usersJson = file_get_contents($url);
                    $users = json_decode($usersJson);

                    if(isset($users[0]->username)) : ?>
                         
                            <td><p class="pass"><i class="fas fa-check"></i></p></td>
                        <?php
                            $foundName = false;
                            foreach ($users as $user) {
                                if($user->username == $_POST['username']) {
                                    $foundName = true;
                                    $userId = $user->user_id;
                                }
                            }
                            if($foundName) :?>
                            <td><p class="pass"><i class="fas fa-check"></i></p></td>
                        <?php else: ?>
                            <td><p class="fail"><i class="fas fa-times"></i></p></td>
                            <?php continue; ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <td><p class="fail"><i class="fas fa-times"></i></p></td>
                        <td><p class="fail"><i class="fas fa-times"></i></p></td>
                        <?php continue; ?>
                    <?php endif;
                    
                    //TODO: POST IMAGES GOES HERE
                    $rightImage = "data:image/jpeg;base64,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";
                    $rightTitle = "Mr. Bean";
                    $rightDescription = "Beanscription";
                    $rightImageId = -1;

                    $wrongImage = "data:image/jpeg;base64,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";

                    $url = 'http://localhost:' . $_POST['port'] 
                            . '/' . $dir
                            . '/mvc/public/api/pictures/user/' . $userId;

                    echo '</tr><tr style="background-color: lightyellow;"><td><p><a href="'.$url.'">' . $url . '</a></p></td>';

                    $postdata = http_build_query(
                        array(
                            'json' => '{"image": "'.$rightImage.'",'
                                . '"title": "'.$rightTitle.'",'
                                . '"description":"'.$rightDescription.'",'
                                . '"username":"'.$_POST['username'].'",'
                                . '"password":"'.$_POST['password'].'"}'
                        )
                    );
                    
                    $opts = array('http' =>
                        array(
                            'method'  => 'POST',
                            'header'  => 'Content-Type: application/x-www-form-urlencoded',
                            'content' => $postdata
                        )
                    );
                    
                    $context  = stream_context_create($opts);
                    $result = file_get_contents($url, false, $context);

                    //echo $result;
                    $picturePostResult = json_decode($result);

                    //echo $picturePostResult->image_id;


                    //TESTING GET USER IMAGES API
                    $picturesJson = file_get_contents($url);
                    $pictures = json_decode($picturesJson);

                    if(isset($pictures[0]->image)) : ?>
                        <td></td><td></td><td><p class="pass">
                            <i class="fas fa-check"></i><img src="<?=$pictures[0]->image?>" alt="<?=$pictures[0]->title?>" title="<?=$pictures[0]->description?>" width="50px"/>
                        </p></td>
                        <?php
                            $foundRightImage = false;
                            $imageArrayId = -1;
                            foreach($pictures as $key => $picture) {
                                if($picture->image == $rightImage
                                && $picture->title == $rightTitle
                                && $picture->description == $rightDescription
                                //&& $picture->image_id == $rightImageId 
                                ) {
                                    $foundRightImage = true;
                                    $imageArrayId = $key;
                                }
                            }
                            if($foundRightImage) : ?>
                                <td><p class="pass">
                                    <i class="fas fa-check"></i> 
                                    <img  src="<?=$pictures[$imageArrayId]->image?>" 
                                        alt="<?=$pictures[$imageArrayId]->title?>" 
                                        title="<?=$pictures[$imageArrayId]->description?>" 
                                        width="50px"/>
                                </p></td>
                            <?php else: ?>
                            <td><p class="fail">
                                    <i class="fas fa-times"></i><img src="<?=$pictures[0]->image?>" alt="<?=$pictures[0]->title?>" title="<?=$pictures[0]->description?>" width="50px"/>
                                </p></td>
                            <?php endif; ?>
                    <?php else : ?>
                        <td><p class="fail"><i class="fas fa-times"></i></p></td>
                    <?php endif;

                


                    //NEGATIVE TEST

                    $wrongImage = "data:image/jpeg;base64,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";
                    $wrongTitle = "Doctor Emmeret Brown";
                    $wrongDescription = "80Mph";

                    $postdata = http_build_query(
                        array(
                            'json' => '{"image": "'.$wrongImage.'",'
                                . '"title": "'.$wrongTitle.'",'
                                . '"description":"'.$wrongDescription.'",'
                                . '"username":"'.$_POST['username'].'",'
                                . '"password":"wrong"}'
                        )
                    );
                    
                    $opts = array('http' =>
                        array(
                            'method'  => 'POST',
                            'header'  => 'Content-Type: application/x-www-form-urlencoded',
                            'content' => $postdata
                        )
                    );
                    
                    $context  = stream_context_create($opts);
                    $result = file_get_contents($url, false, $context);

                    //echo $result;
                    //$picturePostResult = json_decode($result);

                    //echo $picturePostResult->image_id;


                    //TESTING GET USER IMAGES API
                    /*
                    $url = 'http://localhost:' . $_POST['port'] 
                            . '/' . $_POST['projectname']
                            . '/mvc/public/api/pictures/user/' . $userId;
                    */
                    //echo '<p>Testing endpoint: <a href="'.$url.'">' . $url . '</a></p>';
                    
                    $picturesJson = file_get_contents($url);
                    $pictures = json_decode($picturesJson);

                    echo $picturesJson;
                    print_r($picturesJson);

                    if(isset($pictures[0]->image)) :
                        
                        $foundWrongImage = false;
                        $imageArrayId = -1;
                        foreach($pictures as $key => $picture) {
                            if($picture->image == $wrongImage
                            && $picture->title == $wrongTitle
                            && $picture->description == $wrongDescription
                            //&& $picture->image_id == $rightImageId 
                            ) {
                                $foundWrongImage = true;
                                $imageArrayId = $key;
                            }
                        }
                        if($foundWrongImage) : ?>
                            <td><p class="fail">
                                <i class="fas fa-times"></i>
                                <img  src="<?=$pictures[$imageArrayId]->image?>" 
                                        alt="<?=$pictures[$imageArrayId]->title?>" 
                                    title="<?=$pictures[$imageArrayId]->description?>" 
                                    width="50px"/>
                            </p></td>
                        <?php 
                        else: ?>
                        <td><p class="pass"><i class="fas fa-check"></i></p></td>
                        <?php 
                        endif;
                    else : ?>
                        <td><p class="fail"><i class="fas fa-times"></i>xx</p></td>
                    <?php endif; ?>
                    </tr><?php
                endforeach;

                ?>
                </table>
                <?php
            endif; //if POST
            

        ?>

        </div>
    </body>
</html>