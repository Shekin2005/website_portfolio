
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

    $sql_statement = "SELECT establishment_name, rating, establishment_address, category FROM establishment";
    if (!empty($search)) {
        $sql_statement .= " WHERE establishment_name LIKE '%$search%'
                            OR rating LIKE '%$search%'
                            OR establishment_address LIKE '%$search%'
                            OR category LIKE '%$search%'";
    }
    $sql_statement .= " ORDER BY rating DESC LIMIT 100";

    $result = mysqli_query($con, $sql_statement);
    //echo "Number of returned rows: " . mysqli_num_rows($result);
?>

<html>
    <head>
        <title>ESTABLISHMENTS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            <h1 class="mb-4">Establishments: </h1>

            <form method="GET" class="mb-3">
                <input type="text" name="search" class="form-control" placeholder="Names, Ratings, Address, Categories" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary mt-2">Search</button>
            </form>

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Ratings</th>
                        <th>Address</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['establishment_name'] . "</td>";
                        echo "<td class='title'>" . $row['rating'] .  "</td>";
                        echo "<td>" . $row['establishment_address'] .  "</td>";
                        echo "<td>" . $row['category'] .  "</td>";
                        echo "</tr>";
                    }
                    }else{
                        echo "<tr><td colspan='5'>No results found</td></tr>";
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