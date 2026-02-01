<!-- REVIEWS WITH DROPDOWN -->

<!DOCTYPE html>
<?php

// Connect to Database First
$conn = mysqli_connect("localhost", "establishments_user", "passw0rd", "establishments_db");

if (!$conn) {
    $errorMessage = "Connection Failed " . mysqli_connect_error();
} else {
    // Get establishment names from establishment table (for dropdown menu)
    $sql_statement = "SELECT establishment_name FROM establishment";
    $result = mysqli_query($conn, $sql_statement);

}
    // Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//Collect form data
    $establishment_name = $_POST['establishment_name'];
    $reviews =  $_POST['reviews'];
    $star_rating = $_POST['star_rating'];

    // Insert new form data
    $stmt = mysqli_prepare($conn, "INSERT INTO review (establishment_name, reviews, star_rating) VALUES (?, ?, ?)");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $establishment_name, $reviews, $star_rating);
            if (mysqli_stmt_execute($stmt)) {
                // Reload page after successful submission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
            mysqli_stmt_close($stmt);
        }
    }
//close connection
// mysqli_close($conn);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="styles3.css">
    <script>
        function toggleMenu() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script> <!-- Import jQuery: CDN -->
    
    <!-- DISPLAY USER REVIEWS -->
    <script>
    $(document).ready(function(){ // load document after the rest of the program is loaded
        var reviewCount = 5; //initially showing 5 reviews at once (count for increment)
        $("button").click(function(){//jQuery AJAX Function
            reviewCount = reviewCount + 5; //increment showings by 5 after each button click
            $("#review").load("displayReviews.php", { //link to review button, load display file
                reviewNewCount: reviewCount
            });
        });
    });
    </script>

</head>
<body>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <div class="sidebar">
        <ul>
            <a href="home.php"><li>Home</li></a>
            <a href="hotels.html"><li>Hotels</li></a>
            <a href="restaurants.html"><li>Restaurants</li></a>
            <a href="shopping.html"><li>Shopping</li></a>
            <a href="things to do.html"><li>Things to do</li></a>
            <a href="events.html"><li>Events</li></a>
            <a href="guideline.html"><li>Guidelines</li></a>
            <a href="history.html"><li>History</li></a>
            <a href="reviews.php"><li>Reviews</li></a>
            <a href="contacts.html"><li>Contacts</li></a>
        </ul>
    </div>

    <div class="container">
        <div class="header">
            <img src="https://images.squarespace-cdn.com/content/5f7c7de712dbbe4d2c21a154/1602771816048-F3U0A7XAMGGAEBOYGRBS/wolfville+logo_transparent+backgroud.png?format=1500w&content-type=image%2Fpng" alt="Wolfville Logo" class="logo">
        </div>

    <div class="container">
        <h1>Reviews</h1>


        <form class="review-form" method="POST">
            <select style="background-color: #8b4513; color: white; border: 1px solid transparent"
            name="establishment_name" id="establishment_name">
                <option value="">Select an Establishment</option>
                <?php
                // Check if the query returned results
                if ($result->num_rows > 0) {
                    // Output each row as an option in the dropdown
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row["establishment_name"] . "'>" . $row["establishment_name"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No categories available</option>";
                }
                ?>
            </select>
            <textarea name="reviews" placeholder="Write your review..." required></textarea>

        <!-- Star Rating Selection: use "name" to ensure only one option is selected -->
            <div class="star-rating">
                <input type="radio" id="star5" name="star_rating" value="★★★★★"><label for="star5">★</label>
                <input type="radio" id="star4" name="star_rating" value="★★★★"><label for="star4">★</label>
                <input type="radio" id="star3" name="star_rating" value="★★★"><label for="star3">★</label>
                <input type="radio" id="star2" name="star_rating" value="★★"><label for="star2">★</label>
                <input checked type="radio" id="star1" name="star_rating" value="★"><label for="star1">★</label> <!-- 1 star as default: "checked" -->
            </div>
            <button type="submit" name="submit">Submit Review</button>
        </form>

        <!-- Reviews Section -->
        <div class="review-list" id="review">
        <?php
            $sql = "SELECT * FROM review ORDER BY establishment_name LIMIT 5 "; //show 5 reviews at a time
            $resultReview = mysqli_query($conn, $sql);

            //pull reviews from review.sql database
            if (mysqli_num_rows($resultReview) > 0){
                while($row = mysqli_fetch_assoc($resultReview)){
                    echo'<div class="review">';
                        echo "<p>";

                        // echo '<div style="font-size: 20px">';
                            echo "<b>";
                            echo $row ['establishment_name'];
                            echo "</b>";
                            echo "<br>";
                        // echo '</div>'

                        echo $row['reviews'];
                        echo "<br>";

                        echo $row['star_rating'];
                        echo "<br>";
                        echo "</p>";
                    echo"</div>";
                }
            } else{
                echo "There are no reviews available.";
            }
        ?>
        </div>
        <button style="background: #8b4513; color: white; border: none; cursor: pointer; border-radius: 4px; padding: 10px">
        <b>Show More Reviews</b></button>
        <br><br>
        <a href="home.html">Back to Home</a>
    </div>
</body>
</html>

