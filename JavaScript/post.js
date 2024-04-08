// Listen for input events on the postnummer field
document.getElementById('postnummer').addEventListener('input', function() {
    var postnummer = this.value;
    // Check if the length of postnummer is exactly 4 characters
    if (postnummer.length === 4) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            // If the request is completed and successful
            if (this.readyState == 4 && this.status == 200) {
                // Update the poststed field with the response
                document.getElementById("poststed").value = this.responseText;
            }
        };
        // Send a GET request to getPoststed.php with postnummer as a parameter
        xhttp.open("GET", "getPoststed.php?postnummer=" + postnummer, true);
        xhttp.send();
    } else {
        // Clear the poststed field and display an error message
        document.getElementById("poststed").value = "Feil postnummer";
    }
});
