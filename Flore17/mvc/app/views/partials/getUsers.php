<?php
		
			
	foreach($viewbag['users'] as $users) :

?>

		<html>
			<div class="userbox">
				<h1 class="name"><?=html_entity_decode($users['firstname'], ENT_QUOTES, 'UTF-8')?> <?=html_entity_decode($users['lastname'], ENT_QUOTES, 'UTF-8')?></h1>
				<div class="profilepicbox">
					<img class="profilepic" src="data:<?=$users['exttype']?>; base64, <?=base64_encode($users['imagetmp']) ?>"/>
				</div>
				<div class="profileInfo">
					<table style="width: 100%; height:75%;">
						<tr>
						<td class="tdUser"><b>Username</b></td>
						<td class="tdUser"><?=html_entity_decode($users['username'], ENT_QUOTES, 'UTF-8')?></td>
						<td class="tdUser"><b>City</b></td>
						<td class="tdUser"><?=html_entity_decode($users['city'], ENT_QUOTES, 'UTF-8')?></td>
						</tr>
						<tr>
						<td class="tdUser"><b>Phone</b></td>
						<td class="tdUser"><?=$users['phone']?></td>
						<td class="tdUser"><b>Zip</b></td>
						<td class="tdUser"><?=$users['zip']?></td>
						</tr>
						<tr>
						<td class="tdUser"><b>Email</b></th>
						<td class="tdUser" class="threecol" colspan="3"><?=html_entity_decode($users['email'], ENT_QUOTES, 'UTF-8')?></th>
						</tr>
					</table>
				</div>
			</div>
		</html>

<?php
	endforeach;
?>