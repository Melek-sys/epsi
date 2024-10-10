document.addEventListener('DOMContentLoaded', function () {
    // Example for form handling in 'contact.php'
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function (event) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            
            if (name === "" || email === "") {
                alert('Please fill out all fields.');
                event.preventDefault();
            }
        });
    }
});
