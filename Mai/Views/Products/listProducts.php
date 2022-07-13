<div class='col-sm-2 p-1 product-item' id="<?= $products['id'] ?>">
    <div class='card h-100 p-2  shadow product'>
        <div class="item">
            <div class='overflow-hidden'>
                <img src='asset/img/products/<?= $products['img'] ?>' class='card-img-top'>
            </div>
            <h6 class='card-title font-weight-bold'><?= $products['name'] ?> </h6>
        </div>
        <div class='mt-auto'>
            <p class='text-left text-danger font-weight-bold'><?= number_format($products['price'], 0, ',', '.') ?></p>
            <a class='btn btn-sm btn-secondary btn-deleteProduct'><span class='ui-icon ui-icon-trash'></span>Delete</a>
            <a class='btn btn-sm btn-primary text-white btn-editProduct'><span class='ui-icon ui-icon-pencil'></span>Edit</a>
        </div>
    </div>
</div>