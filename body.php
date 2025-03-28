<?php
$page_footer = <<<FOOTER

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
    <!-- Main content goes here -->
</main>

FOOTER;

echo $page_footer;
?>