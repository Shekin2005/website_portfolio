<!-- TABLE OF REVIEWS -->
<!DOCTYPE html>
<?php
    $con = mysqli_connect("localhost", "establishments_user", "passw0rd", "establishments_db");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // Initialize search query
    $search = "";
    if (isset($_GET['search'])){
        $search = mysqli_real_escape_string($con, $_GET['search']);
    }

    $sql_statement = "SELECT review_id, establishment_name, reviews, star_rating FROM review";
    if (!empty($search)) {
        $sql_statement .= " WHERE review_id LIKE '%$search%'
                            OR establishment_name LIKE '%$search%'
                            OR reviews LIKE '%$search%'
                            OR star_rating LIKE '%$search%'";
    }
    $sql_statement .= " ORDER BY establishment_name ASC LIMIT 100";

    $result = mysqli_query($con, $sql_statement);
    //echo "Number of returned rows: " . mysqli_num_rows($result);
?>

<html>
    <head>
        <title>REVIEWS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            
            <h1>Establishment Reviews: </h1>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Review ID</th>
                        <th>Establishment Name</th>
                        <th>Review</th>
                        <th>Star Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['review_id'] . "</td>";
                        echo "<td>" . $row['establishment_name'] .  "</td>";
                        echo "<td>" . $row['reviews'] .  "</td>";
                        echo "<td>" . $row['star_rating'] .  "</td>";
                        echo "</tr>";
                    }
                    // Free result set
                    mysqli_free_result($result);
                    mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>