<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
     integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
     crossorigin="anonymous">
     <link rel="stylesheet" href="/dpete17/mvc/app/views/main-style.css">
    <link rel="stylesheet" href="/dpete17/mvc/app/views/dashboard/dashboard-style.css">
    <title>Project A01</title>
</head>
<body>
    <div class="container">
        <header class="dashboard-header">
            <h1>Project A01</h1>
            <ul>
                <li><a href="../">Your Images</a></li>
                <li><a href="images">Uploaded Images</a></li>
                <li><a class="active" href="accounts">View All Accounts</a></li>
                <li><a href="logout">Logout</a></li>
            </ul>
        </header>
        <div class="dashboard-body">
            <table>
                <tr>
                    <th>#</th>
                    <th>ID</th> 
                    <th>Username</th>
                </tr>
                <?php
                    $i = 1;
                    foreach ($viewbag['users'] as $user) {
                        echo '<tr></td>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$user -> id.'</td>';
                        echo '<td>'.$user -> name.'</td>';
                        echo '</tr>';
                        $i++;
                    }
                ?>
            </table> 
        </div>
        <?php include('../app/views/partials/main-footer.php'); ?>
    </div>
</body>
</html>