// Real-time search using AJAX
document.getElementById('searchInput').addEventListener('input', function(e) {
    const query = e.target.value;
    fetch(`search.php?q=${query}`)
      .then(response => response.json())
      .then(books => displayResults(books));
  });
  
  // PHP backend (search.php)
  $query = $_GET['q'];
  $results = $db->query("SELECT * FROM books WHERE title LIKE '%$query%'");
  echo json_encode($results);