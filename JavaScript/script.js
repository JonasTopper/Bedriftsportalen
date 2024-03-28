function confirmDelete(id) {
    var confirmation = confirm("Are you sure you want to delete bedrift with ID " + id + "?")
    if (confirmation) {
        document.getElementById('deleteForm').submit();
    }
}