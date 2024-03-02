
<?php include 'classes/db1.php';
    $id=$_GET['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>KSHITIJ 2024</title>
        <title></title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>
    <body>
    <?php require 'utils/header.php'; ?>
    <div class ="content"><!--body content holder-->
            <div class = "container">
                <div class ="col-md-6 col-md-offset-3">
    <form method="POST">
<label>Event Date</label><br>
    <input type="text" name="date"  class="form-control"><br><br>
    <label>Event Time </label><br>
    <input type="text" name="time"  class="form-control"><br><br>
    <label>Event location</label><br>
    <input type="text" name="location"  class="form-control"><br><br>
    <label>Event result</label><br>
    <input type="text" name="result"  class="form-control"><br><br>
    <button type="submit" name="update" class = "btn btn-default ">Update</button>
    </div>
    </div>
    </div>
    </form>
    

    <?php require 'utils/footer.php'; ?>
    </body>
</html>


<?php

 if (isset($_POST["update"]))
 {
     $date=$_POST["date"];
     $time=$_POST["time"];
     $location=$_POST["location"];
     $result=$_POST["result"];
     if($date!="")
     {
        $sql1="UPDATE event_info set Date='$date' where event_id='$id'";
        if($conn->query($sql1)===true)
     {
        echo"<script>
        alert(' Date Updated Successfully');
        
        </script>";
     }
     }
     if($time!="")
     {
        $sql2="UPDATE event_info set time='$time' where event_id='$id'";
        if($conn->query($sql2)===true)
     {
        echo"<script>
        alert(' time Updated Successfully');
        
        </script>";
     }
     }
     if($location!="")
     {
        $sql3="UPDATE event_info set location='$location' where event_id ='$id'";
        if($conn->query($sql3)===true)
     {
        echo"<script>
        alert(' location Updated Successfully');
        
        </script>";
     }
     }
    //  if(is_null($result)===0)
    //  {
        $sql4="UPDATE events set Result='$result' where event_id ='$id'";
        if($conn->query($sql4)===true)
     {
        echo"<script>
        alert(' result Updated Successfully');
        
        </script>";
     }
    //  }

    
        echo"<script>
      
        window.location.href='login_form.php';
        </script>";
     
    
}
?>