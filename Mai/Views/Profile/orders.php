<div class="col-sm-6 bg-info rounded m-2 d-flex mx-auto p-2 orderDetail" id='<?= $value['id']?>'>
    <p class="col-sm-6 mr-2 my-auto text-warning">Date: <span class="font-weight-bold text-white"><?= $value['created'] ?></span></p>
    <p class="col-sm-6 my-auto text-warning">Total <span class="font-weight-bold text-white"><?= number_format($value['totalMoney'], 0, '', '.') ?></span></p>
</div>
