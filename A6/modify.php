<?php
use FTP\Connection;
include ('database/connection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = OpenConnection();
    if(isset($_POST['update'])){
        $id = $_POST['id']; 
        $model = $_POST['model'];
        $engine_power = $_POST['engine_power'];
        $fuel = $_POST['fuel'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $age = $_POST['age'];
        $history_car = $_POST['history_car'];

        $stmt = $con->prepare("UPDATE cars SET model=?, engine_power=?, fuel=?, price=?, color=?, age=?, history_car=? WHERE cid=?"); 
        $stmt->bind_param("sisisisi", $model, $engine_power, $fuel, $price, $color, $age, $history_car, $id);
        $stmt->execute();
    }

    CloseConnection($con);
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

<section class="update_form">
    <form action="modify.php" method="post">
        <input id="id" type="hidden" name="id" value="<?=$id?>">
        <input id="model" type="text" name="model" placeholder="model">
        <input id="engine_power" type="text" name="engine_power" placeholder="engine">
        <input id="fuel" type="text" name="fuel" placeholder="fuel">
        <input id="price" type="text" name="price" placeholder="price">
        <input id="color" type="text" name="color" placeholder="color">
        <input id="age" type="text" name="age" placeholder="age">
        <input id="history_car" type="text" name="history_car" placeholder="history_car">
        <input id="update" type="submit" name="update" value="Update car">
    </form>
</section>

<section class="display_modify">
    <br>
    <table class="display-table">
        <thead>
            <th>ID</th>
            <th>Model</th>
            <th>Engine</th>
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
                            <button class='btnUpdate' type='button'>Update</button>
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
