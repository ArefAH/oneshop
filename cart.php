<?php
  session_start();

  if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){
      $product_array_ids = array_column($_SESSION['cart'], 'product_id');
      if(!in_array($_POST['product_id'], $product_array_ids)){
        $product_array = array(
          'product_id' => $_POST['product_id'],
          'product_name' => $_POST['product_name'],
          'product_price' => $_POST['product_price'],
          'product_image' => $_POST['product_image'],
          'product_quantity' => $_POST['product_quantity']
        );

        $_SESSION['cart'][$_POST['product_id']] = $product_array;
        
      }else{
        echo "<script>alert('Product is already added in the cart')</script>";
        
      }
    }else{
        $product_array = array(
          'product_id' => $_POST['product_id'],
          'product_name' => $_POST['product_name'],
          'product_price' => $_POST['product_price'],
          'product_image' => $_POST['product_image'],
          'product_quantity' => $_POST['product_quantity']
        );

        $_SESSION['cart'][$_POST['product_id']] = $product_array;


      
    }
  } else if (isset($_POST['remove_product'])){
    unset($_SESSION['cart'][$_POST['product_id']]);


  } else{
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
    <style>
      html{
        overflow-x: hidden;
      }
    </style>
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
              <ul class="navbar-menu">
                <li class="has-children">
                    <a href="#" aria-haspopup="true" class="nav-link">Brands</a>
                    <ul aria-label="submenu">
                        <li><a href="zara.html">Zara</a></li>
                        <li><a href="dolce.html">Dolce Gabbana</a></li>
                        <li><a href="off.html">Off White</a></li>
                        <li><a href="luis.html">Luis Vuitton</a></li>
                    </ul>    
                </li>
            </ul>
            </li>

            <li class="nav-item">
              <i class="bi bi-bag"></i>
              <i onclick="window.location.href='login.html';" class="bi bi-person-circle"></i>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!--Cart-->
    <section class="cart container my-5 py-5">
      <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr />
      </div>

      <table class="mt-5 pt-5">
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>



        <?php foreach($_SESSION['cart'] as $key => $value) { ?>
          <tr>
    <td>
      <div class="product-info">
        <img src="assests/imgs/<?php echo $value['product_image']; ?>" alt="" />
        <div class="cart-desc">
          <small><p><?php echo $value['product_name'];?></p></small>
          <small><span>$</span><?php echo $value['product_price']; ?></small>
          <br />
          <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
            <input type="submit" name="remove_product" class="remove-btn" value="Remove">
          </form>
        </div>
      </div>
    </td>

    <td>
      <input type="number" value="<?php echo $value['product_quantity']; ?>" min="1" />
      <a href="#" class="edit-btn">Edit</a>
    </td>

    <td>
      <span>$</span>
      <span class="product-price"><?php echo $value['product_price']; ?></span>
    </td>
  </tr>
        
        <?php } ?>
          
      </table>

      <div class="cart-total">
        <table>
            <tr>
                <td>Subtotal</td>
                <td>$199.8</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>$199.8</td>
            </tr>
        </table>
      </div>

      <div class="checkout-container"><button onclick="window.location.href='checkout.html';" class="btn checkout-btn">Checkout</button></div>
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
</body>
</html>
