<?php
// Include config file
require_once "../db_config.php";
 

// Initialize the session
session_start();
 

// Define variables and initialize with empty values
$location = $userID = $date = "";
$location_err = $userID_err = $date_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate location
    $input_location = trim($_POST["location"]);
    if(empty($input_location)){
        $location_err = "Please enter a location.";
    } elseif(!filter_var($input_location, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $location_err = "Please enter a valid location.";
    } else{
        $location = $input_location;
    }
    
    // // Validate userID
    // $input_userID = trim($_POST["userID"]);
    // if(empty($input_userID)){
    //     $userID_err = "Please enter an userID.";     
    // } else{
    //     $userID = $input_userID;
    // }
    
    // Validate date
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter the date amount.";     
    }else{
        $date = $input_date;
    }
    
    // Check input errors before inserting in database
    if(empty($location_err) && empty($date_err)){
        // Prepare an insert statement
        $userSID = $_SESSION['userID'];
        $sql = "INSERT INTO reservation (location, userID, date) VALUES (?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_location, $param_userID, $param_date);
            
            // Set parameters
            $param_location = $location;
            $param_userID = $userSID;
            $param_date = $date;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: ../../../index.php");
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
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create cache</h2>
                    <p>voeg jouw geo cache toe</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>location</label>
                            <input type="text" name="location" class="form-control <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $location; ?>">
                            <span class="invalid-feedback"><?php echo $location_err;?></span>
                        </div>
                        <!-- <div class="form-group">
                            <label>userID</label>
                            <textarea name="userID" class="form-control <?php echo (!empty($userID_err)) ? 'is-invalid' : ''; ?>"><?php echo $userID; ?></textarea>
                            <span class="invalid-feedback"><?php echo $userID_err;?></span>
                        </div> -->
                        <div class="form-group">
                            <label>date</label>
                            <input type="date" name="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
                            <span class="invalid-feedback"><?php echo $date_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>