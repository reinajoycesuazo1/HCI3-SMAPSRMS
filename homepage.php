<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Homepage</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="homepage.css" />
    <link rel="stylesheet" href="sacraments-nav.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="communion.css" />
    <script src="script.js"></script>
    <style>
        #main-content .welcome-container {
            max-width: 600px;
            margin: 50px auto;
            background:rgb(69, 70, 70);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(215, 214, 214, 0.1);
            padding: 25px 20px;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            color:rgb(255, 255, 255);
            border: 1rem solid rgb(255, 255, 255);
        }
        #main-content .welcome-container h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            color:rgb(255, 255, 255);
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }
        #main-content .welcome-container p {
            font-size: 1.2rem;
            font-weight: 500;
            color:rgb(255, 255, 255);
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navButtons = document.querySelectorAll(".nav-container nav ul li button");
            const mainContent = document.getElementById("main-content");

            function loadPage(url) {
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.text();
                    })
                    .then(html => {
                        mainContent.innerHTML = html;
                    })
                    .catch(error => {
                        mainContent.innerHTML = "<p>Error loading content: " + error.message + "</p>";
                    });
            }

            navButtons.forEach(button => {
                button.addEventListener("click", function (e) {
                    e.preventDefault();
                    const form = this.closest("form");
                    if (form) {
                        const action = form.getAttribute("action");
                        loadPage(action);
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');

            function performSearch() {
                const query = searchInput.value.trim();
                if (query.length === 0) {
                    // Optionally, clear search results or reload default content
                    mainContent.innerHTML = `
                        <div class="welcome-container">
                            <h2>Welcome to the Homepage</h2>
                            <p>Select an option from the navigation menu above.</p>
                        </div>
                    `;
                    return;
                }
                const url = 'search_records.php?q=' + encodeURIComponent(query);
                loadPage(url);
            }

            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                performSearch();
            });

            // Load default page on initial load with aesthetic welcome message
            mainContent.innerHTML = `
                <div class="welcome-container">
                    <h2>Welcome to the Homepage</h2>
                    <p>Select an option from the navigation menu above.</p>
                </div>
            `;
        });
    </script>
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo-left">
                <img src="img/leftlogo.png" alt="Parish Logo" />
            </div>
            <h1>Saint Michael the Archangel Parish Sacramental Records Management System</h1>
            <div class="logo-right">
                <img src="img/rightlogo.png" alt="Right Logo" />
            </div>
        </div>
    </header>

    <div class="nav-container">
        <div class="search-bar">
            <form id="searchForm" action="search_records.php" method="get" onsubmit="event.preventDefault(); performSearch();">
                <input type="text" id="searchInput" name="q" placeholder="Search here..." autocomplete="off" />
                <button type="submit">
                    <img src="img/search.png" alt="Search" />
                </button>
            </form>
        </div>
        <nav>
            <ul>
                <li>
                    <form action="dashboard.php" method="get">
                        <button type="submit" style="background: none; border: none; text-align: center;">
                            <img src="img/dashboard.png" alt="Dashboard Icon" style="width: 25px; height: 30px; display: block; margin: 0 auto;" />
                            Dashboard
                        </button>
                    </form>
                </li>
                <li>
                    <form action="registration_options.php" method="get">
                        <button type="submit" style="background: none; border: none; text-align: center;">
                            <img src="img/registration.png" alt="Registration Icon" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            Registration
                        </button>
                    </form>
                </li>
                <li>
                    <form action="baptismalRec.php" method="get">
                        <button type="submit" style="background: none; border: none; text-align: center;">
                            <img src="img/baptism.png" alt="Baptism Icon" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            Baptism
                        </button>
                    </form>
                </li>
                <li>
                    <form action="communion.php" method="get">
                        <button type="submit" style="background: none; border: none; text-align: center;">
                            <img src="img/communion.png" alt="Communion Icon" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            Communion
                        </button>
                    </form>
                </li>
                <li>
                    <form action="confirmation_records.php" method="get">
                        <button type="submit" style="background: none; border: none; text-align: center;">
                            <img src="img/confirmation.png" alt="Confirmation Icon" style="width: 35px; height: 30px; display: block; margin: 0 auto;" />
                            Confirmation
                        </button>
                    </form>
                </li>
                <li>
                    <form action="marriageRec.php" method="get">
                        <button type="submit" style="background: none; border: none; text-align: center;">
                            <img src="img/marriage.png" alt="Marriage Icon" style="width: 35px; height: 30px; display: block; margin: 0 auto;" />
                            Marriage
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="profile-container">
            <img src="img/profile.png" alt="Profile Icon" class="profile-icon" />
            <div class="admin-dropdown" id="adminDropdown">
                <span class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <div class="dropdown-content">
                    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Log out</a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div id="main-content" class="main-content">
            <!-- Dynamic content will be loaded here -->
        </div>
    </main>

    <footer>
        <p>Copyright &copy; SMAP 2025. smap.com. All Rights Reserved | <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>
