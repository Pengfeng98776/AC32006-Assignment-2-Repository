<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- include head for page -->
  <?php include 'includes/head.php';?>

  <style>
    .alert {
      padding: 10px;
      margin-bottom: 15px;
    }
  </style>

</head>
<body>
  <?php
  include 'includes/navbar.php';
  include 'includes/db.php';

  session_start();

  $message = "";
  $messageClass = "";

  if (isset($_POST['submit'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $usertype = $_POST['usertype'];

      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $mysql->prepare("INSERT INTO UserAccount (username, password_hash, usertype) VALUES (:username, :password_hash, :usertype)");
      $stmt->execute([
          ':username' => $username,
          ':password_hash' => $hashedPassword,
          ':usertype' => $usertype
      ]);

      if ($stmt->rowCount() > 0) {
          $message = "New user created successfully.";
          $messageClass = "alert-success";
      } else {
          $message = "Error: Could not create user.";
          $messageClass = "alert-danger";
      }
  }
  ?>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <!-- if we add another section to this view add it in this div <3 -->
      </div>
      <div class="col-md-6">
        <h2>Create New User</h2>
        <?php if ($message !== ""): ?>
            <p class="alert <?php echo $messageClass; ?>"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="maintenance.php" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="usertype" class="form-label">User Type</label>
            <select class="form-select" id="usertype" name="usertype">
              <option value="Staff View">Staff</option>
              <option value="Manager View">Manager</option>
              <option value="Maintenance View">Maintenance</option>
            </select>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Create User</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
