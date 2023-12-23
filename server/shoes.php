<?php

include("connection.php");

$stmt = $conn->prepare("SELECT * FROM products where product_category='Shoes' except SELECT * FROM products where product_id='1' LIMIT 4");

$stmt->execute();

$get = $stmt->get_result();

?>