<? if (!isset($product)) echo '<h5 class="container font-Quicksand">Please add product to cart</h5>'; else { ?>
    <div class="mx-auto row">
    <div class="col-sm-3">
        <img src="./asset/img/products/<?= $product['img'] ?>" alt="" class="img-fluid border shadow-sm">
    </div>
    <div class="col">
        <h5>Name: <?= $product['name'] ?></h5>
        <p class="text-danger">Price: <?= $product['price'] ?></p>
        <p>Quantity: <?= $product['amount'] ?></p>
        <p>Description: <?= $product['description'] ?></p>
        <p>Type: <?= $product['type'] ?></p>
        <button class="btn btn-secondary" id="backListProducts">Back</button>
    </div>
</div>
<? }?>