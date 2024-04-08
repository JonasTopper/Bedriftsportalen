// Function to confirm deletion of a bedrift with a given ID
function confirmDelete(id) {
    // Display a confirmation dialog
    var confirmation = confirm("Are you sure you want to delete bedrift with ID " + id + "?");
    // If the user confirms deletion
    if (confirmation) {
        // Submit the delete form
        document.getElementById('deleteForm').submit();
    }
}
