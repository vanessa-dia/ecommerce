<?php
require_once("Base_Model.php");
class Product_Model extends Model
{
    public function addProduct($data = [], $img)
    {
        $nameProduct = $data['nameProduct'];
        $typeProduct = $data['typeProduct'];
        $desProduct = $data['desProduct'];
        $priceProduct = $this->convertPrice($data['priceProduct']);
        $amountProduct = $data['amountProduct'];
        $query = "INSERT INTO product (name,idType,price,amount,description,img) values (
            '$nameProduct','$typeProduct','$priceProduct','$amountProduct','$desProduct','$img'
        )";
        $result = $this->conn->query($query);
        return $result;
    }
    public function addType($name)
    {
        $query = "INSERT into type (name) values ('$name')";
        return $this->conn->query($query);
    }
    public function getAllType()
    {
        $query = "SELECT * from type";
        $array = [];
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array[] = $row;
            }
            return $array;
        } else return false;
    }
    public function getAll()
    {
        $temp = [];
        $query = "SELECT * from product order by id desc";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $temp[] = $row;
            }
            return $temp;
        }
    }
    public function getTypeById($idType)
    {
        $query = "SELECT * from type where id = '$idType' ";
        $result = $this->conn->query($query);
        $result = $result->fetch_assoc();
        return $result['name'];
    }
    public function filterByTypeHome($idType)
    {
        $temp = '';
        if ($idType == 'all') $query = "SELECT * from product";
        else $query = "SELECT * from product where idType = '$idType'";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $all = $result->num_rows;
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                if ($count == 0 || $count % 4 == 0) {
                    $temp .= "<div class='d-flex flex-row'>";
                }
                $temp .= "<div class='col-sm-3 p-1 product-item' id=" . $row['id'] . ">
                            <div class='card h-100 p-2  shadow product'>
                                <div class='overflow-hidden'>
                                    <img src='asset/img/products/" . $row['img'] . "'  class='card-img-top' alt=" . $row['img'] . ">
                                </div>";
                $temp .= "<h6 class='card-title font-weight-bold' >" . $row['name'] . "</h6>";
                $temp .= "<div class='mt-auto'>
                                    <p class='text-left text-danger font-weight-bold'>" .number_format($row['price'],0,'','.'). "</p>
                                        <a class='btn btn-sm  btn-addCart'><span class='ui-icon ui-icon-cart'></span>Thêm vào giỏ</a>
                                </div>
                            </div>
                         </div>";
                $count += 1;
                if ($count == 4 || $row == $all || $count % 4 == 0) {
                    $temp .= "</div>";
                }
            }
            return $temp;
        }
    }
    public function searchProduct($name, $idType)
    {
        if ($name == '') {
            if ($idType == 'all') {
                $query = "SELECT * from product order by id desc";
            } else {
                $query = "SELECT * from product where idType ='$idType' order by id desc";
            }
        } else {
            if ($idType == 'all') {
                $query = "SELECT * from product where name like '%$name%' order by id desc";
            } else $query = "SELECT * from product where idType = '$idType' and name like '%$name%' order by id desc";
        }

        $result = $this->conn->query($query);
        $content = '';
        if ($result->num_rows > 0) {
            ob_start();
            while ($products = $result->fetch_assoc()) {
                include("./Views/Products/listProducts.php");
            }
            $content .= ob_get_clean();
            echo ($content);
        } else {
            echo 'Không có dữ liệu';
        }
    }
    public function deleteProduct($idProduct)
    {
        $query = "DELETE from product where id='$idProduct'";
        return $this->conn->query($query);
    }
    public function getById($id)
    {
        return $this->queryId($id, 'product');
    }
    public function Update($data = [])
    {
        $id = $data['id'];
        $idType = $data['idType'];
        $name = $data['name'];
        $amount = $data['amount'];
        $price = $data['price'];
        $description = $data['description'];
        $query = "UPDATE product SET
        name = '$name' , price = '$price', amount = '$amount', description = '$description', idType = '$idType'
        where id = $id";
        return $this->conn->query($query);
    }
    public function getMoneyById($id){
        $result = $this->getById($id);
        $money = $result['price'];
        return $money;
    }
    public function nameProduct($id){
        $result = $this->getById($id);
        return $result['name'];
    }
    public function convertPrice($str)
    {
        $str = str_replace(",", "", $str);
        $str = str_replace(" Đồng", "", $str);
        return (float) $str;
    }
}
