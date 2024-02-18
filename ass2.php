<?php
header('Content-type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header('Access-Control-Max-Age: 3600');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class BookManager {
    public $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'books');
    }

    public function insertBook() {
       
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return json_encode([
                'message' => 'Invalid request method',
                'code' => 405,
            ]);
        }

       
        $data = json_decode(file_get_contents("php://input"), true);

        $title = $data['title'];
        $bookAuthor = $data['book_author'];
        $pages = $data['pages'];
        $price = $data['price'];

        $isInserted = $this->conn->query("INSERT INTO books (title, book_author, pages, price)
            values ('$title', '$bookAuthor', '$pages', '$price')");

        if ($isInserted) {
            $id = $this->conn->insert_id;
            $row = $this->conn->query("SELECT * FROM books where id = $id");
            $response = $row->fetch_assoc();

            return json_encode($response);
        } else {
            return json_encode([
                'message' => 'Failed to insert data',
                'code' => 404,
            ]);
        }
    }
}


$bookManager = new BookManager();
echo $bookManager->insertBook();
?>
