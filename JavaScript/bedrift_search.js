document.addEventListener("DOMContentLoaded", function() {
    var bedriftSearchInput = document.getElementById("bedrift_search");
    var bedriftIdInput = document.getElementById("bedrift_id");

    // Event listener for input changes in the bedrift search field
    bedriftSearchInput.addEventListener("input", function() {
        var searchQuery = bedriftSearchInput.value.trim();

        // If the search query is empty, clear the bedrift ID and return
        if (searchQuery === "") {
            bedriftIdInput.value = "";
            return;
        }

        // Make an AJAX request to search for the bedrift based on the input
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var bedriftData = JSON.parse(this.responseText);
                if (bedriftData && bedriftData.id) {
                    // If a bedrift is found, populate the bedrift ID input field
                    bedriftIdInput.value = bedriftData.id;
                } else {
                    // If no bedrift is found, clear the bedrift ID input field
                    bedriftIdInput.value = "";
                }
            }
        };
        xhttp.open("GET", "searchBedrift.php?q=" + searchQuery, true);
        xhttp.send();
    });
});