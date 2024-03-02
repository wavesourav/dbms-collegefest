<?php
require_once 'utils/header.php';
require_once 'utils/styles.php';

$usn= htmlspecialchars($_GET['usn']);


include_once 'classes/db1.php';
$result1= mysqli_query($conn, "SELECT * FROM student_coordinator st,staff_coordinator s,events e,event_info ef where st.usn='$usn' and e.event_id=ef.event_id and e.event_id=st.event_id and s.event_id=e.event_id");

$event_id="";
?>

<div class = "content">
            <div class = "container">
            <h1> You are the organiser for the following event</h1>
             <?php
if (mysqli_num_rows($result1) > 0) {
?> 
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            
                            <th>Event_name</th>             
                           <th>Student Co-ordinator</th>
                            <th>Staff Co-ordinator</th>

                           
                            <th>Date</th>
                        
                            <th>Time</th>
                            <th>location </th>
                            <th>Result </th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result1)) {
                        $event_id=$row['event_id'];

                            echo '<tr>';
                            echo '<td>' . $row['event_title'] . '</td>';                    
                            echo '<td>' . $row['st_name'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                           
                            echo '<td>'.$row['Date'].'</td>';
                            echo '<td>'.$row['time'].'</td>';
                            echo '<td>'.$row['location'].'</td>';
                            echo '<td>'.$row['Result'].'</td>';
                             echo '<td><a  href="updateevents.php?id='.$row['event_id'].'" class = "btn btn-default"> Update</a></td>';

                            
                         
                            echo '</tr>';  

                            $i++;
                        }
                      
                        ?>
                    </tbody>
                </table>
                    <?php }
                    else{
                        echo $usn;
                    echo 'Not Yet Rgistered any events';
                    
                    }?>
<?php
// Fetch the event_id from the result of $result1


// Use the fetched event_id in the main query
$result = mysqli_query($conn, "SELECT * FROM participent p, registered r
                                where r.event_id = '$event_id'  and r.usn = p.usn");

?>
<div class = "content">
            <div class = "container">
            <h1> The following students have participated in your event</h1>
             <?php
if (mysqli_num_rows($result) > 0) {
?> 
                <table class="table table-hover" >
                    <thead>
                        <tr>
                        <th>student username</th>   
                            <th>student name</th>             
                           <th>Student branch</th>
                            <th>Student email</th>
                            
                           
                            <th>Student semester</th>
                        
                            <th>Student contact</th>
                            <th>Student college</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {

                            echo '<tr>';
                            echo '<td>' . $row['usn'] . '</td>';  
                            echo '<td>' . $row['name'] . '</td>';                    
                            echo '<td>' . $row['branch'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                           
                            echo '<td>'.$row['sem'].'</td>';
                            echo '<td>'.$row['phone'].'</td>';
                            echo '<td>'.$row['college'].'</td>';
                            
                         
                            echo '</tr>';  

                            $i++;
                        }
                      
                        ?>
                    </tbody>
                </table>
                    <?php }?>
                
               
            </div>
        </div>
        <?php
    
        // $result = mysqli_query($conn, );
        ?>
        <div class = "content">
            <div class = "container">
            
            </div>
        </div>
        <?php include 'utils/footer.php'; ?> 