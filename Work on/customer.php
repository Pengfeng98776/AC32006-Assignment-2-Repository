<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- include head for page -->
  <?php include 'includes/head.php';?>
</head>
<body>
  <?php
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

  $cartArray = array();

  function addToCart($ID, $cart) {
      if (!in_array($ID, $cart)) {
          array_push($cart, $ID);
      }
  }
  ?>

  <section class="container mt-5">
    <h2 class="text-center mb-4"><?php echo $searchTerm ? 'Search Results' : 'All Products'; ?></h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-between">
      <?php foreach ($products as $result): ?>
        <div class="col mb-2">
          <div class="card h-100">
            <img class="card-img-top" src="images/product placeholders/bike-image-1.jpg" alt="A placeholder image">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h5 class="card-title"><?php echo htmlspecialchars($result['Name']); ?></h5>
                </div>
                <div class="col-4">
                  <h5 class="card-title">£<?php echo htmlspecialchars($result['PurchaseCost']); ?></h5>
                </div>
              </div>
              <p class="card-text crop-text-2"><?php echo htmlspecialchars($result['Description']); ?></p>
              <form method="post">
                <input type="submit" name="addToCart" class="btn btn-outline-success col-12" value="Add To Cart">
                <?php
                if(array_key_exists('addToCart', $_POST)) {
                    addToCart($result['ProductID'], $cartArray);
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
            foreach ($cartArray as $itemID) { ?>
        <div id="cart contents"> <!-- Generated rows for contents would go here -->
            <div class="d-flex justify-content-between" id="cartBox">
              <p><?php echo $itemID; ?></p>
              <p class>1</p>
              <p class>£4.99</p>
              <a href="#!" style="color: white;"><i class="fa-solid fa-trash"></i></a>
            </div>
            <?php
            } ?>
        </div>

      </div>
    </div>
  </section>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
