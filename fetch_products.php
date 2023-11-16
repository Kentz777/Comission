<?php

$conn = new mysqli("localhost", "root", "", "laundry_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['categoryId']) && $_POST['categoryId'] != '0') {
    $categoryId = $_POST['categoryId'];

    $query = "SELECT * FROM supply_list WHERE category_id = $categoryId ORDER BY name ASC";
    $result = $conn->query($query);

    if ($result) {
        $products = array();

        while ($row = $result->fetch_assoc()) {
            $products[] = array(
                'id'    => $row['id'],
                'name'  => $row['name'],
                'price' => $row['price']
            );
        }

        echo json_encode($products);
    } else {

        echo json_encode(array('error' => 'Query error'));
    }
} else {

    echo json_encode(array('error' => 'Invalid category ID'));
}

$conn->close();
?>
