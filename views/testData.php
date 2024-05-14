<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>
    <?php
    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=localhost;dbname=testdb1", "root", "2222");

        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



        // If no exception is thrown, the connection is successful
        echo "connection established<br>";



        $stmt = $pdo->prepare("SELECT * FROM signal");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row)
                echo "Name: " . $row['name'] . ", Address: " . $row['address'] . "<br>";


    } catch (PDOException $e) {
        // Handle PDO exceptions
        echo "Connection failed: " . $e->getMessage();
    }
    ?>

</h1>


</body>
</html>

<?php
