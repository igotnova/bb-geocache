<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">jouw geo caches</h2>
                        <a href="includes\php\crudLocatie\createDate.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> voeg een cache toe</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "db_config.php";
                    
                    $userID = $_SESSION['userID'];

                    // Attempt select query execution
                    $sql = "SELECT * FROM reservation where userID = '$userID'";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>location</th>";
                                        echo "<th>date</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['reservationID'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="includes\php\crudLocatie\readDate.php?reservationID='. $row['reservationID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="includes\php\crudLocatie\updateDate.php?reservationID='. $row['reservationID'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="includes\php\crudLocatie\deleteDate.php?reservationID='. $row['reservationID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    $mysqli->close();
                    ?>
                </div>
            </div>        
        </div>
    </div>