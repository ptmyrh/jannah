<?php 
    include('index.php'); 
?>

<nav class="subnav">
  <div class="container">
    <a class="tab" href="menu_admin.php">Menu Management</a>
    <a class="tab active" href="order_admin.php">Order Management</a>
    <a class="tab" href="#">Analytics</a>
  </div>
</nav>

<link rel="stylesheet" href="order_admin.css" />

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WebsiteCode - Food Ordering Management System</title>
    <!--<link rel="stylesheet" href="style.css">-->
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'data.php';
            foreach ($orders as $index => $order) {
                echo "<tr>
                    <td>".($index + 1)."</td>
                    <td>{$order['name']}</td>
                    <td>{$order['address']}</td>
                    <td>{$order['email']}</td>
                    <td>{$order['phone']}</td>
                    <td><span class='status {$order['status_class']}'>{$order['status']}</span></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
