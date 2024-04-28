<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHG Search</title>

<body>
    <!-- <img class = "bg-img" src="/img/Background.webp" alt="background image" style="height:100vh; width:100vw; object-fit: cover;"> -->
    
    <section style="background-image: url(/img/Background.webp);">
        <h1>Search SHGs</h1>
        <form action="" method="GET">
                <label for="query">Enter SHG Name or ID:</label><br>
                <input type="text" id="query" name="query">
                <button type="submit">Search</button>
        </form>

        <?php
        // Function to check if a string is numeric
        function isNumericString($str) {
            return preg_match('/^[0-9]+$/', $str);
        }

        // Check if the search query is submitted
        if (isset($_GET['query'])) {
            $query = $_GET['query'];
    //  $pdo = new PDO('mysql:host=localhost;dbname=shg_database', $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    // echo "db_user";	
        $pdo = new PDO('mysql:host=localhost;dbname=shg_database', 'admin', '834800159799951');
            // Check if the query is numeric (assuming it's an ID)
            if (isNumericString($query)) {
                // Search by ID
                $statement = $pdo->prepare("SELECT village, name FROM shgs WHERE shg_id = :query");
                $statement->execute(['query' => $query]);
                $row = $statement->fetch(PDO::FETCH_ASSOC);

                // Display search result
                if ($row) {
                    echo "<p>Village: {$row['village']}</p>";
                    echo "<p>SHG Name: {$row['name']}</p>";
                } else {
                    echo "<p>No SHG found with shg_id: $query</p>";
                }
            } else {
                // Search by SHG name (varchar)
                $query = "%$query%"; // Add wildcards to search for partial matches
                $statement = $pdo->prepare("SELECT shg_id, name, village FROM shgs WHERE name LIKE :query");
                $statement->execute(['query' => $query]);
                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

                // Display search result
                if ($rows) {
                    echo "<p>Search Results:</p>";
                    foreach ($rows as $row) {
                        echo "<p>ID: {$row['shg_id']}</p>";
                        echo "<p>Village: {$row['village']}</p>";
                        echo "<p>SHG Name: {$row['name']}</p>";
                        echo "<hr>";
                    }
                } else {
                    echo "<p>No SHG found with the name: $query</p>";
                }
            }
        }
        ?>
    </section>
</body>
</html>