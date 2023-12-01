<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!-- include head for page -->
  <?php include 'includes/head.php'; ?>


  <!-- style included in here as to not complicate the master css file because this stuff is only used in here :)) -->
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

<body>
  <?php
  include 'includes/navbar.php';
  include 'includes/db.php';
  $errorMessage = "";

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysql->prepare("SELECT role FROM users WHERE username = :username AND password = :password"); // can and will likely change depending on how msc change the table <3
    $stmt->execute([':username' => $username, ':password' => $password]);
    $user = $stmt->fetch();
    // no hashing because well I feel it's not exactly necessary here and is additional complexity for the sake of addtional complexity...
    // if it were to be implemented I'd use: password_hash(...)

    if ($user) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $user['role'];

      switch ($user['role']) {
        case 'Manager':
          header('Location: manager.php');
          break;
        case 'Staff':
          header('Location: staff.php');
          break;
        case 'Maintenance':
          header('Location: maintenance.php');
          break;
      }
      exit;
    } else {
      $errorMessage = "Invalid username or password, please try again.";
    }
  }
  ?>

  <!-- the error message stuff needs to be confirmed after the tables are made, so yeah -->
  <div class="centered-form-container">
    <?php if ($errorMessage): ?>
    <div class="error-message"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form action="login.php" method="post" class="login-form">
      Username: <input type="text" name="username" class="form-control"><br>
      Password: <input type="password" name="password" class="form-control"><br>
      <input type="submit" name="submit" value="Login" class="btn btn-success">
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
