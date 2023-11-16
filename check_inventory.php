<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "laundry_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the POST data exists
if(isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Fetch the available quantity from the inventory table based on the selected product ID
    $query = $conn->prepare("SELECT qty FROM inventory WHERE supply_id = ?");
    $query->bind_param("i", $productId);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableQuantity = $row['qty'];
        echo json_encode(array('quantity' => $availableQuantity));
    } else {
        // If no data found for the given product ID, return a default quantity (change as needed)
        echo json_encode(array('quantity' => 0));
    }
} else {
    echo json_encode(array('quantity' => 0));
}

$conn->close();
?>