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
  if (!isset($_SESSION["cartArray"])) {
    $_SESSION["cartArray"] = array();
  }

  if (!isset($_SESSION["quantityArray"])) {
    $_SESSION["quantityArray"] = array();
  }

  if (!isset($_SESSION["subtotal"])) {
    $_SESSION["subtotal"] = 0;
  }

  // Fetch all products from the database
  $stmt = $mysql->query("SELECT * FROM Product");
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

  function addToCart($ID, $cost) {
    if (!in_array($ID, $_SESSION["cartArray"])) {
      $_SESSION["cartArray"][] = $ID;
      $_SESSION["quantityArray"][] = 1;
      $_SESSION["subtotal"] += $cost;
    } else {
      $index = array_search($ID, $_SESSION["cartArray"]);
      $_SESSION["quantityArray"][$index]++;
      $_SESSION["subtotal"] += $cost;
  }
  }

  function clearCart() {
    $_SESSION["cartArray"] = array();
    $_SESSION["quantityArray"] = array();
    $_SESSION["subtotal"] = 0;
  }

  // check if add to cart was clicked
  if (isset($_POST['addToCart'])) {
    $productID = $_POST['idHidden'];
    $productCost = $_POST['costHidden'];
    addToCart($productID, $productCost);
    // Use POST/REDIRECT/GET pattern to avoid form resubmission
    header("Location: customer.php");
    exit;
  }
  // check if clear cart was clicked
  if (isset($_POST['clearCart'])) {
    clearCart();
    // Use POST/REDIRECT/GET pattern to avoid form resubmission
    header("Location: customer.php");
    exit;
  }

  if (isset($_POST['checkout'])) {
    // Create a new order in the OrderTable and get the OrderID
    $mysql->beginTransaction();
    $insertOrder = $mysql->prepare("INSERT INTO OrderTable (/* your order table columns */) VALUES (/* your values */)");
    $insertOrder->execute();
    $orderID = $mysql->lastInsertId();

    // Insert each item in the cart as an OrderItem
    for ($i = 0; $i < count($_SESSION["cartArray"]); $i++) {
        $productID = $_SESSION["cartArray"][$i];
        $quantity = $_SESSION["quantityArray"][$i];
        $subtotal = $_SESSION["subtotal"];

        // Insert into OrderItem table
        $insertOrderItem = $mysql->prepare("INSERT INTO OrderItem (Quantity, Subtotal, OrderID, ProductID) VALUES (?, ?, ?, ?)");
        $insertOrderItem->execute([$quantity, $subtotal, $orderID, $productID]);
    }

    // Commit the transaction
    $mysql->commit();

    // Clear the cart after successful checkout
    clearCart();
    header("Location: customer.php");
    exit;
}

  // search functionality
  $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
  $products = [];
  if ($searchTerm) {
      $searchTerm = '%' . $searchTerm . '%';
      $stmt = $mysql->prepare("SELECT * FROM Product WHERE ProductName LIKE :searchTerm OR Description LIKE :searchTerm");
      $stmt->bindParam(':searchTerm', $searchTerm);
      $stmt->execute();
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
      $stmt = $mysql->query("SELECT * FROM Product");
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  ?>

  <section class="container mt-5">
    <h2 class="text-center mb-4"><?php echo $searchTerm ? 'Search Results' : 'All Products'; ?></h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-between">
      <?php foreach ($products as $result): ?>
        <div class="col mb-2">
          <div class="card h-100">
            <!-- because we haven't sorted the images being stored in the db so just using the placeholder :) -->
            <img class="card-img-top" src="/uploads/<?php echo htmlspecialchars($result['Image']); ?>" alt="Product Image">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h5 class="card-title"><?php echo htmlspecialchars($result['ProductName']); ?></h5> <!-- htmlspecialchars to protect against cross site scripting smile -->
                </div>
                <div class="col-4">
                  <h5 class="card-title">£<?php echo htmlspecialchars($result['PurchaseCost']); ?></h5>
                </div>
              </div>
              <p class="card-text crop-text-2"><?php echo htmlspecialchars($result['Description']); ?></p>
              <form method="post">
                <!-- Adds a hidden input field to store the product ID -->
                <input type="hidden" name="idHidden" value="<?php echo $result['ProductID']; ?>">
                <input type="submit" name="addToCart" onClick="document.location.href='test/customer.php'" class="btn btn-outline-success col-12" value="Add To Cart">

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
            <?php
            $productPrice = array('PurchaseCost' => null);
              foreach ($_SESSION["cartArray"] as $itemID) {
                $stmt = $mysql->prepare("SELECT PurchaseCost FROM Product WHERE ProductID = ?");
                $stmt->execute([$itemID]);
                $productPrice = $stmt->fetch(PDO::FETCH_ASSOC);
              }
              $_SESSION['subtotal'] = $_SESSION['subtotal'] + $productPrice['PurchaseCost'];
            ?>
            <h4 id="Subtotal">Subtotal: £<?php echo $_SESSION['subtotal']  ?></h4>
            <div class="row">
              <div class="col">
              <form method="post">
                <input type="submit" name="checkout" value="Check-out" class="btn btn-outline-success col-12">
              </form>
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
              $cIndex = 0;
            foreach ($_SESSION["cartArray"] as $itemID) {
              $stmt = $mysql->prepare("SELECT * FROM Product WHERE ProductID = ?");
              $stmt->execute([$itemID]);
              $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);
              ?>
        <div id="cart contents"> <!-- Generated rows for contents would go here -->
            <div class="d-flex justify-content-between" id="cartBox">
              <p><?php echo htmlspecialchars($productDetails['ProductName']); ?></p>
              <p><?php echo (htmlspecialchars($_SESSION['quantityArray'][$cIndex])); ?></p>
              <p>£<?php echo htmlspecialchars($productDetails['PurchaseCost']); ?></p>

            </div>
            <?php
            $cIndex += 1;
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
