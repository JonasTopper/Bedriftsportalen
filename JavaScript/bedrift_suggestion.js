// Get the search input element
var searchInput = document.getElementById('bedrift_search');

// Function to clear the search input and suggestions
function clearSearch() {
    searchInput.value = '';
    document.getElementById('bedrift_id').value = '';
    document.getElementById('bedrift_suggestions').innerHTML = '';
}

// Function to fetch and display suggestions
function autocomplete() {
    var input = searchInput.value.trim();
    var suggestionsContainer = document.getElementById('bedrift_suggestions');

    // Clear suggestions if input is empty
    if (input.length === 0) {
        suggestionsContainer.innerHTML = '';
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var suggestions = JSON.parse(xhr.responseText);
            suggestionsContainer.innerHTML = '';
            suggestions.forEach(function(suggestion) {
                var div = document.createElement('div');
                div.textContent = suggestion.bedrift_navn;
                // Set onclick behavior to fill search input and hidden field with selected suggestion
                div.onclick = function() {
                    searchInput.value = suggestion.bedrift_navn;
                    document.getElementById('bedrift_id').value = suggestion.bedrift_id;
                    suggestionsContainer.innerHTML = '';
                };
                suggestionsContainer.appendChild(div);
            });
        }
    };
    // Send AJAX request to get suggestions based on input
    xhr.open('GET', 'getBedriftSuggestions.php?query=' + input, true);
    xhr.send();
}

// Event listener for input event
searchInput.addEventListener('input', function() {
    autocomplete();
    // Show clear button when input is not empty
    document.querySelector('.clear-btn').style.display = this.value ? 'block' : 'none';
});
