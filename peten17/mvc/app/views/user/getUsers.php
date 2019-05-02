<?php include '../app/views/partials/header.php';?>


<div class="content">
      <table>
        <tr>
           <th>Name</th>
           <th>Email</th>
           <th>Phonenumber</th>
           <th>City</th>
           <th>Zipcode</th>
         </tr>
      <?php
       

        foreach($viewbag as $user){
            ?>

            <tr>
                <td> <?=$user['firstname']?> <?=$user['lastname']?></td>
                <td> <?=$user['email'] ?></td>
                <td> <?=$user['phonenumber'] ?></td>
                <td> <?=$user['city'] ?></td>
                <td> <?=$user['zipcode'] ?></td>
            </tr>
<?php
         }
?>
         </table>

         
         </body>
         </html>