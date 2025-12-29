<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Falayeh - Restaurant Finder</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background:
        radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3), transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(252, 70, 107, 0.3), transparent 50%),
        radial-gradient(circle at 40% 20%, rgba(99, 102, 241, 0.2), transparent 50%);
      pointer-events: none;
      animation: backgroundShift 15s ease infinite;
    }

    @keyframes backgroundShift {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: 0.8;
      }
    }

    .navbar {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      padding: 1.2rem 0;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand {
      font-size: 1.8rem;
      font-weight: 700;
      color: white !important;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
      transform: scale(1.05);
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .hero-section {
      text-align: center;
      padding: 3rem 0 2rem;
      animation: fadeInDown 0.8s ease;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero-title {
      font-size: 3rem;
      font-weight: 700;
      color: white;
      margin-bottom: 0.5rem;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
      font-size: 1.2rem;
      color: rgba(255, 255, 255, 0.9);
      font-weight: 300;
      margin-bottom: 2rem;
    }

    .search-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 2.5rem;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      margin-bottom: 2rem;
      animation: fadeInUp 0.8s ease;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .search-form {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .search-input {
      flex: 1;
      padding: 1rem 1.5rem;
      border: 2px solid rgba(102, 126, 234, 0.3);
      border-radius: 16px;
      font-size: 1rem;
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
      background: white;
    }

    .search-input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
      transform: translateY(-2px);
    }

    .search-button {
      padding: 1rem 2.5rem;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 16px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
      white-space: nowrap;
    }

    .search-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 25px rgba(102, 126, 234, 0.6);
    }

    .search-button:active {
      transform: translateY(0);
    }

    .results-header {
      font-size: 1.5rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .meal-tag {
      display: inline-block;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 0.3rem 1rem;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 500;
      margin-left: 0.5rem;
    }

    .restaurant-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .restaurant-card {
      background: white;
      border-radius: 16px;
      padding: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.3s ease;
      border: 2px solid transparent;
      cursor: pointer;
      animation: slideIn 0.5s ease backwards;
    }

    .restaurant-card:nth-child(1) {
      animation-delay: 0.1s;
    }

    .restaurant-card:nth-child(2) {
      animation-delay: 0.2s;
    }

    .restaurant-card:nth-child(3) {
      animation-delay: 0.3s;
    }

    .restaurant-card:nth-child(4) {
      animation-delay: 0.4s;
    }

    .restaurant-card:nth-child(5) {
      animation-delay: 0.5s;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .restaurant-card:hover {
      transform: translateX(8px);
      border-color: #667eea;
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
    }

    .restaurant-name {
      font-size: 1.1rem;
      font-weight: 500;
      color: #333;
      display: flex;
      align-items: center;
      gap: 0.8rem;
    }

    .restaurant-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
    }

    .rating-badge {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      color: white;
      padding: 0.5rem 1.2rem;
      border-radius: 12px;
      font-weight: 600;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 0.3rem;
      box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
    }

    .no-results {
      text-align: center;
      padding: 3rem 2rem;
      background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
      border-radius: 16px;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .no-results-icon {
      font-size: 4rem;
      margin-bottom: 1rem;
    }

    .no-results-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #d35400;
      margin-bottom: 0.5rem;
    }

    .no-results-text {
      font-size: 1rem;
      color: #e67e22;
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }

      .search-form {
        flex-direction: column;
      }

      .search-card {
        padding: 1.5rem;
      }

      .restaurant-card:hover {
        transform: translateY(-4px);
      }
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="container">
      <a class="navbar-brand" href="#">🍽️ Falayeh</a>
    </div>
  </nav>

  <div class="container">
    <div class="hero-section">
      <h1 class="hero-title">Discover Amazing Restaurants</h1>
      <p class="hero-subtitle">Find the perfect place for your favorite meals</p>
    </div>

    <div class="search-card">
      <form method="POST" class="search-form">
        <input
          type="text"
          name="meal"
          class="search-input"
          placeholder="What are you craving? (e.g., pizza, sushi, burger...)"
          required
          value="<?php echo isset($_POST['meal']) ? htmlspecialchars($_POST['meal']) : ''; ?>">
        <button type="submit" class="search-button">🔍 Search</button>
      </form>

      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['meal']) && $_POST['meal'] !== "") {
        $meal = trim($_POST['meal']);
        $stmt = $conn->prepare("
          SELECT best_restaurant, rating
          FROM restaurant
          WHERE meal = ?
          ORDER BY rating DESC
          LIMIT 10
        ");

        $stmt->bind_param("s", $meal);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          echo "<div class='results-header'>
                  Top Recommendations for 
                  <span class='meal-tag'>" . htmlspecialchars($meal) . "</span>
                </div>";
          echo "<div class='restaurant-list'>";

          $icons = ['🍕', '🍔', '🍣', '🍜', '🥗', '🍝', '🌮', '🥘', '🍱', '🍛'];
          $index = 0;

          while ($row = $result->fetch_assoc()) {
            $icon = $icons[$index % count($icons)];
            echo "<div class='restaurant-card'>
                    <div class='restaurant-name'>
                      <div class='restaurant-icon'>" . $icon . "</div>
                      <span>" . htmlspecialchars($row['best_restaurant']) . "</span>
                    </div>
                    <div class='rating-badge'>
                      ⭐ " . htmlspecialchars($row['rating']) . "/5
                    </div>
                  </div>";
            $index++;
          }
          echo "</div>";
        } else {
          echo "<div class='no-results'>
                  <div class='no-results-icon'>🔍</div>
                  <div class='no-results-title'>No Results Found</div>
                  <div class='no-results-text'>
                    We couldn't find any restaurants for <strong>" . htmlspecialchars($meal) . "</strong>.<br>
                    Try searching for something else!
                  </div>
                </div>";
        }

        $stmt->close();
      }
      ?>
    </div>
  </div>
</body>

</html>