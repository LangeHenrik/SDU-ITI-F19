<?php

class UsersController extends Controller {

	// private $db;
	//
	// public function __construct() {
	// 	header('Content-Type: application/json');
	// 	$this->db = new Database();
	// }

	public function index () {
		$viewbag = $this->model('User')->getUsers();
		$this->view('getusers/index', $viewbag);
	}

	public function getUserAjax($input) {
	  $request = $input."%";

		$result = $this->model('User')->getUserNamesAjax($request);

		echo '<table class = "usersTable">
		<tr>
		<th>Username</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>City</th>
		<th>Zip</th>
		<th>Email</th>
		</tr>';
		foreach ($result as $value) {
		    echo "<tr>";
		    echo "<td>" . $value['user_name'] . "</td>";
		    echo "<td>" . $value['front_name'] . "</td>";
		    echo "<td>" . $value['last_name'] . "</td>";
		    echo "<td>" . $value['city'] . "</td>";
		    echo "<td>" . $value['zip_code'] . "</td>";
		    echo "<td>" . $value['email_adress'] . "</td>";
		    echo "</tr>";
		}
		echo "</table>";

	}
}
