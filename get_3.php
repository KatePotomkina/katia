<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #FFFFFF;
            border-radius: 3px;
           
         align-items: center
        }
    </style>
</head>
<body>
    <?php
    include('connect.php');

    $shift = $_GET['shift'];

    try {
        $sqlSelect = "SELECT nurse.name, ward.name, department, shift FROM nurse, ward, nurse_ward WHERE 
        shift=? AND id_ward=fid_ward AND fid_nurse=id_nurse";

        $stmt = $dbh->prepare($sqlSelect);

        $stmt->bindValue(1,$shift);
        $stmt->execute();
        $res = $stmt->fetchAll();

        echo "<table border='1'";
        echo "<thead><tr><th>nurse.name</th><th>ward.name</th><th>department</th><th>shift</th></tr></thead>";
        echo "<tbody>";

        foreach($res as $row)
        {
            echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
    }
    catch(PDOException $ex) {
        echo $ex->GetMessage();
    }
    $dbh = null;
    ?>
</body>
</html>