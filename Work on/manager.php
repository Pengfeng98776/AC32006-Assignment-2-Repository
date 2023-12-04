<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- include head for page -->
<?php include 'includes/head.php';?>
<body onload="updatePageContents(null)"> <!-- this doesnt work unless here idk why leave me alone. -->
  <?php
  include 'includes/db.php';
  include 'includes/navbar.php';
  ?>
  <div class="container-fluid">
    <div class="row">

      <!-- First column for products -->
      <div class="col-xl-10">

      <!-- Top row -->
        <div class="row mt-2">
          <div class="align-items-center">
            <h5>
              Products we have
            </h5>
          </div>
        </div>

        <!-- Mid row: Containes actuall product listings-->
        <div id="products" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
          <!-- Content is generated using black magic from via jquery ajax & php -->
        </div>

        <!-- Bottom Row: pagination for product pages -->
        <div class="row">
          <div class="col-12 d-flex justify-content-between align-items-center my-1 px-1" id="pagination">
            <div>
              <a onclick="prevPage()" class="btn btn-outline-success d-none d-sm-block disabled" id="prevFullBtn">‹ Previous</a>
              <a onclick="prevPage()" class="btn btn-outline-success d-block d-sm-none disabled" id="prevSmallBtn">‹</a>
            </div>
            <div>
              <form onsubmit="paginationForm()" class="form-check">
                  Page <input type="text" value="" size="1" id="formInput" class="rounded"> of <span id="pageCount"></span>
              </form>
            </div>
            <div>
              <a onclick="nextPage()" class="btn btn-outline-success d-none d-sm-block" id="nextFullBtn">Next ›</a>
              <a onclick="nextPage()" class="btn btn-outline-success d-block d-sm-none" id="nextSmallBtn">›</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Additional column for Add product form -->
      <div class="col-lg-2 d-none d-xl-block border mt-2"> 
        <div class="row mt-2">
          <div class="col">
            <h3><i class="fa-solid fa-cart-shopping"></i>Add new product:</h3>
            <div class="row">
              <div class="col">
              </div>
            </div>
            <hr class="hr hr-blurry mt-2" />
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="javascript/javascript madness.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
</body>
</html>
