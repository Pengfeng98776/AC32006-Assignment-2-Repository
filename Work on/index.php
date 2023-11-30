<!DOCTYPE html>
<html lang="en">
    <!--  Useing tamplet reference form: https://templatemo.com/tm-556-catalog-z -->
    <!-- inlcude Head for page -->
    <?php include 'includes/head.php';?>
<body>
    <?php 
    include 'includes/db.php'; // includes a connection to the database
    include 'includes/navbar.php'; // includes the nav bar
    include 'includes/searchBar.php'; // includes the search bar

    // SELECTS ALL PRODUCTS
    $query = "SELECT * FROM Product";
    $stmt = $mysql->prepare($query);
    $stmt->execute();
    ?>
    

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Items we have
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="" class="tm-text-primary">
                    Page <input type="text" value="1" size="1" class="tm-input-paging tm-text-primary"> of <?php echo "200"; ?>
                </form>
            </div>
        </div>
        <!--Gets the next product in the database with fetch-->
        <?php $result = $stmt->fetch(); ?>
        <div class="row tm-mb-90 tm-gallery">
        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <!--Link item image database -->
                    <img src="img/placeholder.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <!--Link item name in database -->
                        <h2><?php echo $result['Name'] ?></h2>
                        <a href="detail.php">View more</a>
                    </figcaption>                    
                </figure>
                 <!--Blank for more information -->
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">£<?php echo $result['PurchaseCost'] ?></span>
                    <span><?php echo $result['Description'] ?></span>
                </div>
            </div>
            <!--Same below-->
            <?php $result = $stmt->fetch(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/placeholder.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $result['Name'] ?></h2>
                        <a href="detail.php">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">£<?php echo $result['PurchaseCost'] ?></span>
                    <span><?php echo $result['Description'] ?></span>
                </div>
            </div>
            <?php $result = $stmt->fetch(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-05.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $result['Name'] ?></h2>
                        <a href="detail.php">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Oct 2020</span>
                    <span>12,460 views</span>
                </div>
            </div>
            <?php $result = $stmt->fetch(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-06.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $result['Name'] ?></h2>
                        <a href="detail.php">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">10 Oct 2020</span>
                    <span>11,402 views</span>
                </div>
            </div>
            <?php $result = $stmt->fetch(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-01.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $result['Name'] ?></h2>
                        <a href="detail.php">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">24 Sep 2020</span>
                    <span>16,008 views</span>
                </div>
            </div>
            <?php $result = $stmt->fetch(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-02.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $result['Name'] ?></h2>
                        <a href="detail.php">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">20 Sep 2020</span>
                    <span>12,860 views</span>
                </div>
            </div>
            <?php $result = $stmt->fetch(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-07.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $result['Name'] ?></h2>
                        <a href="detail.php">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">16 Sep 2020</span>
                    <span>10,900 views</span>
                </div>
            </div>
            <?php $result = $stmt->fetch(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/img-08.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $result['Name'] ?></h2>
                        <a href="detail.php">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Sep 2020</span>
                    <span>11,300 views</span>
                </div>
            </div>
        </div> <!-- row -->
        <div class="row tm-mb-90">
            <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
                <a href="javascript:void(0);" class="btn btn-primary tm-btn-prev mb-2 disabled">Previous</a>
                <div class="tm-paging d-flex">
                    <a href="javascript:void(0);" class="active tm-paging-link">1</a>
                    <a href="javascript:void(0);" class="tm-paging-link">2</a>
                    <a href="javascript:void(0);" class="tm-paging-link">3</a>
                    <a href="javascript:void(0);" class="tm-paging-link">4</a>
                </div>
                <a href="javascript:void(0);" class="btn btn-primary tm-btn-next">Next Page</a>
            </div>            
        </div>
    </div> <!-- container-fluid, tm-container-content -->

    <h2>Add new Item</h2>
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
                  <input type="text" class="form-control" name="sellingPrice" placeholder="supplier id">
                </div>
                <p></p> <!-- spacing smile -->
                <div class="form-group">
                  <label for="formGroupExampleInput">Current quantity:</label>
                  <input type="text" class="form-control" name="stockQuantity" placeholder="quantity">
                </div>
                <input type="submit" name="submit" value="submit">
    </form>



    <?php 
    include 'includes/footer.php'; // includes the footer 
    include 'includes/load.php'; // includes the load animation
    ?>
</body>
</html>