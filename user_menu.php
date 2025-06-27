<?php 
    include ('index.php'); 
    include ('config.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user menu</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>

<?php
//display message if exit
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<div class="menu-container">
    <h1 class ="heading">MENU</h1>

    <!-- Search Bar -->
    <form action="" method="GET">
        <section class="search-section">
            <div class="search-container">
                <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>" placeholder="Search">
                <button type="submit "class="search-btn" >Search</button>
            </div>
        </section>
    </form>

    <!--display menu to user!-->
    <div class="container">
        <section class="items">
            <div class="box-container">

            <?php
            $select_item = mysqli_query($conn, "SELECT * FROM items");
            if(mysqli_num_rows($select_item) > 0){
                while($fetch_item = mysqli_fetch_assoc($select_item)){
            ?>
                <form action="" method="post">
                    <div class="box">
                        <img src="uploaded_img/<?php echo $fetch_item['image']; ?>" alt="">
                        <h3><?php echo $fetch_item['name']; ?></h3>
                        <div class="price">RM<?php echo $fetch_item['price']; ?></div>
                        <div class="desc"><?php echo $fetch_item['description']; ?></div>
                        <input type="hidden" name="item_name" value="<?php echo $fetch_item['name']; ?>">
                        <input type="hidden" name="description" value="<?php echo $fetch_item['description']; ?>">
                        <input type="hidden" name="item_price" value="<?php echo $fetch_item['price']; ?>">
                        <input type="hidden" name="item_image" value="<?php echo $fetch_item['image']; ?>">
                        <input type="submit" class="btn" value="add to cart" name="add_to_cart" href="cart.php">
                    </div>
                </form>
            <?php
                };
            };
            ?>

            </div>
        <section>
    </div>
</div>

<body>
<html>