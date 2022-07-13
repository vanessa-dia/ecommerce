<?php
require_once('Base_Controller.php');
class Product extends Base
{
    public function __construct()
    {
        $this->folder = "Products";
        require_once("./Models/Product_Model.php");
        $this->model = new Product_Model("");
    }
    public function index()
    {
        $file = 'detailProduct';
        $data['title'] = 'Cửa hàng';
        var_dump($data);
        $this->render($file, $data, true);
    }
    public function getById()
    {
        $id = $_GET['id'];
        $product = $this->model->getById($id);
        $product['type'] = $this->model->getTypeById($product['idType']);
        ob_start();
        include_once('./Views/Products/detailProduct.php');
        $content = ob_get_clean();
        echo $content;
    }
    public function productById()
    {
        $id = $_GET['id'];
        $product = $this->model->getById($id);
        $product['type'] = $this->model->getTypeById($product['idType']);
        echo json_encode($product);
    }
    public function addProduct()
    {
        $img = "";
        if (0 < $_FILES['imgProduct']['error']) {
            echo 'Error: ' . $_FILES['imgProduct']['error'] . '<br>';
        } else {
            $img = basename($_FILES['imgProduct']['name']);
            move_uploaded_file($_FILES['imgProduct']['tmp_name'], 'asset/img/products/' . $img);
        }
        if (isset($_POST)) {
            echo $this->model->addProduct($_POST, $img);
        }
    }

    public function getAll()
    {
        return $this->model->getAll();
    }
    public function addType()
    {
        $nameType = $_POST['typeProduct'];
        echo $this->model->addType($nameType);
    }
    public function getAllType()
    {
        return $this->model->getAllType();
    }
    public function filterByType()
    {
        echo $this->model->searchProduct('', $_GET['idType']);
    }
    public function filterByTypeHome()
    {
        echo $this->model->filterByTypeHome($_GET['idType']);
    }
    public function deleteProduct()
    {
        echo $this->model->deleteProduct($_GET['idProduct']);
    }
    public function Update()
    {
        echo $this->model->Update($_GET);
    }
    public function loadToEdit()
    {
        $id = $_GET['id'];
        $product = $this->model->getById($id);
        echo json_encode($product);
    }
    public function searchProduct()
    {
        $name = $_GET['name'];
        $idType = $_GET['idType'];
        echo $this->model->searchProduct($name, $idType);
    }
}
