<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>My Todo List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<table>
    <tr>
        <th></th>
        <th class="taskname-column">Todo</th>
        <th></th>
    </tr>
    <?php
    foreach ($tasks as $task) {
        echo "<tr><form method='get' action=''><td>";
        echo "<input type='hidden' name='id' value='" . $task["id"] . "'>";
        if ($task["checked"]) {
            echo "<button class='btn-no-style' type='submit' name='action' value='uncheck'><i class='checked-icon fas fa-check'></i></button>";
        } else {
            echo "<button class='btn-no-style' type='submit' name='action' value='check'><i class='checked-icon-grey fas fa-check'></i></button>";
        }
        echo "</td><td class='" . ($task["checked"] ? 'checked' : '') . "'>";
        echo $task["name"];
        echo "</td><td>";

        echo "<button class='btn-no-style' type='submit' name='action' value='delete'><i class='trash-icon fas fa-trash'></i></button>";

        echo "</form>";
        echo "</td></tr>";
    }
    ?>
</table>

<form method="get" action="">
    <input type="text" name="name" autofocus="autofocus"/>
    <button type="submit" name="action" value="add">Add Item</button>
</form>

</body>
</html>
