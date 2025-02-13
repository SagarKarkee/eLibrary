document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const resultsDiv = document.getElementById('results');

    searchInput.addEventListener('input', function () {
        const query = searchInput.value;

        if (query.length >= 3) {
            fetch('../scripts/search_script.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `query=${query}`,
            })
                .then(response => response.text())
                .then(data => {
                    resultsDiv.innerHTML = data;
                });
        } else {
            resultsDiv.innerHTML = '';
        }
    });
});