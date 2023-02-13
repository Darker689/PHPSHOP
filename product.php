<?php
require_once('config.php');

$userName = $_SESSION['user'];

// Product
$product = Product::show($_GET['id']);

// Images

$images = Images::index($_GET['id']);

// COLORS

$colors = Colors::index($_GET['id']);

// sizes

$sizes = Sizes::index($_GET['id']);

// $comments

$comments = Comment::index($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['send_comment'])) {
    Comment::create($_GET['id'], $userName['name'], $_POST['comment']);
}
// $comments

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_to_shopping'])) {
    Cart_product::create($_POST['user_id'], $_POST['product_id']);
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

    <!-- Breadcrumbs-->
    <div class="bg-dark py-6">
        <div class="container-fluid">
            <nav class="m-0" aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item breadcrumb-light"><a href="#">Home</a></li>
                    <li class="breadcrumb-item breadcrumb-light"><a href="#">T-Shirts</a></li>
                    <li class="breadcrumb-item  breadcrumb-light active" aria-current="page">Osaka Japan Mens T-Shirt</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- / Breadcrumbs-->

    <div class="container-fluid mt-5">

        <!-- Product Top Section-->
        <div class="row g-9" data-sticky-container>

            <!-- Product Images-->
            <div class="col-12 col-md-6 col-xl-7">
                <div class="row g-3" data-aos="fade-right">
                    <div class="col-12">
                        <picture>
                            <p>Main Img</p>
                            <img class="img-fluid" data-zoomable src="
                                  <?php if ($product['main_img'] == '') {
                                        echo 'no_img.png';
                                    } else {
                                        echo $product['main_img'];
                                    }
                                    ?> 
                            ">
                        </picture>
                        <div style="margin-top: 30px; display: flex; flex-direction: column;">
                            <p>Images</p>
                            <?php foreach ($images as $image) : ?>
                                <picture>
                                    <img class="img-fluid" data-zoomable src="<?= $image['url'] ?>" style="margin-top: 10px;">
                                </picture>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Product Images-->

            <!-- Product Information-->
            <div class="col-12 col-md-6 col-lg-5">
                <div class="sticky-top top-5">
                    <div class="pb-3" data-aos="fade-in">

                        <h1 class="mb-1 fs-2 fw-bold"><?= $product['name'] ?></h1>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fs-4 m-0">$<?= $product['price'] ?></p>
                        </div>
                        <div class="border-top mt-4 mb-3 product-option">
                            <small class="text-uppercase pt-4 d-block fw-bolder">
                                <span class="text-muted">Available Sizes</span>
                            </small>
                            <div style="display: flex; gap: 20px;">
                                <?php foreach ($sizes as $size) : ?>
                                    <p class="border p-1"><?= $size['size'] ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Colour Filter -->
                        <div class="py-4 widget-filter border-top">
                            <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron" data-bs-toggle="collapse" href="#filter-modal-colour" role="button" aria-expanded="true" aria-controls="filter-modal-colour">
                                Colour
                            </a>
                            <div id="filter-modal-colour" class="collapse show">
                                <div class="filter-options mt-3 d-flex gap-3 ">
                                    <?php foreach ($colors as $color) : ?>
                                        <div class="w-[90px] ">
                                            <div class="border" style="width: 30px; height: 30px; background: <?= $color['color_name'] ?>;"></div>
                                            <?= $color['color_name'] ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <!-- <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-success">
                                        <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-1">
                                        <label class="form-check-label" for="filter-colours-modal-1"></label>
                                    </div>
                                    <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-danger">
                                        <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-2">
                                        <label class="form-check-label" for="filter-colours-modal-2"></label>
                                    </div>
                                    <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-info">
                                        <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-3">
                                        <label class="form-check-label" for="filter-colours-modal-3"></label>
                                    </div>
                                    <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-warning">
                                        <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-4">
                                        <label class="form-check-label" for="filter-colours-modal-4"></label>
                                    </div>
                                    <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-dark">
                                        <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-5">
                                        <label class="form-check-label" for="filter-colours-modal-5"></label>
                                    </div>
                                    <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-secondary">
                                        <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-6">
                                        <label class="form-check-label" for="filter-colours-modal-6"></label>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- / Colour Filter -->
                        <form action="" method="POST">
                            <input type="hidden" name="user_id" value="<?= $userName['id'] ?>">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button class="btn btn-dark w-100 mt-4 mb-0 hover-lift-sm hover-boxshadow" type="submit" name="add_to_shopping">Add To Shopping Bag</button>
                        </form>


                        <!-- Product Highlights-->
                        <div class="my-5">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="text-center px-2">
                                        <i class="ri-24-hours-line ri-2x"></i>
                                        <small class="d-block mt-1">Next-day Delivery</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="text-center px-2">
                                        <i class="ri-secure-payment-line ri-2x"></i>
                                        <small class="d-block mt-1">Secure Checkout</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="text-center px-2">
                                        <i class="ri-service-line ri-2x"></i>
                                        <small class="d-block mt-1">Free Returns</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Product Highlights-->

                        <!-- Product Accordion -->
                        <div class="accordion" id="accordionProduct">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Product Details
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionProduct">
                                    <div class="accordion-body">
                                        <p class="m-0">Made from 100% organic cotton, The Kiikii Osaka Japan T-Shirt was created with everyday use in mind. It features printed graphics and heavyweight fabric for maximum comfort and lifespan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Details & Care
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionProduct">
                                    <div class="accordion-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex border-0 row g-0 px-0">
                                                <span class="col-4 fw-bolder">Composition</span>
                                                <span class="col-7 offset-1">98% Cotton, 2% elastane</span>
                                            </li>
                                            <li class="list-group-item d-flex border-0 row g-0 px-0">
                                                <span class="col-4 fw-bolder">Care</span>
                                                <span class="col-7 offset-1">Professional dry clean only. Do not bleach. Do not iron.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Delivery & Returns
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionProduct">
                                    <div class="accordion-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex border-0 row g-0 px-0">
                                                <span class="col-4 fw-bolder">Delivery</span>
                                                <span class="col-7 offset-1">Standard delivery free for orders over $99. Next day delivery $9.99</span>
                                            </li>
                                            <li class="list-group-item d-flex border-0 row g-0 px-0">
                                                <span class="col-4 fw-bolder">Returns</span>
                                                <span class="col-7 offset-1">30 day return period. See our <a class="text-link-border" href="#">terms & conditions.</a></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Product Accordion-->
                    </div>
                </div>
            </div>
            <!-- / Product Information-->
        </div>
        <!-- / Product Top Section-->

        <div class="row g-0">

            <!-- Related Products-->
            <div class="col-12" data-aos="fade-up">
                <h3 class="fs-4 fw-bolder mt-7 mb-4">You May Also Like</h3>
                <!-- Swiper Latest -->
                <div class="swiper-container" data-swiper data-options='{
                        "spaceBetween": 10,
                        "loop": true,
                        "autoplay": {
                          "delay": 5000,
                          "disableOnInteraction": false
                        },
                        "navigation": {
                          "nextEl": ".swiper-next",
                          "prevEl": ".swiper-prev"
                        },   
                        "breakpoints": {
                          "600": {
                            "slidesPerView": 2
                          },
                          "1024": {
                            "slidesPerView": 3
                          },       
                          "1400": {
                            "slidesPerView": 4
                          }
                        }
                      }'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-danger rounded-circle d-block me-1"></span> Sale</span>
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-1.jpg" alt="">
                                    </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike Air VaporMax 2021</a>
                                    <small class="text-muted d-block">4 colours, 10 sizes</small>
                                    <p class="mt-2 mb-0 small"><s class="text-muted">$329.99</s> <span class="text-danger">$198.66</span></p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-success rounded-circle d-block me-1"></span> New In</span>
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-2.jpg" alt="">
                                    </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike ZoomX Vaporfly</a>
                                    <small class="text-muted d-block">2 colours, 4 sizes</small>
                                    <p class="mt-2 mb-0 small">$275.45</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-secondary rounded-circle d-block me-1"></span> Sold Out</span>
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-3.jpg" alt="">
                                    </picture>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike Blazer Mid &#x27;77</a>
                                    <small class="text-muted d-block">5 colours, 6 sizes</small>
                                    <p class="mt-2 mb-0 small text-muted">Sold Out</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-4.jpg" alt="">
                                    </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike Air Force 1</a>
                                    <small class="text-muted d-block">6 colours, 9 sizes</small>
                                    <p class="mt-2 mb-0 small">$425.85</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-danger rounded-circle d-block me-1"></span> Sale</span>
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-5.jpg" alt="">
                                    </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike Air Max 90</a>
                                    <small class="text-muted d-block">4 colours, 10 sizes</small>
                                    <p class="mt-2 mb-0 small"><s class="text-muted">$196.99</s> <span class="text-danger">$98.66</span></p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-danger rounded-circle d-block me-1"></span> Sale</span>
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-success rounded-circle d-block me-1"></span> New In</span>
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-6.jpg" alt="">
                                    </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike Glide FlyEase</a>
                                    <small class="text-muted d-block">1 colour</small>
                                    <p class="mt-2 mb-0 small"><s class="text-muted">$329.99</s> <span class="text-danger">$198.66</span></p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-7.jpg" alt="">
                                    </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike Zoom Freak</a>
                                    <small class="text-muted d-block">2 colours, 2 sizes</small>
                                    <p class="mt-2 mb-0 small">$444.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-success rounded-circle d-block me-1"></span> New In</span>
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-8.jpg" alt="">
                                    </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike Air Pegasus</a>
                                    <small class="text-muted d-block">3 colours, 10 sizes</small>
                                    <p class="mt-2 mb-0 small">$178.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                        <div class="swiper-slide">
                            <!-- Card Product-->
                            <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                <div class="card-img position-relative">
                                    <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-success rounded-circle d-block me-1"></span> New In</span>
                                    </div>
                                    <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-1.jpg" alt="">
                                    </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <a class="text-decoration-none link-cover" href="./product.php">Nike Air Jordans</a>
                                    <small class="text-muted d-block">3 colours, 10 sizes</small>
                                    <p class="mt-2 mb-0 small">$154.99</p>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                    </div>

                    <!-- Add Arrows -->
                    <div class="swiper-prev top-50  start-0 z-index-30 cursor-pointer transition-all bg-white px-3 py-4 position-absolute z-index-30 top-50 start-0 mt-n8 d-flex justify-content-center align-items-center opacity-50-hover">
                        <i class="ri-arrow-left-s-line ri-lg"></i>
                    </div>
                    <div class="swiper-next top-50 end-0 z-index-30 cursor-pointer transition-all bg-white px-3 py-4 position-absolute z-index-30 top-50 end-0 mt-n8 d-flex justify-content-center align-items-center opacity-50-hover">
                        <i class="ri-arrow-right-s-line ri-lg"></i>
                    </div>


                </div>
                <!-- / Swiper Latest-->
            </div>
            <!-- / Related Products-->

            <!-- Reviews-->
            <div class="col-12" data-aos="fade-up">
                <h3 class="fs-4 fw-bolder mt-7 mb-4 reviews">Reviews</h3>

                <?php if (isset($userName)) : ?>
                    <div style="width: 100%; display: flex; align-items: center; justify-content: center;">
                        <form action="" method="POST" style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <textarea type="text" name="comment" class="form-control" style="width: 100%;" placeholder="Write Commment"></textarea>
                            <button type="send_comment" name="send_comment" class="btn btn-success text-white mt-5 mb-5">send comment</button>
                        </form>
                    </div>
                <?php endif ?>

                <!-- Review Summary-->
                <div class="bg-light p-5 justify-content-between d-flex flex-column flex-lg-row">
                    <div class="d-flex flex-column align-items-center mb-4 mb-lg-0">
                        <div class="bg-dark text-white f-w-24 f-h-24 d-flex rounded-circle align-items-center justify-content-center fs-2 fw-bold mb-3">4.3</div>
                        <!-- Review Stars Medium-->
                        <div class="rating position-relative d-table">
                            <div class="position-absolute stars" style="width: 88%">
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                            </div>
                            <div class="stars">
                                <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-grow-1 flex-column ms-lg-8">
                        <div class="d-flex align-items-center justify-content-start mb-2">
                            <div class="f-w-20">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 100%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="fw-bold small d-block f-w-4 text-end">55</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start mb-2">
                            <div class="f-w-20">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 80%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="fw-bold small d-block f-w-4 text-end">32</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start mb-2">
                            <div class="f-w-20">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 60%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="fw-bold small d-block f-w-4 text-end">15</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start mb-2">
                            <div class="f-w-20">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 40%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 8%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="fw-bold small d-block f-w-4 text-end">5</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start mb-2">
                            <div class="f-w-20">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 20%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="fw-bold small d-block f-w-4 text-end">1</span>
                        </div>
                        <p class="mt-3 mb-0 d-flex align-items-start"><i class="ri-chat-voice-line me-2"></i> 105 customers have reviewed this product</p>
                    </div>
                </div>
                <!-- / Rewview Summary-->

                <!-- Reviews-->
                <div class="row g-6 g-md-8 g-lg-10 my-3">
                    <?php foreach ($comments as $comment) : ?>
                        <div class="col-12 col-lg-6 col-xxl-4 shadow ">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="text-muted small"><?= $comment['created_at'] ?> by <span style="font-size: 17px; font-weight: 800;"><?= $comment['username'] ?></span></div>
                            </div>
                            <p class="fs-7"><?= $comment['comment'] ?></p>
                        </div>
                    <?php endforeach; ?>


                    <!-- <div class="col-12 col-lg-6 col-xxl-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rating position-relative d-table">
                                <div class="position-absolute stars" style="width: 20%">
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                </div>
                                <div class="stars">
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                </div>
                            </div>
                            <div class="text-muted small">20th September 2020 by Holly</div>
                        </div>
                        <p class="fw-bold mb-2">Nothing special but it&#x27;s okay</p>
                        <p class="fs-7">It&#x27;s a t-shirt. What can I say, it does the job.</p>
                    </div> -->


                </div>
                <!-- / Reviews-->

                <!-- Review Pagination-->
                <div class="d-flex flex-column f-w-44 mx-auto my-5 text-center">
                    <small class="text-muted">Showing 6 of 105 reviews</small>
                    <div class="progress f-h-1 mt-3">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="#" class="btn btn-outline-dark btn-sm mt-5 align-self-center py-3 px-4 border-2">Load More</a>
                </div><!-- / Review Pagination-->
            </div>
            <!-- / Reviews-->
        </div>

    </div>

    <!-- /Page Content -->
</section>
<!-- / Main Section-->

<!-- FOOTER -->
<?php
include('./layouts/footer.php');
?>
<!-- FOOTEREND -->