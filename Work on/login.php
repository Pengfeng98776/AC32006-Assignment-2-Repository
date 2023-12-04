<?php
include 'includes/db.php';
include 'includes/navbar.php';

/*
// temp script to insert initial user logins
function insertInitialUsers($mysql) {
    $users = [
        ['username' => 'managerUser1', 'password' => 'managerPass1', 'usertype' => 'Manager View'],
        ['username' => 'staffUser1', 'password' => 'staffPass1', 'usertype' => 'Staff View'],
        ['username' => 'maintenanceUser1', 'password' => 'maintenancePass1', 'usertype' => 'Maintenance View'],
    ];

    foreach ($users as $user) {
        $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
        $stmt = $mysql->prepare("INSERT INTO UserAccount (username, password_hash, usertype) VALUES (:username, :password_hash, :usertype)");
        $stmt->execute([
            ':username' => $user['username'],
            ':password_hash' => $hashedPassword,
            ':usertype' => $user['usertype']
        ]);
    }
}
*/

// insertInitialUsers($mysql);

$errorMessage = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysql->prepare("SELECT usertype, password_hash FROM UserAccount WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['usertype'];

        switch ($user['usertype']) {
            case 'Manager View':
                header('Location: manager.php');
                break;
            case 'Staff View':
                header('Location: staff.php');
                break;
            case 'Maintenance View':
                header('Location: maintenance.php');
                break;
        }
        exit;
    } else {
        $errorMessage = "Invalid username or password, please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php include 'includes/head.php'; ?>

  <style>
    .centered-form-container {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-form {
      width: 300px;
      padding: 20px;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>

</head>
<body>
  <div class="centered-form-container">
    <form action="login.php" method="post" class="login-form">
      <?php if ($errorMessage): ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
      <?php endif; ?>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" class="form-control"><br>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control"><br>
      </div>
      <input type="submit" name="submit" value="Login" class="btn btn-success">
    </form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
