<br />
<h2 class="header">Add Agent</h2>
<br />

<form action="/agent/add" method="post">
		<table>
		
		<tr>
		<td><label for="name">Name:</label></td>
		<td><input type="text" name="name" maxlength="255"></td>
		</tr>
		
		<tr>
		<td><label for="email">Email:</label></td>
		<td><input type="email" name="email" maxlength="50"></td>
		</tr>

        <tr>
		<td><label for="location">Location:</label></td>

		<td><select name="location" size="1">
		<option>Johor</option>
		<option>Kedah</option>
		<option>Kelantan</option>
		<option>Melaka</option>
		<option>Negeri Sembilan</option>
        <option>Pahang</option>
        <option>Penang</option>
        <option>Perak</option>
        <option>Perlis</option>
        <option>Sabah</option>
        <option>Sarawak</option>
        <option>Selangor</option>
        <option>Terengganu</option>
		</select></td>
		</tr>

		</table>
	
        <div class="buttonHolder"><button type="submit" value="submit" class="addbutton">Add</button></div>

</form>