<!DOCTYPE html>
<html>

<head>
  <title>Event Details</title>
  <link rel="stylesheet" href="../CSS/main.css">
  <link rel="shortcut icon" href="../../assets/logo.png" type="image/x-icon">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="page">
    <h1>Users Info</h1>
    <div class="logo"><i class='bx bx-handicap'></i> WebAbility</div>
  </div>
  <header>
    <p><i class='bx bxs-doughnut-chart'></i> Admin dashboard</p>
    <nav>
      <a href="user-information.php">User Information</a>
      <a href="helpers.php">Helpers</a>
      <a href="event-listings.php">Event Listings</a>
    </nav>
  </header>

  <div class="mainbody">
    <?php
   require_once 'vendor/autoload.php'; // Include Composer's autoload file

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Use the values from the .env file
$conn = mysqli_connect(
    getenv('DB_HOST'), 
    getenv('DB_USER'), 
    getenv('DB_PASS'), 
    getenv('DB_NAME')
);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM registration";
    $result = mysqli_query($conn, $sql);

    $usersCount = 0;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<section>';
        echo '<img src="' . $row['imageData'] . '" alt="profile">';
        echo '<div class="user-info">';
        echo '<p>Name:  ' . $row['fullName'] . '</p>';
        echo '<p>Email: ' . $row['email'] . '</p>';
        echo '<p>Telegram Account:  ' . $row['telegram'] . '</p>';
        echo '<p>Phone Number:  ' . $row['phoneNumber'] . '</p>';
        echo '<p>Disability Type:  ' . $row['disability'] . '</p>';
        echo '</div>';
        echo '</section>';

        $usersCount++;
      }
    } else {
      echo "0 results";
    }

    mysqli_close($conn);
    ?>
  </div>


</body>

</html>