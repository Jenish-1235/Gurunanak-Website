<?php
// Database configuration with provided credentials
$host = 'localhost';
$dbname = 'u898914949_gurunanak_appo';
$username = 'u898914949_gurunanak';
$password = 'Gurunanak@1235';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input data
    $name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $department = htmlspecialchars($_POST['department']);
    $preferred_date = htmlspecialchars($_POST['preferred_date']);
    $message = htmlspecialchars($_POST['message']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($department) || empty($preferred_date)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Insert data into the database
    $sql = "INSERT INTO appointments (name, email, phone, department, preferred_date, message) VALUES (:name, :email, :phone, :department, :preferred_date, :message)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':department' => $department,
            ':preferred_date' => $preferred_date,
            ':message' => $message
        ]);

        
        echo"Your appointment has been successfully submitted. Our hospital staff will call you to update about time.";
        
    } catch (PDOException $e) {
        echo "Failed to save appointment: " . $e->getMessage();
    }
}
?>
