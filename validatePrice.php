<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $price = $_POST["price"];
    $response = array();

    // Remove any non-digit characters
    $price = preg_replace("/[^0-9]/", "", $price);

    if (strlen($price) > 7) {
        $response["error"] = true;
        $response["message"] = "Price should not exceed 7 digits.";
    } else {
        $response["error"] = false;
        $response["message"] = "";
    }

    echo json_encode($response);
}
?>
