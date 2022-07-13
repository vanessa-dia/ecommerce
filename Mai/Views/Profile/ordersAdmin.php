<div class="col-sm-8 bg-info rounded m-2 d-flex flex-column mx-auto p-2 orderDetail" id='<?= $value['id'] ?>'>
    <div class="d-flex flex-row col-sm-12">
        <p class="col-sm-5 mr-2 my-auto text-warning">Date: <span class="font-weight-bold text-white"><?= $value['created'] ?></span></p>
        <p class="col-sm-4 my-auto text-white">Customer: <?= $value['customer'] ?></p>
        <p class="col-sm-3 my-auto text-warning">Total <span class="font-weight-bold text-white"><?= number_format($value['totalMoney'], 0, '', '.') ?></span></p>
    </div>
    <div class="d-flex flex-row col-sm-12">
        <p class="col-sm-5 mr-2 my-auto text-warning">Full Name: <span class="font-weight-bold text-white"><?= $value['fullName'] ?></span></p>
        <p class="col-sm-5 mr-2 my-auto text-warning">Phone Number: <span class="font-weight-bold text-white"><?= $value['phone'] ?></span></p>
    </div>
    <div class="d-flex flex-row col-sm-12">
        <p class="col-sm-5 mr-2 my-auto text-warning">Address: <span class="font-weight-bold text-white"><?= $value['address'] ?></span></p>
    </div>
</div>