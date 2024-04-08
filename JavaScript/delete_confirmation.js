function confirmDeleteBedrift(bedriftnavn, id) {
    var confirmation = confirm(`Vil du slette ${bedriftnavn} med ID ${id}?`);

    if (confirmation) {
        window.location.href = `confirmdelete.php?bedriftid=${id}`;
    }
}

// Function to confirm deletion of an ansatte (employee)
function confirmDeleteAnsatte(ansattfnavn, ansattenavn, id) {
    // Display confirmation dialog with ansatte's first and last name and ID
    var confirmation = confirm(`Vil du slette ${ansattfnavn} ${ansattenavn} med ID ${id}?`);
    // If user confirms deletion, redirect to confirmdelete.php with ansatte ID
    if (confirmation) {
        window.location.href = `confirmdelete.php?ansattid=${id}`;
    }
}
