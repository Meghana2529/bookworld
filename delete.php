<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lib";

$conn = new mysqli($servername, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' parameter exists for deletion
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input
    $sql = "DELETE FROM lib WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Book deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting book.');</script>";
    }
}

// Fetch books from the database
$sql = "SELECT * FROM lib";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url("p6.jpg") no-repeat center center fixed;
            background-size: cover;
            color: white;
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: white;
            text-decoration: underline;
            margin-bottom: 20px;
        }
        .top-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .add-button {
            padding: 8px 16px;
            background-color: #82492B;
            color: white;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        }
        .add-button:hover {
            background-color: #9e5a34;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0, 0.7);
        }
        th, td {
            border: 1px solid white;
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #82492B;
        }
        .buy-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .buy-btn:hover, .delete-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a class="add-button" href="addbook.php">+ Add Book</a>
</div>

<h1>AVAILABLE BOOKS</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Price</th>
        <th>Description</th>
        <th>Buy</th>
        <th>Delete</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['author']}</td>
                    <td>$ {$row['price']}</td>
                    <td>{$row['description']}</td>
                    <td>
                        <a href='buy.html?title=" . urlencode($row['title']) . "'>
                            <button class='buy-btn'>Buy</button>
                        </a>
                    </td>
                    <td>
                        <a href='viewbooks.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this book?');\">
                            <button class='buy-btn delete-btn'>Delete</button>
                        </a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No books available.</td></tr>";
    }

    $conn->close();
    ?>
</table>

</body>
</html>
