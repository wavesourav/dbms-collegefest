<?php
require_once 'utils/header.php';
require_once 'utils/styles.php';

// Sanitize input
$usn = htmlspecialchars($_GET['usn'] ?? '');

// Include database connection
include_once 'classes/db1.php';

// Query to retrieve registered events for a specific student
$query = "SELECT e.event_title, st.st_name as student_coordinator, s.name as staff_coordinator, ef.date, ef.time, ef.location 
          FROM registered r
          INNER JOIN events e ON r.event_id = e.event_id
          INNER JOIN staff_coordinator s ON e.event_id = s.event_id
          INNER JOIN event_info ef ON e.event_id = ef.event_id
          INNER JOIN student_coordinator st ON e.event_id = st.event_id
          WHERE r.usn = '$usn'";
$result = mysqli_query($conn, $query);

?>

<div class="content">
    <div class="container">
        <h1>Registered Events</h1>
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Student Coordinator</th>
                        <th>Staff Coordinator</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['event_title'] ?></td>
                            <td><?= $row['student_coordinator'] ?></td>
                            <td><?= $row['staff_coordinator'] ?></td>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['time'] ?></td>
                            <td><?= $row['location'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- Add accommodation button -->
            <a href="accommodation.php?usn=<?= $usn ?>" class="btn btn-primary">Accommodation</a>
        <?php } else { ?>
            <a href="accommodation.php?usn=<?= $usn ?>" class="btn btn-primary">Accommodation</a>
            <p><?= $usn ?> has not registered for any events yet.</p>
        <?php } ?>
    </div>
</div>

<?php include 'utils/footer.php'; ?>
