<nav>
    <a href="index.php" <?php if ($pathParts['filename'] == 'index') { echo 'class="activePage"'; } ?>>Home</a>
    <a href="menu.php" <?php if ($pathParts['filename'] == 'menu') { echo 'class="activePage"'; } ?>>Menu</a>
    <a href="contact.php" <?php if ($pathParts['filename'] == 'contact') { echo 'class="activePage"'; } ?>>Contact Page</a>
    <a href="form.php" <?php if ($pathParts['filename'] == 'form') { echo 'class="activePage"'; } ?>>Apply!</a>
</nav>