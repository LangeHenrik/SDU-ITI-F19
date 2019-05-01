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
         foreach ($viewbag['userList'] as $user) {
	    	?>
				   <tr>
					   <td> <?=$user['firstname']?> <?=$row['lastname']?> </td>
					   <td> <?=$user['email']?></td>
					   <td> <?=$user['phonenumber']?> </td>
					   <td> <?=$user['city']?> </td>
					   <td> <?=$user['zipcode']?> </td>
				   </tr>
			   </table>
		   </div>
		   <?php

	
	}
