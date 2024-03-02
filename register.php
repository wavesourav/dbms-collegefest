<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>KSHITIJ 2024</title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>
    <body>
    <?php require 'utils/header.php'; ?>
    <div class="content"><!--body content holder-->
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST">
                    <label>Student username:</label><br>
                    <input type="text" name="usn" class="form-control" required><br><br>

                    <label>Student Password:</label><br>
                    <input type="text" name="pwd" class="form-control" required><br><br>

                    <label>Student Name:</label><br>
                    <input type="text" name="name" class="form-control" required><br><br>

                    <label>Branch:</label><br>
                    <input type="text" name="branch" class="form-control" required><br><br>

                    <label>Semester:</label><br>
                    <input type="text" name="sem" class="form-control" required><br><br>

                    <label>Email:</label><br>
                    <input type="text" name="email" class="form-control" required><br><br>

                    <label>Phone:</label><br>
                    <input type="text" name="phone" class="form-control" required><br><br>

                    <label>College:</label><br>
                    <input type="text" name="college" class="form-control" required><br><br>

                    <button type="submit" name="update" required>Submit</button><br><br>
                    <a href="usn.php"><u>Already registered ?</u></a>
                </form>
            </div>
        </div>
    </div>
    <?php require 'utils/footer.php'; ?>
    </body>
</html>

<?php
if (isset($_POST["update"])) {
    $usn = $_POST["usn"];
    $pwd = $_POST["pwd"];
    $name = $_POST["name"];
    $branch = $_POST["branch"];
    $sem = $_POST["sem"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $college = $_POST["college"];

    // Function to validate email format
    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    if (!empty($usn) && !empty($pwd) && !empty($name) && !empty($branch) && !empty($sem) && !empty($email) && !empty($phone) && !empty($college)) {
        include 'classes/db1.php';

        // Check if the email is in valid format
        if (!isValidEmail($email)) {
            echo "<script>
                    alert('Invalid email format. Please enter a valid email address.');
                    window.location.href='register.php';
                  </script>";
            exit; // Stop further execution
        }

        // Check if the username already exists
        $check_query = "SELECT * FROM participent WHERE usn='$usn'";
        $result = $conn->query($check_query);
        if ($result->num_rows > 0) {
            echo "<script>
                    alert('Username already exists. Please choose a different username.');
                    window.location.href='register.php';
                  </script>";
        } else {
            // Username is unique, proceed with insertion
            $INSERT = "INSERT INTO participent (usn,password,name,branch,sem,email,phone,college) VALUES('$usn','$pwd','$name','$branch',$sem,'$email','$phone','$college')";

            if ($conn->query($INSERT) === TRUE) {
                echo "<script>
                        alert('Registered Successfully!');
                        window.location.href='index.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error registering user.');
                        window.location.href='index.php';
                      </script>";
            }
        }
        $conn->close();
    } else {
        echo "<script>
                alert('All fields are required');
                window.location.href='register.php';
              </script>";
    }
}
?>
