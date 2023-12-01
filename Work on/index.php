<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!-- include head for page -->
  <?php include 'includes/head.php';?>
<body>
  <?php
  include 'includes/db.php';
  include 'includes/navbar.php';
  ?>

  <section class="cover">
    <img src="images/stock-image-1.jpg" alt="bike" class="img-fluid">
    <div class="cover-caption">
      <h1>Welcome to Dundee Direct</h1>
      <p>lorum ipsum</p>
    </div>
  </section>

  <section class="featured-products container mt-5">
    <h2 class="text-center mb-4">Featured Bicycles</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">

      <div class="col mt-2">
        <div class="card h-100">
          <img class="card-img-top" src="images/product placeholders/bike-image-1.jpg" alt="Mountain Bike">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <h5 class="card-title">Santa Cruz Tallboy</h5>
              </div>
              <div class="col-4">
                <h5 class="card-title">£6,599</h5>
              </div>
            </div>
            <p class="card-text crop-text-2">One of the first 29er full sussers that worked a trail bike, the every man's bike.</p>
            <a href="#" class="btn btn-outline-success col-12">Add to cart</a>
          </div>
        </div>
      </div>
      <!-- above is just a placeholder, could use sales to figure out what to feature?? -->
      <!-- also use the old card, we need to adapt them to include price and stuff :)) -->
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
