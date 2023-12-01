<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!-- include head for page -->
  <?php include 'includes/head.php';?>
<body>
  <?php
  include 'includes/db.php';
  include 'includes/navbar.php';

  // SELECTS ALL PRODUCTS
  $query = "SELECT * FROM Product";
  $stmt = $mysql->prepare($query);
  $stmt->execute();
  ?>
    <div class="container-fluid">
      <div class="row">

        <div class="col-sm-10">
          <div id="products" class="row mt-4 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4"> <!-- cards generated from query & js magic goes here, currently hardcoded examples -->
          <?php
          $maxResultsPerPage = 8;
          $result = $stmt->fetch();
          for ($i = 1; $i <= $maxResultsPerPage && $result != NULL; $i++) { ?>
            <div class="col mt-2">
              <div class="card">
                <img class="card-img-top" src="images/product placeholders/product placeholder.jpg" alt="A placeholder image">
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title"><?php echo $result['Name'] ?></h5>
                    </div>
                    <div class="col-4">
                      <h5 class="card-title">£<?php echo $result['PurchaseCost'] ?></h5>
                    </div>
                  </div>
                  <p class="card-text crop-text-2"><?php echo $result['Description'] ?></p>
                  <div class="row">
                    <a href="#" class="btn btn-outline-warning col-6" >Mark as in-stock</a>
                    <a href="#" class="btn btn-outline-primary col-6" >Generate report</a>
                  </div>
                </div>
              </div>
            </div>

            <?php $result = $stmt->fetch(); ?>
            <div class="col mt-2">
              <div class="card">
                <img class="card-img-top" src="images/product placeholders/product placeholder sold out.jpg" alt="A placeholder image" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title"><?php echo $result['Name'] ?></h5>
                    </div>
                    <div class="col-4">
                      <h5 class="card-title">£<?php echo $result['PurchaseCost'] ?></h5>
                    </div>
                  </div>
                  <p class="card-text crop-text-2"><?php echo $result['Description'] ?></p>
                  <div class="row">
                    <a href="#" class="btn btn-outline-warning col-6" >Mark as in-stock</a>
                    <a href="#" class="btn btn-outline-primary col-6" >Generate report</a>
                  </div>
                </div>
              </div>
            </div>

            <?php $result = $stmt->fetch(); ?>
            <div class="col mt-2">
              <div class="card">
                <img class="card-img-top" src="images/product placeholders/product placeholder.jpg" alt="A placeholder image" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title"><?php echo $result['Name'] ?></h5>
                    </div>
                    <div class="col-4">
                      <h5 class="card-title">£<?php echo $result['PurchaseCost'] ?></h5>
                    </div>
                  </div>
                  <p class="card-text crop-text-2"><?php echo $result['Description'] ?></p>
                  <div class="row">
                    <a href="#" class="btn btn-outline-warning col-6" >Mark as in-stock</a>
                    <a href="#" class="btn btn-outline-primary col-6" >Generate report</a>
                  </div>
                </div>
              </div>
            </div>

            <?php $result = $stmt->fetch(); ?>
            <div class="col mt-2">
              <div class="card">
                <img class="card-img-top" src="images/product placeholders/product placeholder.jpg" alt="A placeholder image" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title"><?php echo $result['Name'] ?></h5>
                    </div>
                    <div class="col-4">
                      <h5 class="card-title">£<?php echo $result['PurchaseCost'] ?></h5>
                    </div>
                  </div>
                  <p class="card-text crop-text-2"><?php echo $result['Description'] ?></p>
                  <div class="row">
                    <a href="#" class="btn btn-outline-warning col-6" >Mark as in-stock</a>
                    <a href="#" class="btn btn-outline-primary col-6" >Generate report</a>
                  </div>
                </div>
              </div>
            </div>

            <?php $result = $stmt->fetch(); ?>
            <div class="col mt-2">
              <div class="card">
                <img class="card-img-top" src="images/product placeholders/product placeholder sold out.jpg" alt="A placeholder image" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title"><?php echo $result['Name'] ?></h5>
                    </div>
                    <div class="col-4">
                      <h5 class="card-title">£<?php echo $result['PurchaseCost'] ?></h5>
                    </div>
                  </div>
                  <p class="card-text crop-text-2"><?php echo $result['Description'] ?></p>
                  <div class="row">
                    <a href="#" class="btn btn-outline-warning col-6" >Mark as in-stock</a>
                    <a href="#" class="btn btn-outline-primary col-6" >Generate report</a>
                  </div>
                </div>
              </div>
            </div>

            <?php $result = $stmt->fetch(); ?>
            <div class="col mt-2">
              <div class="card">
                <img class="card-img-top" src="images/product placeholders/product placeholder.jpg" alt="A placeholder image" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title"><?php echo $result['Name'] ?></h5>
                    </div>
                    <div class="col-4">
                      <h5 class="card-title">£<?php echo $result['PurchaseCost'] ?></h5>
                    </div>
                  </div>
                  <p class="card-text crop-text-2"><?php echo $result['Description'] ?></p>
                  <div class="row">
                    <a href="#" class="btn btn-outline-warning col-6" >Mark as in-stock</a>
                    <a href="#" class="btn btn-outline-primary col-6" >Generate report</a>
                  </div>
                </div>
              </div>
            </div>

            <?php $result = $stmt->fetch(); ?>
            <div class="col mt-2">
              <div class="card">
                <img class="card-img-top" src="images/product placeholders/product placeholder.jpg" alt="A placeholder image" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title"><?php echo $result['Name'] ?></h5>
                    </div>
                    <div class="col-4">
                      <h5 class="card-title">£<?php echo $result['PurchaseCost'] ?></h5>
                    </div>
                  </div>
                  <p class="card-text crop-text-2"><?php echo $result['Description'] ?></p>
                  <div class="row">
                    <a href="#" class="btn btn-outline-warning col-6" >Mark as in-stock</a>
                    <a href="#" class="btn btn-outline-primary col-6" >Generate report</a>
                  </div>
                </div>
              </div>
            </div>

            <?php $result = $stmt->fetch(); ?>
            <div class="col mt-2">
              <div class="card">
                <img class="card-img-top" src="images/product placeholders/product placeholder sold out.jpg" alt="A placeholder image" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title"><?php echo $result['Name'] ?></h5>
                    </div>
                    <div class="col-4">
                      <h5 class="card-title">£<?php echo $result['PurchaseCost'] ?></h5>
                    </div>
                  </div>
                  <p class="card-text crop-text-2"><?php echo $result['Description'] ?></p>
                  <div class="row">
                    <a href="#" class="btn btn-outline-warning col-6" >Mark as in-stock</a>
                    <a href="#" class="btn btn-outline-primary col-6" >Generate report</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-2 d-none d-xl-block border mt-4"> <!-- Additional column for shopping cart -->

          <div class="row mt-2">
            <div class="col">
              <h3><i class="fa-solid fa-cart-shopping"></i>Add new product:</h3>
              <div class="row">
                <div class="col">

                </div>
              </div>
              <hr class="hr hr-blurry mt-2"/>
              <div class="">
                <h4>New product:</h4>
                <p></p> <!-- spacing smile -->
              </div>
              <form name="Add New Product" action="addProduct.php" method="post">
                <p></p> <!-- spacing smile -->
                <div class="form-group">
                  <label for="formGroupExampleInput">Product name:</label>
                  <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <p></p> <!-- spacing smile -->
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Product Description:</label>
                  <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <p></p> <!-- spacing smile -->
                <div class="form-group">
                  <label for="formGroupExampleInput">Purchase Cost:</label>
                  <input type="text" class="form-control" name="purchaseCost" placeholder="price">
                </div>
                <p></p> <!-- spacing smile -->
                <div class="form-group">
                  <label for="formGroupExampleInput">Selling Price:</label>
                  <input type="text" class="form-control" name="sellingPrice" placeholder="selling price">
                </div>
                <p></p> <!-- spacing smile -->
                <div class="form-group">
                  <label for="formGroupExampleInput">Current quantity:</label>
                  <input type="text" class="form-control" name="stockQuantity" placeholder="quantity">
                </div>
                <div class="col mt-3 mb-2">
                  <input type="submit" name="submit" value="Confirm" class="btn btn-outline-success col-12"></input>
                </div>
    </form>
            </div>
          </div>
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
