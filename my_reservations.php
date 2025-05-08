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
$user_id = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_reservation_id'])) {
    $reservation_id = intval($_POST['cancel_reservation_id']);

    $getSpace = mysqli_query($conn, "SELECT parking_space_id FROM reservations WHERE id = $reservation_id AND user_id = $user_id");
    $space = mysqli_fetch_assoc($getSpace);

    if ($space) {
        $space_id = $space['parking_space_id'];

        mysqli_query($conn, "DELETE FROM reservations WHERE id = $reservation_id AND user_id = $user_id");
        mysqli_query($conn, "UPDATE parking_spaces SET is_reserved = 0 WHERE id = $space_id");
    }
}

$reservations = mysqli_query($conn, "
    SELECT r.id AS reservation_id, ps.label AS space_label, cp.name AS carpark_name, cp.location AS carpark_location 
    FROM reservations r
    JOIN parking_spaces ps ON r.parking_space_id = ps.id
    JOIN carparks cp ON ps.carpark_id = cp.id
    WHERE r.user_id = $user_id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
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

        
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }

        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
        }

        button {
            padding: 8px 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        
        .center-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .cancel-btn {
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #FF4C4C;
            border: none;
            color: white;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }

        .cancel-btn:hover {
            background-color: #e63946;
        }

       
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            table {
                font-size: 14px;
            }
            h1 {
                font-size: 1.5em;
            }
            .cancel-btn {
                width: 100%;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.2em;
            }
            button, .cancel-btn {
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
        <h1>My Reservations, <?= htmlspecialchars($name) ?></h1>
        <a href="homepage.php">Back to Homepage</a>

        <h2>Your Reservations</h2>
        <table>
            <tr>
                <th>Space Label</th>
                <th>Carpark Name</th>
                <th>Carpark Location</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($reservations)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['space_label']) ?></td>
                    <td><?= htmlspecialchars($row['carpark_name']) ?></td>
                    <td><?= htmlspecialchars($row['carpark_location']) ?></td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                            <input type="hidden" name="cancel_reservation_id" value="<?= $row['reservation_id'] ?>">
                            <button type="submit" class="cancel-btn">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

</body>
</html>
