<?php 
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $query = "SELECT * FROM items 
              WHERE item_name LIKE '%$search%' 
              OR category LIKE '%$search%' 
              OR location LIKE '%$search%' 
              OR status LIKE '%$search%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM items ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lost and Found System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <div class="topbar">
        <div>
            <h1>Lost and Found Management System</h1>
            <p>Welcome, <?php echo $_SESSION['user']; ?></p>
        </div>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="actions">
        <a href="add.php" class="btn">+ Add Item</a>

        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search item..." value="<?php echo $search; ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <table>
        <tr>
            <th>Image</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Location</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td>
                <?php if($row['image']){ ?>
                    <img src="uploads/<?php echo $row['image']; ?>" class="item-img">
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><span class="status"><?php echo $row['status']; ?></span></td>
            <td><?php echo $row['date_reported']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Delete this item?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>