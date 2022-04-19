<?php
class Users
{
    private $name;
    private $phoneNumber;
    private $birthday;
    public function __construct($name, $phoneNumber, $birthday)
    {
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->birthday = $birthday;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    public function getBirthday()
    {
        return $this->birthday;
    }
    public static function readPage($page, $limit)
    {
        $page = (int)$page;
        $limit = (int)$limit;
        $sql = "select * from users";
        $count = count(executeResult($sql)); //54
        $totalRow = ceil($count / $limit);
        if ($page > $totalRow) {
            $page = 1;
        };
        $from = ($page - 1) * $limit;
        $sql = "select * from users limit $from,$limit";
        $data = executeResult($sql);
        $dataRes = array("data" => $data, "pagination" => array("page" => $page, "limit" => $limit, "totalRow" => $totalRow));
        return $dataRes;
    }
    public static function readAll()
    {
        $sql = "SELECT * FROM users";

        $data = executeResult($sql);
        $dataRes = array("data" => $data);
        return $dataRes;
    }
    public static function readItem($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM users where id = $id";
        $dataRes = executeResult($sql, true);
        return $dataRes;
    }
    public function createItem()
    {
        $name = $this->getName();
        $phoneNumber = $this->getPhoneNumber();
        $birthday = $this->getBirthday();
        $sql = "INSERT INTO users (name,phoneNumber,birthday) VALUES ('$name', '$phoneNumber', '$birthday');";
        execute($sql);
    }
    public function updateItem($id)
    {
        if ($id) {
            $sql = "select * from users where id = $id";
            $dataRes = executeResult($sql, true);
            if ($dataRes) {
                $name = $this->getName();
                $phoneNumber = $this->getPhoneNumber();
                $birthday = $this->getBirthday();
                $sql = "UPDATE users SET name='$name', phoneNumber='$phoneNumber',birthday='$birthday' WHERE id=$id";
                execute($sql);
            }
        }
    }
    public function deleteItem($id){
        $sql= "DELETE  FROM users WHERE id=$id;";
        execute($sql);
    }
}
