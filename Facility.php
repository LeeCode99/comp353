<HTML>

<HEAD>
    <TITLE>Health Facility Employee Status Tracking System</TITLE>
</HEAD>

<BODY>
<h1>Health Facility Employee Status Tracking System</h1>
<?php include "menu.php"?>
<h2>Facilities Information</h2>
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

$sql = "select facility_id, name, address, city, type, province, webaddress, postal_code, telephone, capacity
from Facilities";
$result = $conn->query($sql);

echo "<form method='GET' action='CUEDFacility.php?'>";
echo "<input type='submit' name='Actions' value='Create'>";
if ($result->num_rows > 0) {
    echo "<table border='1 solid black'> 
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Address</th>
    <th>City</th>
    <th>Type</th>
    <th>Province</th>
    <th>Web address</th>
    <th>Postal code</th>
    <th>Telephone</th>
    <th>Capacity</th>
    <th>Actions</th>
</tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<th>".$row["facility_id"]."</th>";
        echo "<th>".$row["name"]."</th>";
        echo "<th>".$row["address"]."</th>";
        echo "<th>".$row["city"]."</th>";
        echo "<th>".$row["type"]."</th>";
        echo "<th>".$row["province"]."</th>";
        echo "<th>".$row["webaddress"]."</th>";
        echo "<th>".$row["postal_code"]."</th>";
        echo "<th>".$row["telephone"]."</th>";
        echo "<th>".$row["capacity"]."</th>";
        echo "<th><a href=CUEDFacility.php?FID=".$row["facility_id"]."&Actions=Edit>Edit
                <a href=CUEDFacility.php?FID=".$row["facility_id"]."&Actions=Delete>Delete
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