<!DOCTYPE html>
<html>
<head>
    <title>Buy</title>
    <style>
        * { margin: 0; padding: 0; }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background: url("p6.jpg") no-repeat;
            background-size: cover;
            height: 100vh;
        }
        form {
            width: 300px;
            background: #82492B;
            margin-top: 60px;
            padding: 40px;
            border-radius: 15px;
        }
        td {
            font-size: 15px;
            padding: 10px;
            color: white;
        }
        h1 {
            text-align: center;
            font-family: Lucida Fax;
            text-decoration: underline;
            margin-bottom: 20px;
            color: white;
        }
        td input, td textarea {
            height: 30px;
            width: 200px;
            border: none;
            border-radius: 5px;
            padding: 5px;
        }
        .btn {
            height: 40px;
            width: 90px;
            margin-top: 20px;
            margin-left: 100px;
            border-radius: 10px;
            cursor: pointer;
            border: none;
            background-color: #ffffff;
        }
        .btn:hover {
            background: url("p6.jpg") no-repeat;
            background-size: cover;
            color: white;
            border: 1px solid white;
        }
        label { color: black; }
        textarea { resize: none; }
    </style>
</head>
<body>
    <div class="add">
        <form method="POST" action="">
            <h1>ADD YOURS</h1>
            <table>
                <tr>
                    <td><label>ID:</label></td>
                    <td><input type="number" name="id" placeholder="Enter ID" required></td>
                </tr>
                <tr>
                    <td><label>Title:</label></td>
                    <td><textarea id="title" name="title" placeholder="Enter title" rows="2" cols="25" required></textarea></td>
                </tr>
                <tr>
                    <td><label>Author:</label></td>
                    <td><input id="author" name="author" type="text" placeholder="Enter author" required></td>
                </tr>
                <tr>
                    <td><label>Price:</label></td>
                    <td><input id="price" name="price" type="number" placeholder="Enter price" required></td>
                </tr>
                <tr>
                    <td><label>Description:</label></td>
                    <td><textarea id="description" name="description" placeholder="Enter book description" rows="4" cols="25" required></textarea></td>
                </tr>
            </table>
            <button type="submit" class="btn" name="btn">Add</button>
        </form>
    </div>

<?php
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "lib";
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['btn'])) {
     $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $description = $_POST['description'];

     $stmt = $conn->prepare("INSERT INTO lib (id, title, author, price, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issds", $id, $title, $author, $price, $description); 
    if ($stmt->execute()) {
        echo "<script>alert('Your book has been added successfully!');</script>";
        echo "<script>window.location.href = 'viewbooks.php';</script>";
    } else {
        echo "<script>alert('Failed to add book. ID may already exist.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
