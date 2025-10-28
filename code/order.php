<?php
class Order {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function add($name, $amount, $food, $add_sauce, $type_delivery){
        $stmt = $this->pdo->prepare(
            "INSERT INTO orders (name,amount,food,add_sauce, type_delivery) VALUES (?,?,?,?,?)");
        $stmt->execute([$name, $amount, $food, $add_sauce, $type_delivery]);
    }

    public function getAll(){
        $stmt = $this->pdo->query("SELECT * FROM orders");
        return $stmt->fetchAll();
    }

    public function update($id, $name){
        $stmt = $this->pdo->prepare("UPDATE oreders SET name=? WHERE id=?");
        $stmt->execute([$id, $name]);
    }

    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM oreders WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>