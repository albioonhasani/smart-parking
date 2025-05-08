<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$userResult = mysqli_query($conn, "SELECT id, firstName, lastName FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($userResult);
$name = $user['firstName'] . ' ' . $user['lastName'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['space_id'])) {
    $space_id = $_POST['space_id'];
    $user_id = $user['id'];
    
    $checkAvailability = mysqli_query($conn, "SELECT * FROM parking_spaces WHERE id = $space_id AND is_reserved = 0");

    if (mysqli_num_rows($checkAvailability) > 0) {
        mysqli_query($conn, "UPDATE parking_spaces SET is_reserved = 1 WHERE id = $space_id");
        mysqli_query($conn, "INSERT INTO reservations (user_id, parking_space_id) VALUES ($user_id, $space_id)");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
     
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        
        header {
            background-color: white;
            color: #007BFF;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header .logo {
            font-size: 1.5em;
            font-weight: bold;
        }

        header a.logout-btn {
            padding: 8px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-left: 20px;
        }

        header a.logout-btn:hover {
            background-color: #0056b3;
        }

        
        .container {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
        }

        h1, h2 {
            text-align: center;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
        }

        
        .carpark {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .carpark h3 {
            margin: 0 0 10px;
        }

        .carpark table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .carpark th, .carpark td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .carpark button {
            padding: 8px 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
        }

        .carpark button:hover {
            background-color: #0056b3;
        }

        .reservations-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }

        .reservations-btn:hover {
            background-color: #0056b3;
        }

        
        .center-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            .carpark {
                width: 100%;
                margin-bottom: 20px;
            }
            .carpark table {
                font-size: 14px;
            }
            h1 {
                font-size: 1.5em;
            }
            .reservations-btn {
                width: 100%;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.2em;
            }
            .carpark button {
                width: 100%;
            }
            .reservations-btn {
                width: 100%;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    
    <header>
        <div class="logo">SmartPark</div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <div class="container">
        <h1>Hello <?= htmlspecialchars($name) ?></h1>

        
        <div class="center-btn">
            <form method="GET" action="my_reservations.php">
                <button type="submit" class="reservations-btn">My Reservations</button>
            </form>
        </div>

        <h2>Available Car Parks in Mitrovica</h2>
        <?php
        $carparks = mysqli_query($conn, "SELECT * FROM carparks WHERE location='Mitrovica' LIMIT 3");

        while ($carpark = mysqli_fetch_assoc($carparks)): ?>
            <div class="carpark">
                <h3><?= htmlspecialchars($carpark['name']) ?> (<?= htmlspecialchars($carpark['location']) ?>)</h3>
                <p><strong>Available Spaces:</strong></p>
                <table>
                    <tr>
                        <th>Label</th>
                        <th>Reserve</th>
                    </tr>
                    <?php
                    $spaces = mysqli_query($conn, "SELECT * FROM parking_spaces WHERE carpark_id={$carpark['id']} AND is_reserved=0");
                    while ($space = mysqli_fetch_assoc($spaces)): ?>
                        <tr>
                            <td><?= htmlspecialchars($space['label']) ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="space_id" value="<?= $space['id'] ?>">
                                    <button type="submit">Reserve</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>
