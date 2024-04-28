<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHG Search</title>
</head>
<body>
    <h1>Search SHGs</h1>

    <!-- Form for Duare Sarkar search -->
    <form action="" method="GET">
        <label for="query_duare">Enter SHG Name or ID (Duare Sarkar):</label><br>
        <input type="text" id="query_duare" name="query_duare">
        <button type="submit">Search</button>
        <input type="hidden" name="search_type" value="duare_sarkar">
    </form>

    <!-- PHP code for Duare Sarkar search -->
    <?php
    if (isset($_GET['query_duare']) && isset($_GET['search_type']) && $_GET['search_type'] === 'duare_sarkar') {
        // Duare Sarkar search logic
        $query_duare = $_GET['query_duare'];
        // Perform search and display results
        echo "<p>Duare Sarkar search results for: $query_duare</p>";
    }
    ?>

    <!-- Form for SHG NRLM search -->
    <form action="" method="GET">
        <label for="query_shg_nrlm">Enter SHG Name or ID (SHG NRLM):</label><br>
        <input type="text" id="query_shg_nrlm" name="query_shg_nrlm">
        <button type="submit">Search</button>
        <input type="hidden" name="search_type" value="shg_nrlm">
    </form>

    <!-- PHP code for SHG NRLM search -->
    <?php
    if (isset($_GET['query_shg_nrlm']) && isset($_GET['search_type']) && $_GET['search_type'] === 'shg_nrlm') {
        // SHG NRLM search logic
        $query_shg_nrlm = $_GET['query_shg_nrlm'];
        // Perform search and display results
        echo "<p>SHG NRLM search results for: $query_shg_nrlm</p>";
    }
    ?>
</body>
</html>
