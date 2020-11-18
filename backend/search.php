<?php
	session_start();
	include "../configs.php";

	$search = $_POST['search'];
	$sql = "SELECT * FROM user WHERE first_name LIKE '%$search%' OR name LIKE '%$search%' OR email LIKE '%$search%' ";
	$result = mysqli_query($conn, $sql);

	$html = '';
	if(mysqli_num_rows($result)>0){
		$stt = 0;
		while ($row = mysqli_fetch_assoc($result)) {
			$stt++;
			if($row['status'] == 0) { $status = 'Active'; }else{ $status = 'Deactive'; };
			if ($row['role'] == 0) { $role = 'Admin'; }else{ $role = 'User'; }
			$html .= "

			<tr>
			<td>".$stt."</td>
              <td>".$row['first_name']." ".$row['name']."</td><td>".$row['email']."</td><td>".$row['phone']."</td><td>".$row['gender']."</td><td>".substr($row['bio'], 0, 50)."..."."</td>
              <td>".$status."</td>
              <td>".$role."</td>
              </tr>";
		}
		echo $html;
	}else{
		echo 'Dữ liệu không được tìm thấy!';
	}
?>