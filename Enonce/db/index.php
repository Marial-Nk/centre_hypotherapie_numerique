<?php 
require_once 'Db.php';
$db = new Db();
$users = $db->findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h2>Esa Crud</h2>
        <a href="create.php" role="button" class="outline">Ajouter</a>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Action</th>    
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->nom ?></td>
                    <td><?= $user->prenom ?></td>
                    <td><?= $user->email ?></td>
                    <td></td>
                </tr>
                
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>
    
</body>
</html>
