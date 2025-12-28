<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Restaurant Recommendation</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<style>
  body { background-color: #f8f9fa; }
</style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#"><strong>Restaurant Finder 🍽️</strong></a>
  </div>
</nav>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <strong>Find the Best Restaurants<strong>
        </div>
        <div class="card-body">

          <form method="POST" class="d-flex">
            <input type="text" name="meal" class="form-control me-2" placeholder="Enter your meal (pizza, sushi...)" required>
            <button type="submit" class="btn btn-primary">Search</button>
          </form>

          <hr>

          <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['meal']) && $_POST['meal'] !== "") {
            $meal = trim($_POST['meal']);
            $stmt = $conn->prepare("
              SELECT best_restaurant, rating
              FROM restaurant
              WHERE meal = ?
              ORDER BY rating DESC
              LIMIT 1
            ");

            $stmt->bind_param("s", $meal);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo "<div class='alert alert-success'>
                    <strong>Recommended:</strong> " . htmlspecialchars($row['best_restaurant']) . "
                    ⭐ (" . htmlspecialchars($row['rating']) . "/5)
                    </div>";
            } else {
              echo "<div class='alert alert-warning'>
                    No recommendation found for <strong>" . htmlspecialchars($meal) . "</strong>.
                    </div>";
            }

            $stmt->close();
          }
          ?>

        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
