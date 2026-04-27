<?php 
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){
    $name = $_POST['item_name'];
    $cat = $_POST['category'];
    $desc = $_POST['description'];
    $loc = $_POST['location'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    $image = "";

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $image = time() . "_" . basename($_FILES['image']['name']);
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "uploads/" . $image);
    }

    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO items 
    (item_name, category, description, location, status, image, date_reported, user_id)
    VALUES ('$name','$cat','$desc','$loc','$status','$image','$date','$user_id')";

    if(mysqli_query($conn, $query)){
        header("Location: index.php");
        exit();
    } else {
        echo "ERROR: " . mysqli_error($conn);
    }
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
