// script.js

// Listen for form submission
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Stop the form from actually submitting
    window.location.href = 'homepage.html'; // Redirect to homepage.html
});
