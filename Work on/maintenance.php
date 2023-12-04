<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- include head for page -->
  <?php include 'includes/head.php';?>

  <style>
    .container {
      margin-top: 30px;
    }
    .alert {
      display: none;
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

  // remove user php
  if (isset($_POST['submitRemoveUser'])) {
      $userID = $_POST['removeUserID'];

      // checks if the user is not a protected user before trying to delete
      $protectedUsers = ['managerUser1', 'staffUser1', 'maintenanceUser1'];
      $stmt = $mysql->prepare("SELECT username FROM UserAccount WHERE user_id = :userID");
      $stmt->execute([':userID' => $userID]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user && !in_array($user['username'], $protectedUsers)) {
          $deleteStmt = $mysql->prepare("DELETE FROM UserAccount WHERE user_id = :userID");
          $deleteStmt->execute([':userID' => $userID]);

          if ($deleteStmt->rowCount() > 0) {
              $message = "User removed successfully.";
              $messageClass = "alert-success";
          } else {
              $message = "Error: Could not remove user.";
              $messageClass = "alert-danger";
          }
      } else {
          $message = "Error: Cannot remove protected user.";
          $messageClass = "alert-danger";
      }
  }

  $usersStmt = $mysql->query("SELECT username, usertype FROM UserAccount");
  $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <div class="container mt-5">
      <div class="row">
          <!-- create new user <3 -->
          <div class="col-md-6">
              <h2>Create New User</h2>
              <?php if ($message !== ""): ?>
                  <div class="alert <?php echo $messageClass; ?>">
                      <?php echo $message; ?>
                  </div>
              <?php endif; ?>
              <form action="maintenance.php" method="post">
                  <div class="mb-3">
                      <label for="newUsername" class="form-label">Username</label>
                      <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                  </div>
                  <div class="mb-3">
                      <label for="newPassword" class="form-label">Password</label>
                      <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                  </div>
                  <div class="mb-3">
                      <label for="newUserType" class="form-label">User Type</label>
                      <select class="form-select" id="newUserType" name="newUserType">
                          <option value="Staff View">Staff</option>
                          <option value="Manager View">Manager</option>
                          <option value="Maintenance View">Maintenance</option>
                      </select>
                  </div>
                  <button type="submit" name="submitNewUser" class="btn btn-primary">Create User</button>
              </form>
          </div>

          <!-- remove user <3 -->
          <div class="col-md-6">
              <h2>Remove User</h2>
              <form action="maintenance.php" method="post">
                <div class="mb-3">
                  <label for="removeUserID" class="form-label">Select User to Remove</label>
                  <select class="form-select" id="removeUserID" name="removeUserID">
                    <?php
                    // select all users from userAccount table, EXCEPT the ones i considered protected (listed by username and role on the page)
                    $stmt = $mysql->query("SELECT user_id, username, usertype FROM UserAccount WHERE username NOT IN ('managerUser1', 'staffUser1', 'maintenanceUser1')");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=\"" . $row['user_id'] . "\">" . $row['username'] . " (" . $row['usertype'] . ")</option>";
                    }
                    ?>
                  </select>
                </div>
                <button type="submit" name="submitRemoveUser" class="btn btn-danger">Remove User</button>
              </form>

          </div>
      </div>
  </div>

  <script>
  // fancy js to hide the alert box after a few seconds :)
  window.onload = function() {
    const alertBox = document.querySelector('.alert');
    if (alertBox) {
      alertBox.style.display = 'block';
      setTimeout(() => {
        alertBox.style.display = 'none';
      }, 3000);
    }
  };
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
