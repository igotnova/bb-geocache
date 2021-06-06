<?php
// Include config file
require_once "../db_config.php";
 
// Define variables and initialize with empty values
$location = $userID = $date = $status ="";
$location_err = $userID_err = $date_err = $status_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["reservationID"]) && !empty($_POST["reservationID"])){
    // Get hidden input value
    $reservationID = $_POST["reservationID"];
    
    // Validate location
    $input_location = trim($_POST["location"]);
    if(empty($input_location)){
        $location_err = "Please enter a location.";
    } elseif(!filter_var($input_location, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $location_err = "Please enter a valid location.";
    } else{
        $location = $input_location;
    }
    
    // Validate userID userID
    $input_userID = trim($_POST["userID"]);
    if(empty($input_userID)){
        $userID_err = "Please enter an userID.";     
    } else{
        $userID = $input_userID;
    }

    // Validate status
    $input_status = trim($_POST["status"]);
    if(empty($input_status)){
        $status_err = "Please enter an status.";     
    } else{
        $status = $input_status;
    }
    
    // Validate date
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter the date amount.";     
    }else{
        $date = $input_date;
    }
    
    // Check input errors before inserting in database
    if(empty($location_err) && empty($userID_err) && empty($date_err)){
        // Prepare an update statement
        $sql = "UPDATE reservation SET location=?, userID=?, date=?, status=? WHERE reservationID=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssii", $param_location, $param_userID, $param_date, $param_status, $param_reservationID);
            
            // Set parameters
            $param_location = $location;
            $param_userID = $userID;
            $param_date = $date;
            $param_status = $status;
            $param_reservationID = $reservationID;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: ../../../home.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["reservationID"]) && !empty(trim($_GET["reservationID"]))){
        // Get URL parameter
        $reservationID =  trim($_GET["reservationID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM reservation WHERE reservationID = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_reservationID);
            
            // Set parameters
            $param_reservationID = $reservationID;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $location = $row["location"];
                    $userID = $row["userID"];
                    $date = $row["date"];
                    $status = $row["status"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
        
        // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the cache record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>location</label>
                            <input type="text" name="location" class="form-control <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $location; ?>">
                            <span class="invalid-feedback"><?php echo $location_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>userID</label>
                            <textarea name="userID" class="form-control <?php echo (!empty($userID_err)) ? 'is-invalid' : ''; ?>"><?php echo $userID; ?></textarea>
                            <span class="invalid-feedback"><?php echo $userID_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>date</label>
                            <input type="date" name="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
                            <span class="invalid-feedback"><?php echo $date_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>status</label>
                            <textarea name="status" class="form-control <?php echo (!empty($status_err)) ? 'is-invalid' : ''; ?>"><?php echo $status; ?></textarea>
                            <span class="invalid-feedback"><?php echo $status_err;?></span>
                        </div>
                        <input type="hidden" name="reservationID" value="<?php echo $reservationID; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../../../index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>