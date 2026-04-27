<?php 
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

if(isset($_POST['submit'])){
    $name = $_POST['item_name'];
    $cat = $_POST['category'];
    $desc = $_POST['description'];
    $loc = $_POST['location'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if($image != ""){
        move_uploaded_file($tmp, "uploads/" . $image);
    }

    mysqli_query($conn, "INSERT INTO items 
    (item_name, category, description, location, status, image, date_reported)
    VALUES ('$name','$cat','$desc','$loc','$status','$image','$date')");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">
<h2>Add Lost or Found Item</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Item Name</label>
    <input type="text" name="item_name" required>

    <label>Category</label>
    <select name="category" required>
    <option value="">Select Category</option>
    <option>Electronics</option>
    <option>Documents</option>
    <option>Clothing</option>
    <option>Accessories</option>
    <option>Others</option>
</select>

    <label>Description</label>
    <textarea name="description"></textarea>

    <label>Location</label>
    <input type="text" name="location" required>

    <label>Status</label>
    <select name="status">
        <option>Lost</option>
        <option>Found</option>
        <option>Claimed</option>
    </select>

    <label>Upload Image</label>
    <input type="file" name="image">

    <label>Date Reported</label>
    <input type="date" name="date" required>

    <button name="submit">Save Item</button>
    <a href="index.php" class="back">Back</a>
</form>

</div>

</body>
</html>