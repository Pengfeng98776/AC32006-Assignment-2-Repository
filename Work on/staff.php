<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!-- include head for page -->
  <?php include 'includes/head.php';?>
<body>
  <?php
  include 'includes/db.php';
  include 'includes/navbar.php';

  $stmt = $mysql->query("SELECT * FROM Product");
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Fetch orders from OrderItem table
  $stmt = $mysql->query("SELECT OrderItem.OrderItemID, OrderItem.Quantity, OrderItem.Subtotal, OrderItem.OrderID, Product.ProductName
                          FROM OrderItem
                          INNER JOIN Product ON OrderItem.ProductID = Product.ProductID");
  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

<div class="container-fluid">
  <h2 class="text-center"><u>Orders</u></h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-between">
      <!-- Display products -->
      <?php foreach ($orders as $order): ?>
        <div class="col mb-2">
          <div class="card h-100">
            <!-- Placeholder image -->
            <img class="card-img-top" src="images/product placeholders/bike-image-1.jpg" alt="A placeholder image">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h5 class="card-title"><?php echo htmlspecialchars($order['ProductName']); ?></h5>
                </div>
                <div class="col-4">
                  <h5 class="card-title">£<?php echo htmlspecialchars($order['Subtotal']); ?></h5>
                </div>
              </div>
              <p class="card-text crop-text-2">Quantity: <?php echo htmlspecialchars($order['Quantity']); ?></p>
              <p class="card-text crop-text-2">Order ID: <?php echo htmlspecialchars($order['OrderID']); ?></p>

              <!-- Form for delete button -->
              <form method="post" action="delete_order.php"> <!-- Specify the actual action file for deletion -->
                <input type="hidden" name="orderItemID" value="<?php echo $order['OrderItemID']; ?>">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete Order</button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="col d-none d-xl-block border mt-4 align-content-end">

    </div>      
</div>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
