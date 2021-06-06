<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Geo locaties</h2>
                    </div>
                    <?php
                    // Include config file
                    require_once "db_config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM `reservation` WHERE `status` = 1";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>location</th>";
                                        echo "<th>date</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['reservationID'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
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