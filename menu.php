<?php include 'top.php'; ?>
<main>

    <section id ="grid-container">
        <h2 id = "menu-title">Explore our wide variety of dishes!</h2>
        <!-- Displaying Menu Items in a Table -->
        <table>
            <thead>
                <tr>
                    <th>Menu Item:</th>
                    <th>Description:</th>
                </tr>
            </thead>
            <tbody>
<?php 
$sql = 'SELECT type, name, description FROM menu_items'; 
$statement = $pdo->prepare($sql);
$statement->execute();
$records = $statement->fetchAll();
foreach ($records as $record) {
    print '<tr>';
    print '<td class="menu-item-name">' . htmlspecialchars($record['name']) . '</td>';
    print '<td class="menu-item-description">' . htmlspecialchars($record['description']) . '</td>';
    print '</tr>' . PHP_EOL;
}
?>

            </tbody>
        </table>
    </section>
</main>
<?php include 'footer.php'; ?>
