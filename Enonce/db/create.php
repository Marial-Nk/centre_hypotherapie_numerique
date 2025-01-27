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
<form action="store.php" method="post">
    <label for="name">Nom</label>
    <input type="text" name="nom" id="name">
    <label >Prenom</label>
    <input type="text" name="prenom" id="name">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <input type="submit" value="Ajouter">
</form> 
</main>  
</body>
</html>
