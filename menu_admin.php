<?php

include 'config.php';
include ('index.php');

if(isset($_POST['add_item'])){

   $item_name = $_POST['item_name'];
   $description = $_POST['description'];
   $item_price = $_POST['item_price'];
   $item_image = $_FILES['item_image']['name'];
   $item_image_tmp_name = $_FILES['item_image']['tmp_name'];
   $item_image_folder = 'uploaded_img/'.$item_image;

   if(empty($item_name) || empty($description) || empty($item_price) || empty($item_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO items(name, description, price, image) VALUES('$item_name', '$description', '$item_price', '$item_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($item_image_tmp_name, $item_image_folder);
         $message[] = 'new item added successfully';
      }else{
         $message[] = 'could not add the item';
      };
   };

};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM items WHERE id = $delete_id") or die('query failed');
   if($delete_query){
    //header('location:menu_admin.php');
    $message[] = 'item has been deleted';
   }else{
    //header('location:menu_admin.php');
    $message[] = 'item could not be deleted';
   }
};

?>

<nav class="subnav">
    <div class="container">
        <a class="tab active" href="#">Menu Management</a>
        <a class="tab" href="order_admin.php">Order Management</a>
        <a class="tab" href="#">Analytics</a>
    </div>
</nav>

<link rel="stylesheet" href="style.css" />


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new item</h3>
         <input type="text" placeholder="enter item name" name="item_name" class="box">
         <input type="text" placeholder="enter description" name="description" class="box">
         <input type="number" placeholder="enter item price" name="item_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="item_image" class="box">
         <input type="submit" class="btn" name="add_item" value="add item">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM items");
   
   ?>
   <div class="item-display">
      <table class="item-display-table">
         <thead>
         <tr>
            <th>item image</th>
            <th>item name</th>
            <th>description</th>
            <th>item price</th>
            <th>action</th>
         </tr>
         </thead>
         <?php 
            while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>RM <?php echo $row['price']; ?></td>
            <td>
               
               <a href="menu_admin.php?edit=<?php echo $row['id']; ?>" class="btn"> <i 
               class="fas fa-edit"></i> edit </a>
                
               <a href="menu_admin.php?delete=<?php echo $row['id']; ?>" class="btn" 
               onclick="return confirm ('are you sure you want to delete this?');"> <i 
               class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
         <?php } ?> <!--close while loop!-->
      </table>
   </div>

   <?php if(isset($_GET['edit'])) : ?>
   <div class="edit-form-container">
        <?php
            $edit_id=$_GET['edit'];
            $edit_query=mysqli_query($conn,"SELECT * FROM items WHERE id = $edit_id");
            
            if(mysqli_num_rows($edit_query) >0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        ?>
                     <form action="" method="post" enctype="multipart/form-data"> 
                        <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt=""> 
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                        <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                        <input type="number" min="0" class="box" required name="update_p_price" 
                        value="<?php echo $fetch_edit['price']; ?>">
                        <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                        <input type="submit" value="update item" name="update_product" class="btn">
                        <input type="reset" value="cancel" id="close-edit" class="option-btn">
                    </form>
        <?php
                }; //close while
            } //close inner if
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</
            script>";

        ?>

   </div>
   <?php endif;?>
</div>
</body>
</html>