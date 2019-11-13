<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<meta charset="utf-8">
	<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>

</head>
<?php
	$host = 'localhost';
	$db = 'my_activities';
	$user = 'root';
	$pass = 'root';
	$charset = 'utf8mb4';

	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

	$options = [
		PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES		=> false,
	];

	try {
		$pdo = new PDO($dsn, $user, $pass, $options);
	} catch (PDOException $e) {
		throw new PDOException($e->getMessage(), (int)$e->getCode());
	}

	$users = array();
	$id = array();
	$email = array();
	$status = array();

	$stmt = $pdo->query('SELECT * FROM users ORDER BY username');

	while ($row = $stmt->fetch()) {
		array_push($users, $row['username']);
		array_push($id, $row['id']);
		array_push($email, $row['email']);
	}

	$stmt = $pdo->query('SELECT name FROM status JOIN users ON status_id = status.id ORDER BY username');

	while ($row = $stmt->fetch()) {
		array_push($status, $row['name']);
	}

	// $user_id = array();
	// Correction : $stmt = $pdo->query('select users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id');
?>

<body>
	<table>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Email</th>
			<th>Status</th>

	<?php
		for ($i=0; $i < count($users); $i++) { 
			echo '<tr>';
			echo '<td>'.$id[$i].'</td> <td>'.$users[$i].'</td> <td>'.$email[$i].'</td> <td>'.$status[$i].'</td>';
			echo '</tr>';
		}

		/* Correction
		* <?php while ($row = $stmt->fetch()) { ?>
		*	<tr>
		*		<td><?php echo $row['user_id']?></td>
		*		<td><?php echo $row['username']?></td>
		*		<td><?php echo $row['email']?></td>
		*		<td><?php echo $row['status']?></td>
		*	</tr>
		* <?php } ?>
		*/
		
		echo "</tr>";
		echo '</table>';
	?>

</body>
</html>