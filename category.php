<?php
require_once('config.php');

$userName = $_SESSION['user'];

$products = Product::index();
$products = Category::list($_GET['category']);
$cat_id = Category::getId($_GET['category']);

$category_tagses = Category_Tag::list($cat_id);


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
    $products = Category_Tag::fillter($_POST['select_category']);
}

?>



<!-- HEADER -->
<?php
include('./layouts/header.php');
?>
<!-- HEADEREND -->

<!-- NAVBAR -->
<?php
include('./layouts/navbar.php');
?>
<!-- NAVBAREND -->

<!-- Main Section-->
<section class="mt-0 ">
    <!-- Page Content Goes Here -->

    <!-- Category Top Banner -->
    <div class="py-10 bg-img-cover bg-overlay-dark position-relative overflow-hidden bg-pos-center-center rounded-0" style="background-image: url(./assets/images/banners/banner-category-top.jpg);">
        <div class="container-fluid position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
            <h1 class="fw-bold display-6 mb-4 text-white">Latest Arrivals</h1>
            <div class="col-12 col-md-6">
                <p class="text-white mb-0 fs-5">
                    When it's time to head out and get your Kicks on, have a look at our latest arrivals. Whether you're into Nike, Adidas, Dunks or New Balance, we really have something for everyone!
                </p>
            </div>
        </div>
    </div>
    <!-- Category Top Banner -->

    <div class="container-fluid" data-aos="fade-in">
        <!-- Category Toolbar-->
        <div class="d-flex justify-content-between items-center pt-5 pb-4 flex-column flex-lg-row">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Sneakers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Releases</li>
                    </ol>
                </nav>
                <h1 class="fw-bold fs-3 mb-2">Products (<?= count($products)?>)</h1>
                <p class="m-0 text-muted small">Showing 1 - 9 of 121</p>
            </div>
            <div class="d-flex justify-content-end align-items-center mt-4 mt-lg-0 flex-column flex-md-row">

                <form action="" method="POST">
                    <!-- Sort Options-->
                    <select class="form-select form-select-sm border-0 bg-light p-3 pe-5 lh-1 fs-7" name="select_category">
                        <option selected>All</option>
                        <?php foreach($category_tagses as $category_tag): ?>
                            <option value="<?= $category_tag['name']?>"><?= $category_tag['name']?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- / Sort Options-->
                    <button type="submit" name="submit">fillter</button>
                </form>

            </div>
        </div> <!-- /Category Toolbar-->

        <!-- Products-->
        <div class="row g-4">
            <?php foreach ($products as $product) : ?>
                <div class="col-12 col-sm-6 col-lg-4">
                    <!-- Card Product-->
                    <div class="card border shadow border-transparent position-relative overflow-hidden h-100 transparent">
                        <div class="card-img position-relative">
                            <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                         
                         
                         
                            <picture class="position-relative overflow-hidden">
                                <img class="w-full h-full img-fluid position-relative z-index-10" style="width: 100%; height: 400px; object-fit: contain;" title="" src="
                                <?php if ($product['main_img'] == '') {
                                    echo 'no_img.png';
                                } else {
                                    echo $product['main_img'];
                                }
                                ?>
                                " alt="">
                            </picture>
                           
                           
                           
                            <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <a class="text-decoration-none link-cover" href="./product.php?id=<?= $product['id']?>"><?= $product['name'] ?></a>
                            <p class="mt-2 mb-0 fs-5">$<?= $product['price'] ?> <del class="text-danger fs-6">$<?= $product['discount'] ?></del></p>
                        </div>
                    </div>
                    <!--/ Card Product-->
                </div>
            <?php endforeach; ?>
        </div>
        <!-- / Products-->

        <!-- Pagination-->
        <div class="d-flex flex-column f-w-44 mx-auto my-5 text-center">
            <small class="text-muted">Showing 9 of 121 products</small>
            <div class="progress f-h-1 mt-3">
                <div class="progress-bar bg-dark" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <a href="#" class="btn btn-outline-dark btn-sm mt-5 align-self-center py-3 px-4 border-2">Load More</a>
        </div> <!-- / Pagination-->
    </div>

    <!-- /Page Content -->
</section>
<!-- / Main Section-->



<!-- Offcanvas Imports-->
<!-- Filters Offcanvas-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFilters" aria-labelledby="offcanvasFiltersLabel">
    <div class="offcanvas-body">
        <div class="d-flex flex-column justify-content-between w-100 h-100">
            <!-- Filters-->
            <div>

            </div>
            <!-- / Filters-->

            <!-- Filter Button-->
            <div class="border-top pt-3">
                <a href="#" class="btn btn-dark mt-2 d-block hover-lift-sm hover-boxshadow" data-bs-dismiss="offcanvas" aria-label="Close">Done</a>
            </div>
            <!-- /Filter Button-->
        </div>
    </div>
</div>



<!-- FOOTER -->
<?php
include('./layouts/footer.php');
?>
<!-- FOOTEREND -->