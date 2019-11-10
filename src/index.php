<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="layout.css" rel="stylesheet">
</head>
<body>
  <form action="apology.php" method="POST">
    <input type="text" name="fullname" placeholder="Name">
    <input type="text" name="address" placeholder="Adresse">
    <select name="type">
      <option value="minutes" selected>Minuten</option>
      <option value="days">Tage</option>
    </select>
    <button>Erstellen</button>
  </form>
</body>
</html>