

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <?php
     require_once("config/env.php");
        require_once("config/DB_connection.php");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT * FROM posts";
    $result = $con->query($sql);

    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card mb-3' style='width: 100%;'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row["title"] . "</h5>";
            echo "<p class='card-text'>" . $row["content"] . "</p>";
            echo "<img src='assets/img/" . $row["image"] . "' class='card-img-top'>";
            echo "</div>";
            echo "</div>";
            
        }
        
    } else {
        echo "<div class='alert alert-warning'>No posts found.</div>";
    }
    
    ?>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

