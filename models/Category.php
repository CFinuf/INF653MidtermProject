<?php
class Category {
  private $conn;
  private $table = 'categories';

  public $id;
  public $category;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function read() {
    $query = 'SELECT * FROM ' . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' SET category = :category';
    $stmt = $this->conn->prepare($query);
    $this->category = htmlspecialchars(strip_tags($this->category));
    $stmt->bindParam(':category', $this->category);
    if($stmt->execute()) {
      return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  public function update() {
    $query = 'UPDATE ' . $this->table . ' SET category = :category WHERE id = :id';
    $stmt = $this->conn->prepare($query);
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':id', $this->id);
    if($stmt->execute()) {
      return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  public function delete() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    $stmt = $this->conn->prepare($query);
    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':id', $this->id);
    if($stmt->execute()) {
      return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;
  }
}
?>
