<HTML>

<HEAD>
    <TITLE>Health Facility Employee Status Tracking System</TITLE>
</HEAD>

<BODY>
<h1>Health Facility Employee Status Tracking System</h1>
<?php include "menu.php"?>
<h2>Vaccination Information</h2>
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

$sql = "select Vaccination_Reference_Num, VaccineType from Vaccines;";
$result = $conn->query($sql);

echo "<form method='GET' action='CUEDVaccination.php'>";
echo "<input type='submit' name='Actions' value='Create'>";
if ($result->num_rows > 0) {
    echo "<table border='1 solid black'> 
    <tr>
    <th>Vaccination Reference Number</th>
    <th>Vaccination Type</th>
    <th>Actions</th>
</tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<th>".$row["Vaccination_Reference_Num"]."</th>";
        echo "<th>".$row["VaccineType"]."</th>";
        echo "<th><a href=CUEDVaccination.php?FID=".$row["Vaccination_Reference_Num"]."&Actions=Edit>Edit
                <a href=CUEDVaccination.php?FID=".$row["Vaccination_Reference_Num"]."&Actions=Delete>Delete
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
</HTML>