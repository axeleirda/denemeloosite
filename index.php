<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: pages/login.php');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Welcome to the Forum</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="pages/create_topic.php">Create Topic</a>
            <a href="pages/profile.php">Profile</a>
            <a href="pages/logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <?php
        $result = $conn->query("SELECT * FROM topics ORDER BY created_at DESC");

        while ($topic = $result->fetch_assoc()) {
            echo "<div class='topic'>";
            echo "<h2><a href='pages/view_topic.php?id=" . $topic['id'] . "'>" . $topic['title'] . "</a></h2>";
            echo "<p>" . substr($topic['content'], 0, 200) . "...</p>";
            echo "<p><small>Posted by user ID: " . $topic['user_id'] . " on " . $topic['created_at'] . "</small></p>";
            echo "</div>";
        }
        ?>
    </main>
</body>
</html>