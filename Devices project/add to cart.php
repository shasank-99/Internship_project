<?php
// Start a session to access session variables
session_start();

// Check if the user is logged in (you can implement your own authentication logic)
if (!isset($_SESSION['userid'])) {
    // Redirect the user to the login page or show an error message
    header("Location: login.php"); // Replace "login.php" with your actual login page URL
    exit();
}

// Get the product ID (pid) from the query parameters
if (isset($_GET['pid'])) {
    $product_id = $_GET['pid'];
    
    // Include the database connection file
    include "path/to/your/connection.php"; // Update the path
    
    // Get the user ID from the session
    $user_id = $_SESSION['userid'];
    
    // Insert the product into the user's cart
    $query = "INSERT INTO cart (userid, pid) VALUES ($user_id, $product_id)";
    
    if (mysqli_query($conn, $query)) {
        // Product added to the cart successfully
        header("Location: success.php"); // Redirect to a success page or show a success message
        exit();
    } else {
        // Failed to add the product to the cart
        echo "Failed to add to cart: " . mysqli_error($conn); // You can handle the error appropriately
    }
} else {
    // Missing product ID in the query parameters
    echo "Product ID not provided.";
}
?>