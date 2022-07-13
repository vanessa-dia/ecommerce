
    <div class="border rounded col-sm-6 mx-auto p-2">
        <form id="formTinhTien">
            <h5 class="text-center">Enter your delivery information</h5>
            <div class="form-group">
                <label for="userName-signin">Name</label>
                <input type="text" class="form-control inputCheckOut" name="fullName" value="<?= $_SESSION['user']['fullName'] ?>">
            </div>
            <div class="form-group">
                <label for="userName-signin">Address</label>
                <input type="text" class="form-control inputCheckOut" name="address" value="<?= $_SESSION['user']['address'] ?>">
            </div>
            <div class="form-group">
                <label for="userName-signin">Phone Number</label>
                <input type="text" class="form-control inputCheckOut" name="phone" value="<?= $_SESSION['user']['phone'] ?>">
            </div>
        </form>
        <div class="d-flex flex-row">
            <button class="btn btn-orange ml-auto" id="thanhtoan">Payment</button>
        </div>
    </div>