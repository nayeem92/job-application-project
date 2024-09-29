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
    <title>Step 3: Work Experience</title>
    <style>
        .progress-container {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .progress-bar {
            width: 99%; /* 100% for Step 3 */
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
        <p>Step 3 of 3: Work Experience</p>
    </div>

    <!-- Progress Indicator -->
    <div class="progress-container">
        <div class="progress-bar">99% Done</div>
    </div>

    <h1>Step 3: Work Experience</h1>
    <form action="index.php?action=step3" method="POST">
        <label for="job_title">Previous Job Title:</label>
        <input type="text" id="job_title" name="job_title" value="<?php echo isset($_SESSION['job_title']) ? htmlspecialchars($_SESSION['job_title']) : ''; ?>" required>

        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" value="<?php echo isset($_SESSION['company_name']) ? htmlspecialchars($_SESSION['company_name']) : ''; ?>" required>

        <label for="years_of_experience">Years of Experience:</label>
        <input type="number" id="years_of_experience" name="years_of_experience" value="<?php echo isset($_SESSION['years_of_experience']) ? htmlspecialchars($_SESSION['years_of_experience']) : ''; ?>" required>

        <label for="key_responsibilities">Key Responsibilities:</label>
        <textarea id="key_responsibilities" name="key_responsibilities" required><?php echo isset($_SESSION['key_responsibilities']) ? htmlspecialchars($_SESSION['key_responsibilities']) : ''; ?></textarea>

        <button type="submit">Next</button>
    </form>

    <a href="index.php?action=step2">Previous</a>
    <p><a href="index.php?action=logout">Logout</a></p>
</body>
</html>
