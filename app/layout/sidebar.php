<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    
    <!-- Insert your CSS styles here -->
    <style>
        /* Body Styles */
        body {
            background: rgb(234, 234, 240);
            background: linear-gradient(90deg, rgba(234,234,240,1) 0%, rgba(79,10,167,0.9783653846153846) 100%, rgba(0,212,255,1) 100%);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            right: -250px; /* Initially hidden */
            width: 250px;
            height: 100vh; /* Full viewport height */
            background: linear-gradient(to bottom, #5910be8e 0%, #25081e83 100%); /* Gradient background */
            color: white;
            padding: 15px;
            transition: right 0.3s ease; /* Smooth transition for sliding */
            z-index: 1000; /* Ensure sidebar is on top of the content */
        }

        /* Sidebar links */
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            transition: background-color 0.3s ease; /* Add hover transition effect */
        }

        /* Hover effect for links in the sidebar */
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Slight hover effect */
        }

        /* Show sidebar */
        .sidebar.open {
            right: 0; /* Sidebar slides in */
        }

        /* For the overlay background when sidebar is open */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(150, 105, 202, 0.459); /* Slightly transparent overlay */
            display: none;
            z-index: 999; /* Overlay should be just below the sidebar */
        }

        .overlay.active {
            display: block; /* Show overlay when sidebar is open */
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="#"><i class="bi bi-house fs-2 me-3"></i> About</a>
        <a href="logout.php"><i class="bi bi-patch-question fs-2 me-3"></i> Logout</a>
    </div>

    <!-- Overlay (for background blur effect) -->
    <div class="overlay" id="overlay"></div>

    <!-- Example JavaScript for Sidebar Toggle -->
    <script>
        // Toggle sidebar visibility
        document.getElementById('sidebar-toggle-btn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('active');
        });
    </script>

</body>
</html>
