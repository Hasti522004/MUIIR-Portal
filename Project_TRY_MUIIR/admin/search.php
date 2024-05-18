<?php
// Database connection
require_once "config.php";

// Get the search query
$searchText = $_POST['query'];

// Lookup data from database
$stmt = $conn->prepare("SELECT * FROM users WHERE grno LIKE CONCAT('%',?,'%')");
$stmt->execute(array($searchText));
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate response
if(!empty($result)){
	echo "<table class='search-results'>";
	echo "<tr><th>GR No.</th><th>First Name</th><th>Username</th></tr>";
	foreach ($result as $row) {
		echo "<tr><td>" . $row["grno"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["username"] . "</td></tr>";
	}
	echo "</table>";
} else {
	echo "<p>No results found.</p>";
}
?>

<style>
	table.search-results {
		border-collapse: collapse;
		width: 100%;
	}
	
	table.search-results td, table.search-results th {
		border: 1px solid #ddd;
		padding: 8px;
		text-align: left;
	}
	
	table.search-results th {
		background-color: #f2f2f2;
		color: #555;
	}
	
	table.search-results tr:nth-child(even) {
		background-color: #f2f2f2;
	}
	
	table.search-results tr:hover {
		background-color: #ddd;
	}
</style>
