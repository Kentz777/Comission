<?php
// Include your database connection code here
// For example:
$conn = new mysqli("localhost", "root", "", "laundry_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the category ID is set and not equal to 0
if (isset($_POST['categoryId']) && $_POST['categoryId'] != '0') {
    $categoryId = $_POST['categoryId'];

    // Fetch products based on the selected category
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

        // Return the products in JSON format
        echo json_encode($products);
    } else {
        // Handle the query error as needed
        echo json_encode(array('error' => 'Query error'));
    }
} else {
    // Handle the case where the category ID is not set or equal to 0
    echo json_encode(array('error' => 'Invalid category ID'));
}

// Close the database connection
$conn->close();
?>
