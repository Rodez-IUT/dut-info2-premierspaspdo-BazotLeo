<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<meta charset="utf-8">
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

	$stmt = $pdo->query('SELECT username FROM users');

	$i = 0;
	while ($row = $stmt->fetch()) {
		array_push($users, $row['username']);
		$i++;
	}

	sort($user);

	echo '<p>';
	foreach ($users as $people) {
		echo $user.'<br/>';
	}
	echo '</p>';

?>
<body>

</body>
</html>