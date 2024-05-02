<?php
use FTP\Connection;

include ('database/connection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connection = OpenConnection();
    $id = $connection->real_escape_string($_POST['id']);
    $stmt = $connection->prepare("DELETE FROM cars WHERE cid=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    CloseConnection($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cars Processing </title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="script.js"></script>
</head>

<body>
<button class="home" type="button" onclick="location.href='./index.html'">HOME </button>
<br>

<section class="display_delete">
    <br>
    <table class="display-table">
        <thead>
            <th>ID</th>
            <th>Model</th>
            <th>Engine Power</th>
            <th>Fuel</th>
            <th>Price</th>
            <th>Color</th>
            <th>Age</th>
            <th>History</th>
            <th> </th>
        </thead>
        <tbody>

            <?php
            $con = OpenConnection();
            $result_set = mysqli_query($con, "SELECT * FROM cars");
            
            while($row = mysqli_fetch_array($result_set)){
                echo "<tr>";
                echo  "<td>" . $row['cid'] . "</td>";
                echo  "<td>" . $row['model'] . "</td>";
                echo  "<td>" . $row['engine_power'] . "</td>";
                echo  "<td>" . $row['fuel'] . "</td>";
                echo  "<td>" . $row['price'] . "</td>";
                echo  "<td>" . $row['color'] . "</td>";
                echo  "<td>" . $row['age'] . "</td>";
                echo  "<td>" . $row['history_car'] . "</td>";
                echo  "<td> 
                            <button class='btnDelete' type='button'>Delete</button>
                      </td>
                      </tr>";
            }
            CloseConnection($con);
            ?>

        </tbody>
    </table>
</section>

</body>
</html>
