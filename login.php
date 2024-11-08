<?php
session_start();

// Define a hard-coded username and password for this example
$admin_username = 'admin';
$admin_password = 'Gurunanak123'; // Change this to a strong password

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify credentials
    if ($username === $admin_username && $password === $admin_password) {
        // Successful login, set session variable
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_appointments.php'); // Redirect to admin panel
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Admin Login</h2>

            <?php if (isset($error)): ?>
                <p class="text-red-500 text-center"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" name="username" id="username" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>

                <button type="submit" class="w-full bg-primary-600 text-white font-bold py-2 rounded-md hover:bg-primary-700">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
