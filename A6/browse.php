<?php
use FTP\Connection;
include ('database/connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cars Browser</title>
    <script type="text/javascript" src="browse.js"></script>
    <style>
        .center {
            text-align: center;
        }
    </style>
</head>
<body>

<button class="home" type="button" onclick="location.href='./index.html'">HOME </button>

<div id="previous-filter"></div>

<div class="center">
    <div id="main">

        <h1> Cars </h1>
        <div style="float: left;">
            <select id="select-model" name="Select Filter" onchange="get_filtered_by_model()">
                <?php
                    $con = OpenConnection();
                    $sql = "SELECT DISTINCT model FROM cars";
                    $result_set = $con->query($sql);

                    if(mysqli_num_rows($result_set) > 0){
                        while($row = mysqli_fetch_array($result_set)){
                            $model = $row['model'];
                            echo '<option>' . $model . '</option>';
                        }
                    }
                    CloseConnection($con);
                ?>
            </select>
        </div>

        <div style="float: right">
            <select id="select-color" name="Select Filter" onchange="get_filtered_by_color()">
                    <?php
                        $con = OpenConnection();
                        $sql = "SELECT DISTINCT color FROM cars";
                        $result_set = $con->query($sql);

                        if(mysqli_num_rows($result_set) > 0){
                            while($row = mysqli_fetch_array($result_set)){
                                $color = $row['color'];
                                echo '<option>' . $color . '</option>';
                            }
                        }
                        CloseConnection($con)
                    ?>
            </select>
        </div>

        <br />
        <br />

        <table id="browse-table" class="browse-table">
            <thead>
                <th>ID</th>
                <th>Model</th>
                <th>Engine Power</th>
                <th>Fuel</th>
                <th>Price</th>
                <th>Color</th>
                <th>Age</th>
                <th>History</th>
            </thead>
            <tbody id="browse-tbody">
                <?php
                    $con = OpenConnection();
                    $result_set = mysqli_query($con, "SELECT * FROM cars");

                    while($row = mysqli_fetch_array($result_set)){
                        echo " <tr>";
                        echo  "<td>" . $row['cid'] . "</td>";
                        echo  "<td>" . $row['model'] . "</td>";
                        echo  "<td>" . $row['engine_power'] . "</td>";
                        echo  "<td>" . $row['fuel'] . "</td>";
                        echo  "<td>" . $row['price'] . "</td>";
                        echo  "<td>" . $row['color'] . "</td>";
                        echo  "<td>" . $row['age'] . "</td>";
                        echo  "<td>" . $row['history_car'] . "</td>";
                        echo "</tr>";
                    }
                    CloseConnection($con)
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
