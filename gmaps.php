<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "maps";

$conn = mysqli_connect($host, $username, $password, $db);

if (mysqli_connect_error()) {
    die("connection failed". $conn->connect_error());
}



// 1. Check if a search query was submitted
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Use prepared statements or escaping to prevent SQL injection
    $search_term = "%$search%";
    $sql = "SELECT * FROM ggg WHERE country_name LIKE ? OR capital_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Default view: Show everything
    $sql = "SELECT * FROM ggg";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-inner img {
            padding: 5%;
            margin-left: 5%;
            width: 90%;
            object-fit: contain;
        }
        .name {
            text-align: center;
            margin-bottom: 3%;
            font-size: 25px;
        }
        .search-container {
            max-width: 60%;
            margin: 2% auto;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="search-container">
        <form action="" method="GET" class="d-flex">
            <input class="form-control me-2" type="search" name="search" 
                   placeholder="Search for a country or capital..." 
                   value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-primary" type="submit">Search</button>
            <?php if($search): ?>
            <?php endif; ?>
        </form>
    </div>

    <div style="margin: 0 10%; border: 5px solid black; margin-top: 3%;">
        <div id="carouselExampleFade" class="carousel slide">
            <div class="carousel-inner">
                <?php
                $first = true;
                if ($result->num_rows > 0) {
                    while($country = $result->fetch_assoc()) {
                ?>
                    <div class="carousel-item <?php if($first){echo 'active'; $first = false;}?>">
                        <img src="img/<?php echo $country['country_image']; ?>" alt="Country Image" height="500">
                        <div class="name">
                            <?php echo $country['country_name']; ?> <br> 
                            Capital: <?php echo $country['capital_name']; ?>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo "<div class='p-5 text-center'>No results found for '$search'</div>";
                }
                ?>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" style="background-color:black;" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" style="background-color:black;" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>