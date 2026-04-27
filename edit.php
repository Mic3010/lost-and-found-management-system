<?php 
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM items WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){
    $name = $_POST['item_name'];
    $cat = $_POST['category'];
    $desc = $_POST['description'];
    $loc = $_POST['location'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    $image = $row['image'];

    if($_FILES['image']['name'] != ""){
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "uploads/" . $image);
    }

    mysqli_query($conn, "UPDATE items SET 
    item_name='$name',
    category='$cat',
    description='$desc',
    location='$loc',
    status='$status',
    image='$image',
    date_reported='$date'
    WHERE id=$id");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Item</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">
<h2>Edit Item</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Item Name</label>
    <input type="text" name="item_name" value="<?php echo $row['item_name']; ?>" required>

    <label>Category</label>
    <input type="text" name="category" value="<?php echo $row['category']; ?>" required>

    <label>Description</label>
    <textarea name="description"><?php echo $row['description']; ?></textarea>

    <label>Location</label>
    <input type="text" name="location" value="<?php echo $row['location']; ?>" required>

    <label>Status</label>
    <select name="status">
        <option <?php if($row['status']=="Lost") echo "selected"; ?>>Lost</option>
        <option <?php if($row['status']=="Found") echo "selected"; ?>>Found</option>
        <option <?php if($row['status']=="Claimed") echo "selected"; ?>>Claimed</option>
    </select>

    <label>Current Image</label><br>
    <?php if($row['image']){ ?>
        <img src="uploads/<?php echo $row['image']; ?>" class="preview-img">
    <?php } else { ?>
        <p>No image uploaded.</p>
    <?php } ?>

    <label>Change Image</label>
    <input type="file" name="image">

    <label>Date Reported</label>
    <input type="date" name="date" value="<?php echo $row['date_reported']; ?>" required>

    <button name="update">Update Item</button>
    <a href="index.php" class="back">Back</a>
</form>

</div>

</body>
</html>