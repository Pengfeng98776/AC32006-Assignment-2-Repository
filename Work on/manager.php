<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- include head for page -->
<?php include 'includes/head.php';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
?>

<body onload="updatePageContents('<?php echo $searchTerm; ?>')">
  <!-- this doesnt work unless here idk why leave me alone. -->
  <?php
  include 'includes/db.php';
  include 'includes/navbar.php';
  ?>
  <div class="container-fluid">
    <div class="row">

      <!-- First column for products -->
      <div class="col-xl-10">
        <div id="error" class="alert alert-danger d-none">

        </div>

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
          <?include "productPageNav.php"?>
        </div>

        <!-- Bottom Row: pagination for product pages -->
        <div class="row">
          <div class="col-12 d-flex justify-content-between align-items-center my-1 px-1" id="pagination">
            <div>
              <a onclick="prevPage()" class="btn btn-outline-success d-none d-sm-block disabled" id="prevFullBtn">‹
                Previous</a>
              <a onclick="prevPage()" class="btn btn-outline-success d-block d-sm-none disabled" id="prevSmallBtn">‹</a>
            </div>
            <div>
              <form onsubmit="paginationForm()" class="form-check">
                Page <input type="text" placeholder="0" size="1" id="formInput" class="rounded"> of <span
                  id="pageCount">0</span>
              </form>
            </div>
            <div>
              <a onclick="nextPage()" class="btn btn-outline-success d-none d-sm-block" id="nextFullBtn">Next ›</a>
              <a onclick="nextPage()" class="btn btn-outline-success d-block d-sm-none" id="nextSmallBtn">›</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Additional column for Manager Actions -->
      <div class="col-lg-2 d-none d-xl-block border mt-2">
        <div class="row mt-2">
          <div class="col">
            <h2 class="mb-2">Manager Actions:</h2>
            <hr class="hr hr-blurry my-2" />

            <!-- Add Product -->
            <h3 class="mb-2 mt-1">Add Product:</h3>
            <button type="button" class="btn btn-outline-success col-12" data-bs-toggle="modal" data-bs-target="#addProductModal"> Open Add Product Form </button>

          </div>
          <form name="Remove New Product" action="removeProduct.php" method="post">
            <h4>Delete Product:</h4>
            <input type="text" class="form-control" name="delID" placeholder="ID to delete">
            <input type="submit" name="submitDel" value="Confirm" class="btn btn-outline-success col-12 mt-2"></input>
          </form>
        </div>
      </div>
    </div>

    <!-- Add Product Modal (is out here so that when the Manager Actions col disappears it stays )-->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-xl">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h5 class="modal-title">Add Product Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <!-- Add Product Form -->
          <form name="Add New Product" action="addProduct.php" method="post" enctype="multipart/form-data"> <!--id="addProductForm"-->
            <div class="modal-body">

              <!-- Name, Buy & sell prices -->
              <div class="row"> 
                <div class="col-12 col-xl-6 mb-2"> <input type="text" class="form-control" name="name" placeholder="Name of product"> </div>
                <div class="col-6 col-xl-3 mb-2"> <input type="text" class="form-control" name="purchaseCost" placeholder="Buying Price from supplier"> </div>
                <div class="col-6 col-xl-3 mb-2"> <input type="text" class="form-control" name="sellingPrice" placeholder="selling price to customers"> </div>
                
              </div>
              
              <!-- Quantity and image upload-->
              <div class="row"> 
                <div class="col-12 col-xl-6 mb-2"> <input type="file" class="form-control" name="imageToUpload" placeholder="Image of product"> </div>
                <div class="col-12 col-xl-6 mb-2"> <input type="text" class="form-control" name="quantity" placeholder="Quantity in supply"> </div>
              </div>

              <!-- Description -->
              <div class="row">
                <div class = "col-12 mb-2"> <textarea class="form-control" name="description" placeholder="Description of product" rows="3"></textarea> </div>
              </div>

              <!-- CatagoryID & WarehouseID -->
              <div class="row">
                <div class="col-6 col-xl-6 mb-2">
                  <select class="form-select" data-live-search="true" name="catagoryID"> <!-- Unfortunatly data live search is not yet supported in bootstrap5 -->
                    <option disabled selected value="0">Catagory of product</option>
                    <option value="1" data-tokens="1">1 - Example Catagory 1</option>
                    <option value="2" data-tokens="2">2 - Example Catagory 2</option>
                    <option value="3" data-tokens="3">3 - Example Catagory 3</option>
                  </select>
                </div>

                <div class="col-6 col-xl-6 mb-2">
                  <select class="form-select" data-live-search="true" name="warehouseID"> <!-- Unfortunatly data live search is not yet supported in bootstrap5 -->
                    <option disabled selected value="0">Warehouse to store product</option>
                    <option value="1" data-tokens="1">1 - Example Warehouse 1</option>
                    <option value="2" data-tokens="2">2 - Example Warehouse 2</option>
                    <option value="3" data-tokens="3">3 - Example Warehouse 3</option>
                  </select>
                </div>

              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Close</button>
              <input type="submit" name="submit" class="btn btn-success"></input>
            </div>
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