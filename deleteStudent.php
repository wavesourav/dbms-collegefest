<?php require 'classes/db1.php';
$id=$_GET['id'];

$sql="delete from participent where usn='$id';";
// Assuming you have a database connection established
// and $conn is your mysqli connection object

// Fetch the current value of the column
// $query = "SELECT participents FROM events WHERE usn='$id'";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);
// $currentValue = $row['participents'];

// // Decrease the value
// $newValue = $currentValue - 1;

// // Update the column with the new value
// $updateQuery = "UPDATE events SET participents = $newValue WHERE usn='$id'";
// mysqli_query($conn, $updateQuery);

if($conn->multi_query($sql) === True)
{
    echo"<script>
    alert('User Deleted Successfully');
    window.location.href='Stu_details.php';
            </script>";
}
else{
    echo "Error deleting record".$conn->error;
}
$conn->close();
?>