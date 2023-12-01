<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!-- include head for page -->
  <?php include 'includes/head.php';?>
<body>
  <?php
  include 'includes/db.php';
  include 'includes/navbar.php';

  // Fetch all products from the database
  $stmt = $mysql->query("SELECT * FROM Product");
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <section class="container mt-5">
    <h2 class="text-center mb-4">All Products</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
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
              <a href="#" class="btn btn-outline-success col-12">Add to cart</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
