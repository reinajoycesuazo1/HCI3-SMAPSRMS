document.addEventListener("DOMContentLoaded", function () {
    console.log("Profile dropdown script loaded");

    const passwordInput = document.getElementById("password"); // Kuhaon ang password input field
    const eyeIcon = document.querySelector(".eye-icon"); // Kuhaon ang eye icon para sa show/hide password
    const loginForm = document.querySelector("form"); // Kuhaon ang login form

    // ✅ Fix: Ensure eye icon works correctly
    if (eyeIcon && passwordInput) {
        eyeIcon.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text"; // Pakita ang password
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password"; // Tagò ang password
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        });
    }

    // Form validation (Check kung naay sulod ang username ug password)
    loginForm.addEventListener("submit", function (event) {
        const username = document.getElementById("username").value.trim(); // Kuhaon ang username
        const password = passwordInput.value.trim(); // Kuhaon ang password

        if (username === "" || password === "") {
            alert("Please enter both username and password."); // Warning kung walay sulod
            event.preventDefault(); // Dili ipadayon ang pag-submit sa form
        }
    });

    // Profile dropdown functionality
    const profileDropdown = document.getElementById('profileDropdown');
    console.log("Profile dropdown element found");

    // Toggle dropdown visibility on click
    profileDropdown.addEventListener('click', function(event) {
        const dropdownContent = profileDropdown.querySelector('.dropdown-content');
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!profileDropdown.contains(event.target)) {
            const dropdowns = document.getElementsByClassName('dropdown-content');
            for (let i = 0; i < dropdowns.length; i++) {
                dropdowns[i].style.display = 'none';
            }
        }
    });
});
