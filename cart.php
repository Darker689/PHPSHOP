<!-- HEADER -->

<?php
include('./layouts/header.php');
require_once('config.php');

if (isset($_SESSION['user'])) {
    $userName = $_SESSION['user'];
} else {
    header('Location: index.php');
}

$cart_product_ids = Cart_product::index($userName['id']);

$cart_products = [];

foreach ($cart_product_ids as $id) {
    array_push($cart_products, Product::show($id['product_id']));
}

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['delete_id'])) {
    $delete = Cart_product::delete($_POST['delete_id']);
}

?>


<!-- HEADEREND -->

<!-- NAVBAR -->
<?php
include('./layouts/navbar.php');
?>
<!-- NAVBAREND -->


<!-- Main Section-->
<section class="mt-0   vh-lg-100">


    <!-- Page Content Goes Here -->
    <div class="container">
        <div class="row g-0 vh-lg-100">
            <div class="col-12 col-lg-7 pt-5 pt-lg-10 ">
                <div class="pe-lg-5">

                    <nav class="d-none d-md-block">
                        <ul class="list-unstyled d-flex justify-content-start mt-4 align-items-center fw-bolder small">
                            <li class="me-4"><a class="nav-link-checkout active" href="./cart.php">Your Cart</a></li>
                            <li class="me-4"><a class="nav-link-checkout " href="./checkout.php">Information</a></li>
                            <li class="me-4"><a class="nav-link-checkout " href="./checkout-shipping.php">Shipping</a></li>
                            <li><a class="nav-link-checkout nav-link-last " href="./checkout-payment.php">Payment</a></li>
                        </ul>
                    </nav>
                    <div class="mt-5">
                        <h3 class="fs-5 fw-bolder mb-0 border-bottom pb-4">Your Cart</h3>
                        <div class="table-responsive">
                            <div class="table align-middle">
                                <div>
                                    <!-- Cart Item-->
                                    <?php foreach ($cart_products as $cart_product) : ?>
                                        <?php

                                        $sizes = Sizes::index($cart_product['id']);
                                        $colors = Colors::index($cart_product['id']);

                                        ?>
                                        <div class="row mx-0 py-4 g-0 border-bottom">
                                            <div class="col-2 position-relative">
                                                <picture class="d-block border">
                                                    <img class="img-fluid" src="
                                                       <?php if ($cart_product['main_img'] == '') {
                                                            echo 'no_img.png';
                                                        } else {
                                                            echo $cart_product['main_img'];
                                                        }
                                                        ?> 
                                                    ">
                                                </picture>
                                            </div>
                                            <div class="col-9 offset-1">
                                                <div>
                                                    <h6 class="justify-content-between d-flex align-items-start mb-2">
                                                        <?= $cart_product['name'] ?>
                                                        <?php foreach ($cart_product_ids as $cart) : ?>
                                                            <?php if ($cart['product_id'] == $cart_product['id']) : ?>
                                                                <form action="" method="POST" onsubmit="confirm('Really shut up')">
                                                                    <input type="hidden" name="delete_id" value="<?= $cart['id'] ?>">
                                                                    <button type="submit" style="border: none; background: transparent;">
                                                                        <i class="ri-close-line ms-3"></i>
                                                                    </button>
                                                                </form>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </h6>
                                                    <div class="d-flex gap-3">
                                                        Size:
                                                        <select class="d-block text-muted fw-bolder text-uppercase fs-9">
                                                            <?php foreach ($sizes as $size) : ?>
                                                                <option value="<?= $size['size'] ?>"><?= $size['size'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        Color:
                                                        <select class="d-block text-muted fw-bolder text-uppercase fs-9">
                                                            <?php foreach ($colors as $color) : ?>
                                                                <option value="<?= $color['color_name'] ?>;" style="background: <?= $color['color_name'] ?>;">
                                                                    <?= $color['color_name'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <p class="fw-bolder text-end text-muted m-0">$<?= $cart_product['price'] ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <!-- / Cart Item-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 bg-light pt-lg-10 aside-checkout pb-5 pb-lg-0 my-5 my-lg-0">
                <div class="p-4 py-lg-0 pe-lg-0 ps-lg-5">
                    <div class="pb-4 border-bottom">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between mb-4 mb-md-2">
                            <div>
                                <p class="m-0 fw-bold fs-5">Grand Total</p>
                                <span class="text-muted small">Inc $45.89 sales tax</span>
                            </div>
                            <p class="m-0 fs-5 fw-bold">$422.99</p>
                        </div>
                    </div>
                    <div class="py-4">
                        <div class="input-group mb-0">
                            <input type="text" class="form-control" placeholder="Enter coupon code">
                            <button class="btn btn-secondary btn-sm px-4">Apply</button>
                        </div>
                    </div>
                    <a href="./checkout.php" class="btn btn-dark w-100 text-center" role="button">Proceed to checkout</a>
                </div>
            </div>
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

<!-- Theme JS -->
<!-- Vendor JS -->
<script src="./assets/js/vendor.bundle.js"></script>

<!-- Theme JS -->
<script src="./assets/js/theme.bundle.js"></script>
</body>

</html>