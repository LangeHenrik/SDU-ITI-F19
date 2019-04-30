<?php

class UsersController extends Controller {

	public function index () {
		$_SESSION['page_name'] = "Users";

		// $viewbag['pictures'] = $this->model('Picture') -> getAllPictures();
		$viewbag['users'] = $this->model('User') -> getAllUsersInfo();
		$viewbag['user'] = $this->model('User') -> getUserInfo();

		$this->view('users/index', $viewbag);
	}

	public function getUsers($input) {
		$request = $input . '%';

        $resultGetUsers = $this->model('User') -> getUsersByRequest($request);

        if (!empty($resultGetUsers)) {
            echo "<table>
            <tr>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            </tr>";

            foreach ($resultGetUsers as $value) {
                echo '<tr>';
                echo '<td>' . $value['username'] . '</td>';
                echo '<td>' . $value['firstname'] . '</td>';
                echo '<td>' . $value['lastname'] . '</td>';
                echo '</tr>';
            }

            echo "</table>";
        } else {
            echo "No users found!";
        }
	}

}
