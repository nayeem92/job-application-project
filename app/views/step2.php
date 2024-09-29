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
    <title>Step 2: Educational Background</title>
    <style>
        .progress-container {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .progress-bar {
            width: 66%; /* 66% for Step 2 */
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
        <p>Step 2 of 3: Educational Background</p>
    </div>

    <!-- Progress Indicator -->
    <div class="progress-container">
        <div class="progress-bar">66% Done</div>
    </div>

    <h1>Step 2: Educational Background</h1>
    <form action="index.php?action=step2" method="POST">
        <label for="degree">Highest Degree Obtained:</label>
        <input type="text" id="degree" name="degree" value="<?php echo isset($_SESSION['degree']) ? htmlspecialchars($_SESSION['degree']) : ''; ?>" required>

        <label for="field_of_study">Field of Study:</label>
        <input type="text" id="field_of_study" name="field_of_study" value="<?php echo isset($_SESSION['field_of_study']) ? htmlspecialchars($_SESSION['field_of_study']) : ''; ?>" required>

        <label for="institution">Name of Institution:</label>
        <input type="text" id="institution" name="institution" value="<?php echo isset($_SESSION['institution']) ? htmlspecialchars($_SESSION['institution']) : ''; ?>" required>

        <label for="graduation_year">Year of Graduation:</label>
        <input type="number" id="graduation_year" name="graduation_year" value="<?php echo isset($_SESSION['graduation_year']) ? htmlspecialchars($_SESSION['graduation_year']) : ''; ?>" required>

        <button type="submit">Next</button>
    </form>

    <a href="index.php?action=step1">Previous</a>
    <p><a href="index.php?action=logout">Logout</a></p>
</body>
</html>
