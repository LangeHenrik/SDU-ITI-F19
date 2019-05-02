<?php include '../app/views/partials/start.php'; ?>
<body>
    <div class="base">
        <h1>Dét Sgu Da De BLÆREDE BRUGERE</h1>
        <h2>Stedet hvor du kan se alles data</h2>
        <?php include '../app/views/partials/logoutButton.php';?>
        <?php include '../app/views/partials/imagesButton.php';?>
        <?php include '../app/views/partials/userImagesButton.php';?>


        <div class="table-container">
        <table id="user-table">
            <tr id="user-table-header">
                <th>ID</th>
                <th>Username</th>
                <th>Fornavn</th>
                <th>Efternavn</th>
                <th>Postnummer</th>
                <th>Bynavn</th>
                <th>email</th>
                <th>Telefonnummer</th>
            </tr>
            <?php 
                foreach($viewbag["allusers"] as $row){
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['firstname']."</td>";
                    echo "<td>".$row['lastname']."</td>";
                    echo "<td>".$row['zip']."</td>";
                    echo "<td>".$row['city']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['phone']."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
      </div>



<?php include '../app/views/partials/end.php'; ?>