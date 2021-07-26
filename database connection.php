<?php
	$server = "localhost";
	$username = "learn_php";
	$password = "User#789";
	$db = "learn_php";
	$conn = mysqli_connect($server, $username, $password, $db);	
?>

<html>
	<head>
		<title></title>
		<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class = "container">
			<div class = "jumbotron">
				<h2>Simple Crud (PHP With MYSQL)</h2>
			</div>
			
			<?php
				if(isset($_GET["edit_id"])){
					$sql = "SELECT * FROM users WHERE u_id = '$_GET[edit_id]' ";
					$run = mysqli_query($conn, $sql);
					while($rows = mysqli_fetch_assoc($run)){
						$name = $rows["name"];
						$email = $rows["email"];
						$password = $rows["password"];
						$contact_no = $rows["contact_no"];
					}
			?>		
			
			<h2 class = "col-md-12">Edit User</h2>
			<form class = "col-md-12" method = "post">
				<div class = "form-group">
					<label>Username</label>
					<input type = "text" name = "edit_name" value = "<?php echo $name; ?>" class = "form-control" required>
				</div>
				<div class = "form-group">
					<label>E-Mail</label>
					<input type = "email" name = "edit_email" value = "<?php echo $email; ?>" class = "form-control" required>
				</div>
				<div class = "form-group">
					<label>Password</label>
					<input type = "password" name = "edit_password" value = "<?php echo $password; ?>" class = "form-control" required>
				</div>
				<div class = "form-group">
					<label>Contact-No</label>
					<input type = "text" name = "edit_contact_no" value = "<?php echo $contact_no; ?>" class = "form-control" required>
				</div>
				<div class = "form-group">
					<input type = "hidden" name = "edit_user_id" value = "<?php echo $_GET['edit_id']; ?>">
					<input type = "submit" name = "edit_user_btn" value = "Done Editing" class = "btn btn-primary form-control">
				</div>
			</form>
			
			<?php
				}else{
			?>
			
			<h2 class = "col-md-12">Insert New User</h2>
			<form class = "col-md-12" method = "post">
				<div class = "form-group">
					<label>Username</label>
					<input type = "text" name = "username" class = "form-control" required>
				</div>
				<div class = "form-group">
					<label>E-Mail</label>
					<input type = "email" name = "email" class = "form-control" required>
				</div>
				<div class = "form-group">
					<label>Password</label>
					<input type = "password" name = "password" class = "form-control" required>
				</div>
				<div class = "form-group">
					<label>Contact-No</label>
					<input type = "text" name = "contact_no" class = "form-control" required>
				</div>
				<div class = "form-group">
					<input type = "submit" name = "submit_user" class = "btn btn-danger form-control">
				</div>
			</form>
			
			<?php
				}
				$sql = "SELECT * FROM users";
				$run = mysqli_query($conn, $sql);
				
				echo "
					<table class = 'table table-hover table-striped table-border'>
						<thead>
							<tr>
								<th>S.NO</th>
								<th>NAME</th>
								<th>E-MAIL</th>
								<th>PASSWORD</th>
								<th>CONTACT_NO</th>
								<th>DATE</th>
								<th>EDIT</th>
								<th>DELETE</th>
							</tr>
						</thead>
						<tbody>
				";
				
				$c = 1;
				while($rows = mysqli_fetch_assoc($run)){
					echo "
						<tr>
							<td>$c</td>
							<td>$rows[name]</td>
							<td>$rows[email]</td>
							<td>$rows[password]</td>
							<td>$rows[contact_no]</td>
							<td>$rows[date]</td>
							<td><a href = 'database connection.php?edit_id=$rows[u_id]' class = 'btn btn-success btn-sm'>Edit</a></td>
							<td><a href = 'database connection.php?del_id=$rows[u_id]' class = 'btn btn-danger btn-sm'>Delete</a></td>
						</tr>
					";
					$c++;
				}
				
				echo "
						</tbody>
					</table>
				";
			?>
		</div>
	</body>
</html>

<?php
	// Insert A New User

	if(isset($_POST["submit_user"])){
		echo $username = mysqli_real_escape_string($conn,strip_tags($_POST["username"]));
		echo $email = mysqli_real_escape_string($conn,strip_tags($_POST["email"]));
		echo $password = mysqli_real_escape_string($conn,strip_tags($_POST["password"]));
		if(isset($_POST["contact_no"])){
			echo $contact_no = mysqli_real_escape_string($conn,strip_tags($_POST["contact_no"]));
		}
		
		$date = date("y-m-d");	
		$ins_sql = "INSERT INTO users(name, email, password, date, contact_no) VALUES('$username', '$email', '$password', '$date','$contact_no')";
		if(mysqli_query($conn, $ins_sql)){
?>
<script>window.location = "database connection.php";</script>

<?php			
		}
	}
	
	// Delete A New User
	if(isset($_GET["del_id"])){
		$del_sql = "DELETE FROM users WHERE u_id = '$_GET[del_id]' ";
		if(mysqli_query($conn, $del_sql)){
?>
<script>window.location = "database connection.php";</script>

<?php			
		}		
	}
	
	// Edit A User
	
	if(isset($_POST['edit_user_btn'])){
		$edit_name = mysqli_real_escape_string($conn,strip_tags($_POST["edit_name"]));
		$edit_email = mysqli_real_escape_string($conn,strip_tags($_POST["edit_email"]));
		$edit_password = mysqli_real_escape_string($conn,strip_tags($_POST["edit_password"]));
		$edit_contact_no = mysqli_real_escape_string($conn,strip_tags($_POST["edit_contact_no"]));
		$edit_id = $_POST["edit_user_id"];
		$edit_sql = "UPDATE users SET name = '$edit_name', email = '$edit_email', password = '$edit_password', contact_no = '$edit_contact_no' WHERE u_id = '$edit_id' ";
		if(mysqli_query($conn, $edit_sql)){
?>

<script>window.location = "database connection.php";</script>

<?php			
		}
	}
?>