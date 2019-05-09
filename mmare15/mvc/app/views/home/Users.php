<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>List of Registered Accounts</title>
    <link href="/mmare15/mvc/public/css/mystylesheet.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('a#button').click(function () {
                $.ajax({
                    url: '/mmare15/mvc/public/Users/get_users',
                    success: function (response) {
                        $('#container').html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
<h1>List of Accounts</h1>
<nav id="nav">
    <a href="/mmare15/mvc/public/home/">INDEX</a>
    <a href="/mmare15/mvc/public/users/">USERS</a>
    <a href="/mmare15/mvc/public/upload/">UPLOAD</a>
    <a href="/mmare15/mvc/public/home/log_out">LOGOUT</a>
</nav>
<br><br><br><br>
<button><a id="button">Fetch Users</a></button>

<p id="container"><!-- currently it's empty --></p>


</body>
</html>