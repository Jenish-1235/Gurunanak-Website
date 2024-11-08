<?php
// Start session for admin authentication
session_start();

// Simple authentication check (this is a placeholder, replace it with a secure login system)
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php"); // Redirect to login page
    exit;
}

// Database configuration
$host = 'localhost';
$dbname = 'u898914949_gurunanak_appo';
$username = 'u898914949_gurunanak';
$password = 'Gurunanak@1235';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all appointments
    $sql = "SELECT * FROM appointments ORDER BY preferred_date ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Appointments Dashboard</h1>
        <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-primary-600 text-black">
                <tr>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Phone</th>
                    <th class="px-4 py-2">Department</th>
                    <th class="px-4 py-2">Preferred Date</th>
                    <th class="px-4 py-2">Message</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                <tr class="border-t">
                    
                <td class="px-4 py-2"><?php echo htmlspecialchars($appointment['created_at']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($appointment['name']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($appointment['email']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($appointment['phone']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($appointment['department']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($appointment['preferred_date']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($appointment['message']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
