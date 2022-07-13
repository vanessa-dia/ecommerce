<?php
require_once('Base_Controller.php');
class Profile extends Base
{
    public function __construct()
    {
        $this->folder = "Profile";
        require_once("./Models/Profile_Model.php");
        $this->model = new Profile_Model("account");
    }
    function index()
    {
        if ($_SESSION['user']['permission'] == '1') {
            require_once("./Controllers/Product_Controller.php");
            $product = new Product;
            $allType = $product->getAllType();
            $allProduct = $product->getAll();
            $data['allType'] = $allType;
            $data['allProduct'] = $allProduct;
            $allOrders = $this->model->getOrdersById("'' or 1=1", 1);
            $data['allOrders'] = $allOrders['data'];
            if ($data['allOrders'] === false) {
                foreach ($data['allOrders'] as $key => $value) {
                    $data['allOrders'][$key]['customer'] = $this->model->nameUser($data['allOrders'][$key]['customer']);
                }
            }
            $data['current_page'] = 1;
            $data['total_page'] = $allOrders['total'];
        } else {
            $allOrders = $this->model->getOrdersById($_SESSION['user']['id'], 1);
            if ($allOrders) {
                $data['allOrders'] = $allOrders['data'];
                $data['current_page'] = 1;
                $data['total_page'] = $allOrders['total'];
            }
        }
        $file = 'index';
        $data['title'] = 'Hồ sơ';
        $this->render($file, $data, false);
    }
    function signIn()
    {
        if (isset($_POST)) {
            $userName = $_POST['userName'];
            $psw = md5($_POST['psw']);
        }
        echo $this->model->signIn($userName, $psw);
    }
    public function signOut()
    {
        unset($_SESSION['user']);
        header("Location: " . $this->Base_Url());
    }
    public function signUp()
    {
        echo $this->model->signUp($_POST);
    }
    public function update()
    {
        echo $this->model->update($_POST);
    }
    public function nextOrders()
    {
        $cur = $_GET['current'];
        $result = $this->model->nextOrders($cur + 1);
        if ($result == 400){
            echo 'Chưa có dữ liệu';
            return;
        }
        $data = $result['data'];
        ob_start();
        if ($_SESSION['user']['permission'] == '1') {
            echo '<h5 class="text-center">Hóa đơn khách hàng</h5>';
        }
        foreach ($data as $key => $value) {
            if ($_SESSION['user']['permission'] == '1') {
                $value['customer'] = $this->model->nameUser($data[$key]['customer']);
                include('./Views/Profile/ordersAdmin.php');
            } else include('./Views/Profile/Orders.php');
        }
        echo '<div class="col-sm-12 justify-content-center d-flex">';
        $current_page = $result['current'];
        $total_page = $result['total'];
        if ($current_page > 1 && $total_page > 1) {
            echo '<a href="" page=' . ($current_page - 2) . ' id="prevPageOrders">--Prev</a> ';
        }
        if ($total_page - $current_page > 3) {
            echo '<span class="border bg-warning text-info">' . $current_page . '</span> | . . . | <a href="index.php?page=' . $total_page . '">' . $total_page . ' </a>  -- ';
        }

        if ($current_page < $total_page && $total_page > 1) {
            echo ' <a href="" page=' . $current_page . ' id="nextPageOrders"' . ($current_page + 1) . '> Next--</a>  ';
        }
        echo '</div>';
        $content = ob_get_clean();
        echo $content;
    }
    public function orderDetail()
    {
        $result =  $this->model->orderDetail($_GET['id']);
        require_once('./Models/Product_Model.php');
        $product = new Product_Model('');
        ob_start();
        echo '<button class="btn btn-primary m-2" id="backListOrder"><i class="fas fa-arrow-left"></i>   Quay lại</button>';
        echo '<table class="table table-pink text-center">
        <thead>
            <tr class="d-flex flex-row">
                <th class="col-sm-1">#</th>
                <th class="col">Tên sản phẩm</th>
                <th class="col">Số lượng</th>
                <th class="col">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>';
        $count = 1;
        foreach ($result as $key => $cart) {
            $cart['idProduct'] = $product->nameProduct($cart['idProduct']);
            include('./Views/Profile/detailOrder.php');
        }
        echo '   </tbody>
        </table>';
        $content = ob_get_clean();
        echo $content;
    }
}
