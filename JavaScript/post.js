document.getElementById('postnummer').addEventListener('input', function() {
    var postnummer = this.value;
    // Check if the length of postnummer is exactly 4 characters
    if (postnummer.length === 4) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("poststed").value = this.responseText;
            }
        };
        xhttp.open("GET", "getPoststed.php?postnummer=" + postnummer, true);
        xhttp.send();
    } else {
        // Clear the poststed field if postnummer is not exactly 4 characters
        document.getElementById("poststed").value = "Feil postnummer";
    }
});
