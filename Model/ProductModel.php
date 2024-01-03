<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ProductModel extends Database
{
    public function getProduct($id)
    {
        $product = null;
        if ($id === 'all') {
            $res = $this->select("SELECT id, name, description, price, color, image
            FROM product Where cart = 0");
        } else {
            $res = $this->select("SELECT id, name, description, price, color, image
            FROM product Where id = $id and cart = 0");
        }
        return array(
            "code" => 0,
            "product" => $res
        );
    }

    public function getCart($id)
    {
        $product = null;
        if ($id === 'all') {
            $res = $this->select("SELECT id, name, description, price, color, image
            FROM product Where cart = 1");
        } else {
            $res = $this->select("SELECT id, name, description, price, color, image
            FROM product Where id = $id and cart = 1");
        }
        return array(
            "code" => 0,
            "product" => $res
        );
    }

    public function updateProduct($id)
    {
        if ($id) {
            $this->update("UPDATE product SET cart = 1 Where id = $id");
        }
        return array(
            "code" => 0,
            "message" => 'Update OK'
        );
    }

    public function updateCart($id)
    {
        if ($id) {
            $this->update("UPDATE product SET cart = 0 Where id = $id");
        }
        return array(
            "code" => 0,
            "message" => 'Update OK'
        );
    }
}
