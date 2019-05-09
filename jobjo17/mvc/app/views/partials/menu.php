<style>
/* Add a black background color to the top navigation */
.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
.scrollbox {
width: 80%;
height: 75%;
border-style: solid;
overflow: auto;
position: absolute;
top: 50%;
left: 50%;
transform: translateX(-50%) translateY(-50%);
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}	
td, th {
  border: 1px solid #dddddd;
  padding: 8px;
  vertical-align: middle;
  text-align: center;
}
img {
	  max-height: 250px;
}
</style>
<body>
 <div class="topnav">
  <a href="/jobjo17/mvc/public/home/login">Login</a>
  <a href="/jobjo17/mvc/public/home/register">Register</a>
  <a href="/jobjo17/mvc/public/image/">Pictures</a>
  <a href="/jobjo17/mvc/public/image/uploadpicture">Upload Picture</a>
  <a href="/jobjo17/mvc/public/users/">Users</a>
  <a href="/jobjo17/mvc/public/home/logout">Logout</a>
  
</div> 
</body>