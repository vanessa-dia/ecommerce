<?php
require_once('Base_Controller.php');
require_once('./Models/Profile_Model.php');
class Home extends Base
{
    public function __construct()
    {
        $this->folder = "Home";
        // require_once("./Models/Home_Model.php");
        // $this->model = new Home_Model("account");
    }
    public function Index()
    {
        $file = 'index';
        require_once("./Controllers/Product_Controller.php");
        $product = new Product;
        $allProduct = $product->getAll();
        $allType = $product->getAllType();
        $data['allProduct'] = $allProduct;
        $data['allType'] = $allType;
        $data['title'] = 'Trang chủ';
        $data['activeNav'] = ["active", "", ""];
        $this->render($file, $data, true);
    }
    public function login()
    {
        ob_start(); //mở bộ đệm output
        require_once("./Views/Home/" . $_GET['request'] . ".php");
        $content = ob_get_clean(); // lấy nội dung trong bộ đệm và đóng bộ đệm
        echo $content;
    }
    public function signIn()
    {
        ob_start(); //mở bộ đệm output
        require_once("./Views/Home/signin.php");
        $content = ob_get_clean(); // lấy nội dung trong bộ đệm và đóng bộ đệm
        echo $content;
    }
    public function signOut()
    {
        unset($_SESSION['user']);
        header("Location: " . $this->Base_Url());
    }
    public function signUp()
    {
        ob_start(); //mở bộ đệm output
        require_once("./Views/Home/signup.php");
        $content = ob_get_clean(); // lấy nội dung trong bộ đệm và đóng bộ đệm
        echo $content;
    }
    public function newUser()
    {
        if (isset($_POST)) {
            $data = $_POST;
            echo $this->model->signUp($data);
        }
    }
    public function addCart()
    {
        $data = $_POST;
        if (isset($_SESSION['cart'])) {
            $index = count($_SESSION['cart']);
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['id'] == $data['id']){
                    $_SESSION['cart'][$key]['amount'] += 1;
                    $_SESSION['slcart'] += 1;
                    echo $_SESSION['slcart'];
                    return;
                }
            }
            $_SESSION['cart'][$index] = $data;
            $_SESSION['slcart'] += 1;
            
        } else {
            $_SESSION['cart'][0] = $data;
            $_SESSION['slcart'] = 1;
        }
        echo $_SESSION['slcart'];
    }
    public function delItemCart()
    {
        $id = $_GET['id'];
        $arr = [];
        $amount = 0;
        foreach ($_SESSION['cart'] as $key => $val) {
            if ($key != $id) {
                $arr[] = $val;
            } else {
                $amount = $val['amount'];
            }
        }
        $_SESSION['cart'] = $arr;
        $_SESSION['slcart'] = $_SESSION['slcart'] - $amount;
        echo $_SESSION['slcart'];
    }
    public function updateCart(){
        $id = $_GET['id'];
        $money = $_GET['money'];
        $amount = $_GET['amount'];
        $_SESSION['slcart'] = $_SESSION['slcart'] + ($amount - $_SESSION['cart'][$id]['amount']);
        $_SESSION['cart'][$id]['money'] = $money;
        $_SESSION['cart'][$id]['amount'] =(int)$amount;
        echo $_SESSION['slcart'];
    }
    public function checkOut(){
        if (!isset($_SESSION['user'])){
            echo '201';
            return;
        }
        $profile = new Profile_Model('');
        $check = $profile->checkInfo();
        if ($check == true) {
            echo '202';
            return;
        } else echo '200';
    }
    public function thanhtoan(){
        $_SESSION['slcart'] = 0;
        $profile = new Profile_Model('');
        echo $profile->thanhtoan($_POST);
    }
}
