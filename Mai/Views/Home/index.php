<div class="container bg-light p-2" id="content">
    <div class="d-flex flex-row">
        <div class="col-sm-2">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded flex-column">
                <p class="navbar-brand">Category</p>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#homeProduct">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="homeProduct" class="collapse navbar-collapse">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item" id="all"><a class="nav-link filterProductHome">All</a></li>
                        <? foreach ($allType as $val) { ?>
                            <li class="nav-item" id="<?= $val['id'] ?>"><a class="nav-link filterProductHome"><?= $val['name'] ?></a></li>
                        <? } ?>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col">
            <div id="product-content">
                <div class="row">

                    <? foreach ($allProduct as $val) { ?>
                        <div class="col-sm-3 p-1 product-item" id="<?= $val['id'] ?>">
                            <div class="card h-100 p-2  shadow product">
                                <div class="itemHome">
                                    <div class="overflow-hidden">
                                        <img src="asset/img/products/<?= $val['img'] ?>" class="card-img-top product-img">
                                    </div>
                                    <h6 class="card-title font-weight-bold product-name"><?= $val['name'] ?></h6>
                                </div>
                                <div class="mt-auto">
                                    <p class="text-left text-danger font-weight-bold product-price"><?= number_format($val['price'], 0, ",", ".") ?></p>
                                    <a class="btn btn-sm btn-addCart"><span class="ui-icon ui-icon-cart"></span>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>