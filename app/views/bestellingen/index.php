<h1>Bestellingen</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Klant</th>
            <th>Status</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bestellingen as $bestelling): ?>
        <tr>
            <td><?php echo $bestelling->id; ?></td>
            <td><?php echo $bestelling->klant; ?></td>
            <td><?php echo $bestelling->status; ?></td>
            <td>
                <a href="show.php?id=<?php echo $bestelling->id; ?>">Bekijk</a>
                <a href="edit.php?id=<?php echo $bestelling->id; ?>">Bewerk</a>
                <a href="delete.php?id=<?php echo $bestelling->id; ?>">Verwijder</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>