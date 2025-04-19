<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lib";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is passed in the URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Fetch book details from the database based on the ID
    $sql = "SELECT * FROM lib";  // Fixed the query syntax
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
} else {
    // If no ID is passed, redirect to the search page
    header("Location: search.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Detail</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <header>
        <h1>BOOK DETAILS</h1>
        <a href="search.php">
            <button class="back">BACK TO SEARCH</button>
        </a>
    </header>

    <div class="book-detail">
        <img src="<?php echo $book['image']; ?>" alt="Book Image" style="width:300px;height:400px;">
        <h2><?php echo $book['title']; ?></h2>
        <h3>By <?php echo $book['author']; ?></h3>
        <p><strong>Price:</strong> $<?php echo $book['price']; ?></p>
        <p><strong>Description:</strong> <?php echo $book['description']; ?></p> <!-- Add description here if you have it in your database -->

        <!-- Buy Now button -->
        <a href="buy.html"><button class="buy-1">BUY NOW</button></a>
    </div>

</body>
</html>

<?php
$conn->close();
?>
