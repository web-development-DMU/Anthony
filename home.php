<?php

$html_home = <<< HTMLFORM

<head><link rel="stylesheet" href="headerdesign.css"> </head>
   <head> <script src="script.js" defer></script> </head>

<body>
    <header>
        <div class="logo-title">
            <img src="logo.png" alt="University Logo" class="logo">
            <h1>Student Course Hub</h1>
        </div>
        <input type="text" id="search-bar" placeholder="Search...">
    </header>
    
    <nav>
        <ul>
            <button class="home-button" onclick="goHome()">Go to Home</button>
            <li><a href="student interface.html">Student-facing Interface</a></li>
            <li><a href="staff interface.html">Staff Interface</a></li>
            <li><a href="login.html">Login</a></li>
            
        </ul>
    </nav>
    
        <main>
            
        </main>
        
        
        
    </main>
    
    <footer>
        <p>&copy; 2025 Student Course Hub</p>
        <marquee>Stay updated with the latest programme news and deadlines!</marquee>
        <p>Contact us: info@university.ac.uk</p>
    </footer>
    
    <script>
        function showCourses(level) {
            document.getElementById('course-container').style.display = 'flex';
        }
        function toggleModules(courseId) {
            let modules = document.getElementById(courseId);
            modules.style.display = modules.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>

?>
HTMLFORM;
