<HTML>

<HEAD>
    <TITLE>Health Facility Employee Status Tracking System</TITLE>
</HEAD>

<BODY>
<<<<<<< HEAD
<h1>Health Facility Employee Status Tracking System</h1>
<?php include "menu.php"?>
<h2>Infection Information</h2>
<?php
$servername = "qac353.encs.concordia.ca";
$username = "qac353_4";
$password = "ptkg7903";
$dbname = "qac353_4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select Infection_Reference_Num, Infection_Type
from Infections";
$result = $conn->query($sql);

echo "<form method='GET' action='CUEDInfection.php?'>";
echo "<input type='submit' name='Actions' value='Create'>";
if ($result->num_rows > 0) {
    echo "<table border='1 solid black'> 
=======
    <h1>Health Facility Employee Status Tracking System</h1>
    <?php include "menu.php" ?>
    <h2>Infection Information</h2>
    <?php
    $servername = "qac353.encs.concordia.ca";
    $username = "qac353_4";
    $password = "ptkg7903";
    $dbname = "qac353_4";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select Infection_Reference_Num, Infection_Type
from Infections";
    $result = $conn->query($sql);

    echo "<form method='GET' action='CUEDInfection.php?'>";
    echo "<input type='submit' name='Actions' value='Create'>";
    if ($result->num_rows > 0) {
        echo "<table border='1 solid black'> 
>>>>>>> giwon
    <tr>
    <th>Infection Reference Number</th>
    <th>Infection Type</th>
</tr>";
<<<<<<< HEAD
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<th>".$row["Infection_Reference_Num"]."</th>";
        echo "<th>".$row["Infection_Type"]."</th>";
        echo "<th><a href=CUEDInfection.php?FID=".$row["Infection_Reference_Num"]."&Actions=Edit>Edit
                <a href=CUEDInfection.php?FID=".$row["Infection_Reference_Num"]."&Actions=Delete>Delete
                </th>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}
echo "</form>";
$conn->close();
?>
</BODY>
=======
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th>" . $row["Infection_Reference_Num"] . "</th>";
            echo "<th>" . $row["Infection_Type"] . "</th>";
            echo "<th><a href=CUEDInfection.php?FID=" . $row["Infection_Reference_Num"] . "&Actions=Edit>Edit
                <a href=CUEDInfection.php?FID=" . $row["Infection_Reference_Num"] . "&Actions=Delete>Delete
                </th>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</form>";
    $conn->close();
    ?>
</BODY>

>>>>>>> giwon
</HTML>