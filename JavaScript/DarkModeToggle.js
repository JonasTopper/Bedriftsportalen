const darkModeTogle = document.getElementById('darkModeToggle');
darkModeToggle.addEventListener('change', () => {
    document.body.classList.toggle('dark-mode');
});

function logout() {
    window.location.href = '../Innlogging/logout.php';
}