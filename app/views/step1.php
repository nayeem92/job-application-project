<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: index.php?action=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1: Personal Information</title>
    <style>
        .progress-container {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .progress-bar {
            width: 33%; /* 33% for Step 1 */
            height: 30px;
            background-color: #4CAF50; /* Green */
            text-align: center;
            line-height: 30px; /* Center text vertically */
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div>
        <p>Step 1 of 3: Personal Information</p>
    </div>
    
    <!-- Progress Indicator -->
    <div class="progress-container">
        <div class="progress-bar">33% Done</div>
    </div>

    <h1>Step 1: Personal Information</h1>
    
    <?php if (isset($_SESSION['error_message'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error_message']; ?></p>
        <?php unset($_SESSION['error_message']); // Clear message after displaying ?>
    <?php endif; ?>
    
    <form action="index.php?action=step1" method="POST">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo isset($_SESSION['full_name']) ? htmlspecialchars($_SESSION['full_name']) : ''; ?>" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="<?php echo isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : ''; ?>" required>

        <button type="submit">Next</button>
    </form>

    <p><a href="index.php?action=logout">Logout</a></p>
</body>
</html>
