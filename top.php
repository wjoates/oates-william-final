<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts = pathinfo($phpSelf);
?>
<!DOCTYPE HTML> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Ahli Babas </title>
    <meta name="author" content="William Oates">
    <meta name="description" content="Ahli Baba's Kabob Shop's webiste.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lateef&display=swap" rel="stylesheet">
    <link href = "css/custom.css?version=<?php print time(); ?>"
        rel = "stylesheet"
        type = "text/css">
    <link href = "css/layout-desktop.css?version=<?php print time(); ?>"
        rel="stylesheet"
        type = "text/css">
    <link href = "css/layout-tablet.css?version=<?php print time(); ?>"
        media = "(max-width: 920px)"
        rel="stylesheet"
        type = "text/css">
    <link href = "css/layout-phone.css?version=<?php print time(); ?>"
        media = "(max-width: 430px)"
        rel = "stylesheet"
        type = "text/css">
</head>

<?php
print '<body class="' . $pathParts ['filename'] . '">';
print '<!-- ################# Body element ################# -->';
include 'database-connect.php';
include 'header.php';
include 'nav.php';
?>