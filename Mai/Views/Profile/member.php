<div class="min-vh-100 row p-0 m-0 font-Quicksand">
    <!-- Hồ sơ -->
    <div class="rounded shadow col-sm-3">
        <div class="sticky-top">
            <form id="form-profile" class="">
                <h5 class="text-center">Profile</h5>
                <div class="row p-1">
                    <label for="userName-signin" class="col-sm-4">Full Name</label>
                    <input type="text" class="input-profile form-control-sm border col" id="fullName-profile" name="fullName" value="<?= $_SESSION['user']['fullName'] ?>" disabled>
                </div>
                <div class="row p-1">
                    <label for="userName-signin" class="col-sm-4">Email Address</label>
                    <input type="text" class="input-profile form-control-sm border col" id="email-profile" name="email" value="<?= $_SESSION['user']['email'] ?>" disabled>
                </div>
                <div class="row p-1">
                    <label for="userName-signin" class="col-sm-4">Phone Number</label>
                    <input type="text" class="input-profile form-control-sm border col" id="phone-profile" name="phone" value="<?= $_SESSION['user']['phone'] ?>" disabled>
                </div>
                <div class="row p-1">
                    <label for="userName-signin" class="col-sm-4">Address</label>
                    <input type="text" class="input-profile form-control-sm border col" id="address-profile" name="address" value="<?= $_SESSION['user']['address'] ?>" disabled>
                </div>
                <div class="row p-1">
                    <label for="userName-signin" class="col-sm-4">DOB</label>
                    <input type="text" class="input-profile form-control-sm border col input-date" id="birth-profile" name="birth" value="<?= $_SESSION['user']['birth'] ?>" disabled>
                </div>
            </form>
            <div class="row p-1">
                <div class="ml-auto">
                    <button class="btn btn-sm btn-primary" id="edit-profile">Edit</button>
                    <button class="btn btn-sm btn-success" id="save-profile">Save</button>
                </div>
            </div>

            <hr>
            <h5 class="text-center">Member</h5>
            <div class="nav d-flex flex-column">
                <a href="#listProduct" class="nav-item nav-link nav-admin text-dark border rounded m-2" data-toggle="tab" role="tab" id="nav-listOrders-tab">
                    History <i class="fas fa-store"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="tab-content" id="nav-tabContent">
            <!-- Load sản phẩm -->
            <div class="tab-pane fade show active" role="tabpanel" id="listProduct">
                <div id="product-content" class="row justify-content-center">
                    <div class="col-sm-12 text-center m-3">History</div>
                    <div id="listOrder" class="col-sm-12">
                        <? if (isset($allOrders)) {
                            foreach ($allOrders as $value) {
                                ?>
                                <? require('./Views/Profile/orders.php') ?>
                        <? }
                        } else echo 'Please add product to cart!' ?>
                        <div class="col-sm-12 justify-content-center d-flex">
                            <?php
                            if (isset($allOrders)) {
                                echo '<span>Trang 1</span>';
                                if ($current_page > 1 && $total_page > 1) {
                                    echo '<a href="#" page=' . ($current_page - 1) . ' id="prevPageOrders">--Prev</a> ';
                                }


                                // Lặp khoảng giữa
                                if ($total_page - $current_page > 3) {
                                    echo '<span class="border bg-warning text-info">' . $current_page . '</span> | . . . | <a href="index.php?page=' . $total_page . '">' . $total_page . ' </a>  -- ';
                                }

                                // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                                if ($current_page < $total_page  && $total_page >= 2) {
                                    echo ' <a href="" page=' . $current_page . ' id="nextPageOrders"> Next--</a>  ';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>