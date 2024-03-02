<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accommodation Booking</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #f9f9f9;
    }
    .book-button {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }
    .book-button:hover {
        background-color: #45a049;
    }
    p {
        text-align: center;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Available Accommodation</h1>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ktj";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to check if accommodation has already been booked for a USN
    function checkBookedAccommodation($conn, $usn) {
        $sql = "SELECT accommodation FROM participent WHERE usn = '$usn'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['accommodation'];
        } else {
            return NULL;
        }
    }

    if (isset($_GET['usn'])) {
        $usn = $_GET['usn'];
        $bookedAccommodation = checkBookedAccommodation($conn, $usn);
        if ($bookedAccommodation !== NULL) {
            echo "<p>You have already booked accommodation: $bookedAccommodation</p>";
        } else {
            // Function to book accommodation and update participant table
            function bookAccommodation($conn, $hallName, $usn) {
                $sql = "UPDATE accommodation SET available_seats = available_seats - 1 WHERE hall_name = '$hallName' AND available_seats > 0";
                $result = $conn->query($sql);
                if ($result) {
                    $sql = "UPDATE participent SET accommodation = ('$hallName') WHERE usn = '$usn'";
                    $result = $conn->query($sql);
                }
                return $result;
            }

            if (isset($_GET['hallName'])) {
                $hallName = $_GET['hallName'];
                if (bookAccommodation($conn, $hallName, $usn)) {
                    echo "<script>alert('Booking for $hallName successful!');</script>";
                } else {
                    echo "<script>alert('No seats available for $hallName.');</script>";
                }
            }

            // Display available accommodation
            $sql = "SELECT hall_name, available_seats FROM accommodation WHERE available_seats > 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Hall Name</th><th>Available Seats</th><th>Book</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['hall_name']}</td>";
                    echo "<td>{$row['available_seats']}</td>";
                    echo "<td><form method='get'><input type='hidden' name='hallName' value='{$row['hall_name']}'><input type='hidden' name='usn' value='$usn'><button class='book-button' type='submit'>Book</button></form></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No accommodation available at the moment.</p>";
            }
        }
    }

    $conn->close();
    ?>
</div>
</body>
</html>
