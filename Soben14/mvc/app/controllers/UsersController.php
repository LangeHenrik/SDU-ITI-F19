<?php

class UsersController extends Controller {

	public function index () {
		$viewbag = $this->model('User')->getUsers();
		$this->view('getusers/index', $viewbag);
	}
	public function getUserAjax($input) {
		$request = $input."%";
		$result = $this->model('User')->getUserNamesAjax($request);
		echo '<table class = "usersTable">
		<tr>
		<th>User id</th>
		<th>Username</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>City</th>
		<th>Zip</th>
		<th>Email</th>
		</tr>';
		foreach ($result as $value) {
		    echo "<tr>";
		    echo "<td>" . $value['user_id'] . "</td>";
		    echo "<td>" . $value['user_name'] . "</td>";
		    echo "<td>" . $value['first_name'] . "</td>";
		    echo "<td>" . $value['last_name'] . "</td>";
		    echo "<td>" . $value['city'] . "</td>";
		    echo "<td>" . $value['zip_code'] . "</td>";
		    echo "<td>" . $value['email_adress'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
