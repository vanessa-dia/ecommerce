<div class="bg-light container d-flex flex-row justify-content-between font-Quicksand">
  <div class="my-auto p-1 text-danger">
    <h6 class="my-auto"><i class="fas fa-phone"></i> Hotline: 0838 000 888</h6>
  </div>
  <?php if (isset($_SESSION['user'])) { ?>
    <div class="dropdown show my-auto d-flex flex-row">
      <a class="text-secondary a-btn my-auto mr-2" id="cart">
        <h6 class="my-auto "><i data-count="<? if(isset($_SESSION['slcart'])) echo $_SESSION['slcart']; else echo '0' ?>" class="fas fa-shopping-cart" id='iconcart'></i>Giỏ hàng</h6>
      </a>
      <a class="dropdown-toggle a-btn text-secondary" href="#" data-toggle="dropdown">My Account</a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="<?= $baseUrl ?>/Profile">Profile</a>
        <div class="dropdown-divider"></div>
        <a href="<?= $baseUrl ?>/Profile/signOut" class="dropdown-item">Logout</a>
      </div>
    </div>
  <?php } else { ?>
    <div class="my-auto d-flex flex-row ">
      <a class="text-secondary a-btn d-flex flex-row" id="cart">
        <h6 class="my-auto "><i data-count="<? if(isset($_SESSION['slcart'])) echo $_SESSION['slcart']; else echo '0' ?>" class="fas fa-shopping-cart  position-relative" id="iconcart"></i>Giỏ hàng</h6>
      </a>
      <a class="text-secondary a-btn" id="signin">
        <h6 class="my-auto ml-2"><i class="fas fa-sign-in-alt"></i>Login</h6>
      </a>
      <a class="text-secondary a-btn" id="signup">
        <h6 class="my-auto ml-2"><i class="fas fa-user"></i>Join</h6>
      </a>
    </div>
  <?php } ?>
</div>
<div id="dialog" title="Notice!">
  <p class="text-center"></p>
</div>
<nav class="container navbar navbar-expand-lg navbar-light" id="navbar-header">
  <a class="navbar-brand" href="#"><img src="./asset/img/logo.jpg" alt="" class="img-fluid" id="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?= $activeNav[0] ?>">
        <a class="nav-link" href="<?= $baseUrl ?>/home">Home</a>
      </li>

    </ul>
  </div>
</nav>