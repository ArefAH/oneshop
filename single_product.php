<?php
  include("server/connection.php");
  if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products where product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result();
  }
  else{
    header("location: index.php");
  }
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>One Shop - Home</title>
    <link
      rel="shortcut icon"
      href="assests/imgs/one-shop.png"
      type="image/x-icon"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="./assests/css/style.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav
      class="navbar navbar-expand-lg bs-body-bg bg-body-tertiary navbar-light py-5 fixed-top"
    >
      <div class="container">
        <a href="index.php">
          <img src="./assests/imgs/one-shop.png" style="width: 75px" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse nav-buttons"
          id="navbarSupportedContent"
        >
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="./">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./shop.html">Shop</a>
            </li>

            

            <li class="nav-item">
              <i
                onclick="window.location.href='cart.php';"
                class="bi bi-bag"
              ></i>
              <i
                onclick="window.location.href='login.html';"
                class="bi bi-person-circle"
              ></i>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- single product -->
    <section class="container single-product my-5 pt-5">
      <div class="row mt-5">
        <?php while($product = $product->fetch_assoc()) { ?>

          
        <div class="col-lg-5 col-md-12 col-sm-12">
          <img
            src="./assests/imgs/<?php echo $product['product_image'] ?>"
            class="img-fluid w-100 pb-1"
            id="main-img"
          />
          <div class="small-img-group">
            <div class="small-img-col">
              <img
                src="./assests/imgs/<?php echo $product['product_image'] ?>"
                width="100%"
                class="small-img"
              />
            </div>
            <div class="small-img-col">
              <img
                src="./assests/imgs/<?php echo $product['product_image2'] ?>"
                width="100%"
                class="small-img"
              />
            </div>
            <div class="small-img-col">
              <img
                src="./assests/imgs/<?php echo $product['product_image3'] ?>"
                width="100%"
                class="small-img"
              />
            </div>
            <div class="small-img-col">
              <img
                src="./assests/imgs/<?php echo $product['product_image4'] ?>"
                width="100%"
                class="small-img"
              />
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
          <h6><?php echo $product['product_category'] ?></h6>
          <h4 class="mt-5 mb-5"><?php echo $product['product_name'] ?></h4>
          <h2>$<?php echo $product['product_price'] ?></h2>
          <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
            <input type="hidden" name="product_image" value="<?php echo $product['product_image'] ?>">
            <input type="hidden" name="product_name" value="<?php echo $product['product_name'] ?>">
            <input type="hidden" name="product_price" value="<?php echo $product['product_price'] ?>">
        
          <input type="number" name="product_quantity" value="1" min="1" />
          <button class="buy-btn" type="submit" name="add_to_cart">Add To Bag</button>
          </form>
          
          <h4 class="mt-5 mb-5">Product details</h4>
          <span><?php echo $product['product_description'] ?></span>
        </div>
        
      </div>
    </section>

    <!--related products-->
    <?php
    if ($product['product_category'] == 'Shoes') {
        include('server/shoes.php');
    } elseif ($product['product_category'] == 'Coats') {
        include('server/coats.php');
    } elseif ($product['product_category'] == 'Shirts') {
        include('server/shirts.php');
    }
    ?>
    
    <section id="related-products" class="my-5 pb-5">
      <div class="container text-center mt-5 py-5">
        <h3>Related Products</h3>
        <hr class="mx-auto" />
      </div>
      <div class="row mx-auto container-fluid">
      <?php while($row = $get->fetch_assoc()) { ?>
        <div
          class="product text-center col-lg-3 col-md-6 col-sm-12"
        >
          <img src="assests/imgs/<?php echo $row['product_image'] ?>" class="img-fluid mb-3" />
          <div class="star">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price'] ?></h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
        </div>

        <?php } ?>
        <?php } ?>
      </div>
    </section>

    <!--Footer-->
    <footer class="mt-5 py-5">
      <div class="row container mx-auto mt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <img src="assests/imgs/logo-white.png" />
          <p class="pt-3">We provide the best products for the best prices</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Featured</h5>
          <ul class="text-uppercase">
            <li><a href="">men</a></li>
            <li><a href="">women</a></li>
            <li><a href="">boys</a></li>
            <li><a href="">girls</a></li>
            <li><a href="">new arrivals</a></li>
            <li><a href="">cloths</a></li>
          </ul>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Contact Us</h5>
          <div>
            <h6 class="text-uppeercase">Address</h6>
            <p>
              <a
                href="https://maps.app.goo.gl/CmFki7CPUof2DUos5"
                target="_blank"
                title="Visit Us"
                >1234 Msaytbeh, Beirut</a
              >
            </p>
          </div>
          <div>
            <h6 class="text-uppeercase">Phone</h6>
            <p><a href="tel:70123456" title="Call Us">70 123 456</a></p>
          </div>
          <div>
            <h6 class="text-uppeercase email">Email</h6>
            <p>
              <a href="mailto:arefabouhamdan@gmail.com" title="Send Us An Email"
                >arefabouhamdan@gmail.com</a
              >
            </p>
          </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
          <h5 class="pb-2">Instagram</h5>
          <div class="row insta">
            <img
              src="assests/imgs/featured1.png"
              class="img-fluid w-25 h-100 m-2"
            />
            <img
              src="assests/imgs/featured2.png"
              class="img-fluid w-25 h-100 m-2"
            />
            <img
              src="assests/imgs/featured3.png"
              class="img-fluid w-25 h-100 m-2"
            />
            <img
              src="assests/imgs/featured4.png"
              class="img-fluid w-25 h-100 m-2"
            />
          </div>
        </div>
      </div>
      <div class="copyright mt-5">
        <div class="row container mx-auto">
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 payments">
            <img src="assests/imgs/payments1.png" />
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-2">
            <p>eCommerce @ 2025 All Rights Reserved</p>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <a><i class="bi bi-facebook"></i></a>
            <a><i class="bi bi-linkedin"></i></a>
            <a><i class="bi bi-instagram"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>

    <script>
      var mainImg = document.getElementById("main-img");
      var smallImg = document.getElementsByClassName("small-img");

      for (let i = 0; i < 4; i++) {
        smallImg[i].onclick = () => {
          mainImg.src = smallImg[i].src;
        };
      }
    </script>
  </body>
</html>
