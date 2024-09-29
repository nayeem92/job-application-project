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
    <title>Review Application</title>
</head>
<body>
    <h1>Review Your Application</h1>

    <?php if (isset($_SESSION['success_message'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success_message']; ?></p>
        <?php unset($_SESSION['success_message']);  ?>
    <?php endif; ?>

    <p><strong>Full Name:</strong> <?php echo $_SESSION['full_name']; ?></p>
    <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $_SESSION['phone']; ?></p>
    <p><strong>Degree:</strong> <?php echo $_SESSION['degree']; ?></p>
    <p><strong>Field of Study:</strong> <?php echo $_SESSION['field_of_study']; ?></p>
    <p><strong>Institution:</strong> <?php echo $_SESSION['institution']; ?></p>
    <p><strong>Graduation Year:</strong> <?php echo $_SESSION['graduation_year']; ?></p>
    <p><strong>Job Title:</strong> <?php echo $_SESSION['job_title']; ?></p>
    <p><strong>Company:</strong> <?php echo $_SESSION['company_name']; ?></p>
    <p><strong>Years of Experience:</strong> <?php echo $_SESSION['years_of_experience']; ?></p>
    <p><strong>Key Responsibilities:</strong> <?php echo $_SESSION['key_responsibilities']; ?></p>

    <!-- Submit Application Button -->
    <form action="index.php?action=submit" method="POST">
        <button type="submit">Submit Application</button>
    </form>

    <!-- Logout Link -->
    <p><a href="index.php?action=logout">Logout</a></p>

    <!-- Back Navigation Links -->
    <p><a href="index.php?action=step1">Back to Step 1</a></p>
    <p><a href="index.php?action=step2">Back to Step 2</a></p>
    <p><a href="index.php?action=step3">Back to Step 3</a></p>
</body>
</html>
