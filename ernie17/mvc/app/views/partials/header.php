<header>
    <span class="header-title"><?php echo $_SESSION['page_name'] . " - " . $viewbag['user']['firstname'] . $viewbag['user']['lastname']; ?></span>
    <nav>
        <ul>
            <li><a href="pictures">Pictures</a></li>
            <li><a href="upload">Upload</a></li>
            <li><a href="users">Users</a></li>
        </ul>
    </nav>
</header>
