<!DOCTYPE html>
<html lang="en" dir="ltr">
  <!-- include head for page -->
  <?php include 'includes/head.php';?>
<body>
  <?php
  include 'includes/db.php';
  include 'includes/navbar.php';
  include 'includes/productPageNav.php';

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

  ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-10">
          <div class="row mt-2">
            <div class="col-6 align-items-center">
              <h5>
                  Products we have
              </h5>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">
              <form action="<?php echo "{$_SERVER['PHP_SELF']}";?>" class="form-check">
                  <input type="text" value="<?php echo $currentPage;?>" size="1"> of <?php echo $numOfPages;?>
              </form>
            </div>
          </div>
          <div id="products" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
            <?php foreach ($products as $result): ?>
              <div class="col mt-2">
                <div class="card bg-dark text-white">
                  <img class="card-img-top" src="images/product placeholders/product placeholder.jpg" alt="A placeholder image">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8">
                        <h5 class="card-title"><?php echo $result['ProductID'] . ': ' . $result['ProductName']; ?></h5>
                      </div>
                      <div class="col-4">
                        <h5 class="card-title">£<?php echo $result['PurchaseCost']; ?></h5>
                      </div>
                    </div>
                    <p class="card-text crop-text-2"><?php echo $result['Description']; ?></p>
                    <div class="row">
                      <div class="btn-group" data-toggle="buttons">
                        <a href="#" class="btn btn-outline-primary col-6">Generate report</a>
                        <a href="#" class="btn btn-outline-warning col-6">Mark as in-stock</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- navigation for prouct pages -->
          <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center my-1">
                <a href="<?php echo "{$_SERVER['PHP_SELF']}?currentPage="; echo $currentPage-1;?>" class="btn btn-outline-success <?php if ($currentPage==0) {echo "disabled";}?>"><span class = "d-none d-sm-block">Previous</span> <span class = "d-block d-sm-none">&laquo;</span></a>
                <div class="d-flex justify-content-center">
                    <?php
                    $printedCurrent = False;
                    $numOfPages = 20;
                    $numOfButtons=9;
                    for ($i=1; $i<$numOfButtons+1; $i++) {
                      if (($numOfPages-$currentPage+$i < $numOfButtons )){
                        echo "<a href=\"{$_SERVER['PHP_SELF']}?currentPage=", $numOfPages-($numOfButtons-$i) ,"\" class=\"me-1 btn btn-outline-success\">", $numOfPages-($numOfButtons-$i), "</a>";
                      } else if ($printedCurrent != True){
                        echo "<a href=\"{$_SERVER['PHP_SELF']}?currentPage=", $currentPage ,"\" class=\"me-1 btn btn-outline-success active\">", $currentPage, "</a>";
                        $printedCurrent = True;
                      } else if ($numOfPages>$numOfPages-$currentPage+$i) {
                        echo "<a href=\"{$_SERVER['PHP_SELF']}?currentPage=", $numOfPages-($numOfButtons-$i) ,"\" class=\"me-1 btn btn-outline-success\">", $numOfPages-($numOfButtons-$i), "</a>";
                      }
                    }
                    ?>
                </div>
                <a href="<?php echo "{$_SERVER['PHP_SELF']}?currentPage="; echo $currentPage+1;?>" class="btn btn-outline-success <?php if ($currentPage==$numOfPages) {echo "disabled";}?>"><span class = "d-none d-sm-block">Next Page</span> <span class = "d-block d-sm-none">&raquo;</span></a>
              </div>
            </div>
          </div>

        <div class="col-lg-2 d-none d-xl-block border mt-2"> <!-- Additional column for shopping cart -->
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
            <div class="row mt-5 ms-3 me-3">
              <form name="Remove New Product" action="removeProduct.php" method="post">
                <h4>Delete Product:</h4>
                <input type="text" class="form-control" name="delID" placeholder="ID to delete">
                <input type="submit" name="submitDel" value="Confirm" class="btn btn-outline-success col-12 mt-2"></input>
              </form>
            </div>
          </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
