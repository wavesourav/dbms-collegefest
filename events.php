<div class="container">
        <div class="col-md-12">
            <hr>
        </div>
        <div class="row">
            <section>
                <div class="container">
                    <div class="col-md-6">
                        <img src="<?php echo $row['img_link'];?>" class="img-responsive">
                    </div>
                    <div class="subcontent col-md-6">
                        <h1 style="color:#003300 ; font-size:38px ;" ><u><strong><?php echo '<td>' . $row['event_title'] . '</td>';?></strong></u></h1><!--title-->
                        <p style="color:#003300  ;font-size:20px "><!--content-->
                        <?php
                            echo 'Date:' . $row['Date'] .'<br>'; 
                            echo 'Time:' . $row['time'] .'<br>'; 
                            echo 'Location:' . $row['location'] .'<br>'; 
                            echo 'Student Co-ordinator:' . $row['st_name'] .'<br>'; 
                            echo 'Staff Co-ordinator:' . $row['name'] .'<br>'; 
                            echo 'Event Price:' . $row['event_price'].'<br>' ;
                        ?>
                        </p>
                        <br><br>
                        <form method="POST">
                            <label>Username:</label><br>
                            <input type="text" name="username" class="form-control" required><br>
                            <label>Password:</label><br>
                            <input type="password" name="password" class="form-control" required><br>
                            <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                            <button type="submit" name="register" class="btn btn-default">Register</button>
                        </form>
                        <?php
                        if (isset($_POST["register"])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $event_id = $_POST['event_id'];

                            // Check if the username and password exist in the 'participant' table
                            $check_sql = "SELECT * FROM participent WHERE usn='$username' AND password='$password'";
                            $check_result = $conn->query($check_sql);

                            if ($check_result->num_rows > 0) {
                                // Check if the entry already exists in the 'registered' table
                                $existing_sql = "SELECT * FROM registered WHERE usn='$username' AND event_id='$event_id'";
                                $existing_result = $conn->query($existing_sql);

                                if ($existing_result->num_rows == 0) {
                                    // Insert the new registration entry
                                    $insert_sql = "INSERT INTO registered (usn, event_id) VALUES ('$username', '$event_id')";
                                    if ($conn->query($insert_sql) === TRUE) {
                                        echo "<script>
                                            alert('Registration Successful');
                                            window.location.href='index.php';
                                            </script>";
                                    } else {
                                        echo "Error: " . $insert_sql . "<br>" . $conn->error;
                                    }
                                } else {
                                    echo "<script>
                                        alert('You have already registered for this event');
                                        window.location.href='index.php';
                                        </script>";
                                }
                            } else {
                                echo "<script>
                                    alert('Invalid credentials');
                                    window.location.href='index.php';
                                    </script>";
                            }
                        }
                        ?>
                    </div><!--subcontent div-->
                </div><!--container div-->
            </section>
        </div>
    </div><!--container div-->
</div><!--content div-->