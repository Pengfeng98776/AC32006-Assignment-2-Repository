<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!-- include head for page -->
  <?php include 'includes/head.php';?>
<body>
  <?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  include 'includes/db.php';
  include 'includes/navbar.php';

  $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
  $products = [];
  if ($searchTerm) {
      $stmt = $mysql->prepare("SELECT * FROM Product WHERE Name LIKE :searchTerm OR Description LIKE :searchTerm");
      $searchTerm = '%' . $searchTerm . '%';
      $stmt->bindParam(':searchTerm', $searchTerm);
      $stmt->execute();
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
      $stmt = $mysql->query("SELECT * FROM Product");
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  if (!isset($_SESSION["cartArray"])) {
    $_SESSION["cartArray"] = array();
  }

  // Fetch all products from the database
  $stmt = $mysql->query("SELECT * FROM Product");
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

  function addToCart($ID) {
    if (!in_array($ID, $_SESSION["cartArray"])) {
      array_push($_SESSION["cartArray"], $ID);
    }
  }

  function clearCart() {
    $_SESSION["cartArray"] = array();
  }
  ?>

  <section class="container mt-5">
    <h2 class="text-center mb-4"><?php echo $searchTerm ? 'Search Results' : 'All Products'; ?></h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-between">
      <?php foreach ($products as $result): ?>
        <div class="col mb-2">
          <div class="card h-100">
            <!-- because we haven't sorted the images being stored in the db so just using the placeholder :) -->
            <img class="card-img-top" src="images/product placeholders/bike-image-1.jpg" alt="A placeholder image">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h5 class="card-title"><?php echo htmlspecialchars($result['Name']); ?></h5> <!-- htmlspecialchars to protect against cross site scripting smile -->
                </div>
                <div class="col-4">
                  <h5 class="card-title">£<?php echo htmlspecialchars($result['PurchaseCost']); ?></h5>
                </div>
              </div>
              <p class="card-text crop-text-2"><?php echo htmlspecialchars($result['Description']); ?></p>
              <form method="post">
                <!-- Adds a hidden input field to store the product ID -->
                <input type="hidden" name="idHidden" value="<?php echo $result['ProductID']; ?>">
                <input type="submit" name="addToCart" class="btn btn-outline-success col-12" value="Add To Cart">
                <?php 
                if(isset($_POST['addToCart'])) {
                  addToCart($_POST['idHidden']);
                }

                if(isset($_POST['clearCart'])) {
                  clearCart();
                }
                ?>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="col d-none d-xl-block border mt-4 align-content-end"> <!-- Additional column for shopping cart -->

        <div class="row text-center mt-2">
          <div class="col">
            <h3><i class="fa-solid fa-cart-shopping"></i> Shopping cart</h3>
            <h4 id="Subtotal">Subtotal: £4.99</h4>
            <div class="row">
              <div class="col">
                <a href="#" class="btn btn-outline-success col-12" >Check-out</a>
              </div>
            </div>
            <hr class="hr hr-blurry mt-2"/>
          </div>
        </div>

        <div class="d-flex justify-content-between">
          <p>Name</p>
          <p class>Quantity</p>
          <p class>Price</p>
          <p></p> <!-- Purely for spacing -->
        </div>

        <?php
            // Generate
            // while ($cartArray != NULL) {
            foreach ($_SESSION["cartArray"] as $itemID) { 
              $stmt = $mysql->prepare("SELECT * FROM Product WHERE ProductID = ?");
              $stmt->execute([$itemID]);
              $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);
              ?>
        <div id="cart contents"> <!-- Generated rows for contents would go here -->
            <div class="d-flex justify-content-between" id="cartBox">
              <p><?php echo htmlspecialchars($productDetails['Name']); ?></p>
              <p><?php echo '1'; ?></p>
              <p>£<?php echo htmlspecialchars($productDetails['PurchaseCost']); ?></p>
              
            </div>
            <?php 
            } ?>
        </div>      

        <form method="post">
          <input type="submit" name="clearCart" value="Clear Cart">
          <?php 
          ?>
        </form>
      </div>
    </div>
  </section>

  
  <script src="https://kit.fontawesome.com/b121f70603.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
