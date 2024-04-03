function confirmDeleteBedrift(bedriftnavn, id) {
    var confirmation = confirm(`Vil du slette ${bedriftnavn} med ID ${id}?`);
    if (confirmation) {
        window.location.href = `confirmdelete.php?bedriftid=${id}`;
    }
}

function confirmDeleteAnsatte(ansattfnavn, ansattenavn, id) {
    var confirmation = confirm(`Vil du slette ${ansattfnavn} ${ansattenavn} med ID ${id}?`);
    if (confirmation) {
        window.location.href = `confirmdelete.php?ansattid=${id}`;
    }
}