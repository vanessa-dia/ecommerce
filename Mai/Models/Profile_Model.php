<?php
require_once("Base_Model.php");
class Profile_Model extends Model
{

    public function signIn($userName, $psw)
    {
        // lấy thông tin người dung từ database
        // tạo câu truy vấn
        $query = "SELECT * from account where userName = '$userName' and psw = '$psw'";
        // thực hiện câu truy vấn
        $result = $this->conn->query($query);
        // kiế m tra câu truy vấn đã thực hiện
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user'] = [
                'id' => $row['id'],
                'userName' => $row['userName'],
                'fullName' => $row['fullName'],
                'birth' => $this->formatDate($row['birth']),
                'phone' => $row['phone'],
                'email' => $row['email'],
                'address' => $row['address'],
                'permission' => $row['permission']
            ];
            return true;
        } else {
            return false;
        }
    }
    public function formatDate($date)
    {
        if ($date == NULL) {
            return $date;
        }
        return date('d-m-Y', strtotime($date));
    }
    public function select($column, $value)
    {
        $table = $this->table;
        $query = "SELECT * from $table where $column = '$value'";
        return $this->conn->query($query);
    }
    public function signUp($data = [])
    {
        foreach ($data as $value) {
            if ($value == '') return '402';
        }
        if ($data['psw'] != $data['psw2']) return '401';
        $userName = $data['userName'];
        $psw = md5($data['psw']);
        // Check exist userName
        $checkUserName = $this->select("userName", $userName);
        if ($checkUserName->num_rows > 0) {
            return '400';
        }
        $query = "INSERT INTO account (userName,psw) values ('$userName', '$psw')";
        return $this->conn->query($query);
    }
    public function update($data = [])
    {
        $id = $_SESSION['user']['id'];
        $fullName = $data['fullName'];
        $phone = $data['phone'];
        $email = $data['email'];
        $address = $data['address'];
        $birth = $this->convertDate($data['birth']);
        $query = "UPDATE account
        SET fullName = '$fullName', address = '$address', phone = '$phone', email = '$email', birth = '$birth'
        Where id = $id
        ";
        $result = $this->conn->query($query);
        if ($result) {
            $userName = $_SESSION['user']['userName'];
            $permission = $_SESSION['user']['permission'];
            $_SESSION['user'] = [
                'id' => $id,
                'userName' => $userName,
                'fullName' => $fullName,
                'birth' => $data['birth'],
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'permission' => $permission
            ];
            return $result;
        }
        return mysqli_error($this->conn);
    }

    public function convertDate($date)
    {
        return date('Y/m/d', strtotime($date));
    }
    public function checkInfo()
    {
        $check = false;
        $id = $_SESSION['user']['id'];
        $query = "SELECT * from account where id = '$id' ";
        $result = $this->conn->query($query);
        $user = $result->fetch_assoc();
        $infoRequire = ['fullName', 'address', 'phone'];
        foreach ($user as $key => $value) {
            if (in_array($key, $infoRequire) && $value == '') {
                $check = true;
            }
        }
        return $check;
    }
    public function thanhtoan($data)
    {
        $size = count($_SESSION['cart']);
        $checkQuery = 0;
        $customer = $_SESSION['user']['id'];
        $address = $data['address'];
        $phone = $data['phone'];
        $fullName = $data['fullName'];
        $totalMoney = $data['totalMoney'];
        $query = "INSERT INTO orders (customer,address, phone, fullName, totalMoney) values ('$customer', '$address', '$phone', '$fullName', '$totalMoney')";
        $result = $this->conn->query($query);
        if ($result === true) {
            $lastId = $this->conn->insert_id;
            $count = 0;
            while ($count < $size) {
                $idProduct = $_SESSION['cart'][$count]['id'];
                $amount = (int) $_SESSION['cart'][$count]['amount'];
                $money = $_SESSION['cart'][$count]['money'];
                $money = str_replace('.', '', $money);
                $money = (int) $money;
                $insert = "INSERT INTO detailorder (idOrder, idProduct, amount, money) values ('$lastId', '$idProduct', '$amount', '$money')";
                if ($this->conn->query($insert) == true) {
                    $checkQuery += 1;
                }
                $count += 1;
            }
            if ($checkQuery == $size) {
                unset($_SESSION['cart']);
                return '1';
            };
        }
        return $this->conn->error;
    }
    public function nextOrders($cur)
    {
        if ($_SESSION['user']['permission'] == '1') return $this->getOrdersById("'' or 1=1", $cur);
        return $this->getOrdersById($_SESSION['user']['id'], $cur);
    }
    public function getOrdersById($idUser, $current_page)
    {
        $total_records = "select count(id) as total from orders";
        $result = $this->conn->query($total_records);
        $result = $result->fetch_assoc();
        $total_records = $result['total'];
        $limit = 10;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $query = "SELECT * from orders where customer = $idUser  order by id desc LIMIT $start, $limit ;";
        $result = $this->conn->query($query);
        if ($result !== false) {
            if ($result->num_rows > 0) {
                $temp = [];
                while ($row = $result->fetch_assoc()) {
                    $temp[] = $row;
                }
                $data = [
                    'data' => $temp,
                    'current' => $current_page,
                    'total' => $total_page,
                ];
                return $data;
            }
        } else {
            return 400;
        }
    }
    public function orderDetail($id)
    {
        $query = "SELECT * from detailorder where idOrder = $id";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $temp = [];
            while ($row = $result->fetch_assoc()) {
                $temp[] = $row;
            }
            return $temp;
        } else {
            return 'Không có dữ liệu';
        }
    }
    public function nameUser($id)
    {
        $result = $this->queryId($id, 'account');
        return $result['userName'];
    }
}
