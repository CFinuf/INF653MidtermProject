<?php
class Author {
  private $conn;
  private $table = 'authors';

  public $id;
  public $author;

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
    $query = 'INSERT INTO ' . $this->table . ' SET author = :author';
    $stmt = $this->conn->prepare($query);
    $this->author = htmlspecialchars(strip_tags($this->author));
    $stmt->bindParam(':author', $this->author);
    if($stmt->execute()) {
      return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  public function update() {
    $query = 'UPDATE ' . $this->table . ' SET author = :author WHERE id = :id';
    $stmt = $this->conn->prepare($query);
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':author', $this->author);
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
