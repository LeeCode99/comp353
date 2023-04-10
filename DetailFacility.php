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

$sqlF = "SELECT Name, Address, City, Province, Postal_code, Telephone, WebAddress, Type
        FROM Facilities
        WHERE Facility_ID =".$_GET["FID"].";";
$resultF = $conn->query($sqlF);
if ($resultF->num_rows > 0){
    echo "<table>";
     while ($rowF = $resultF->fetch_assoc()) {
         echo "<tr>";
         echo "<th>Name:</th>";
         echo "<td>".$rowF["Name"]."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<th>Address:</th>";
         echo "<td>".$rowF["Address"]."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<th>City:</th>";
         echo "<td>".$rowF["City"]."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<th>Province:</th>";
         echo "<td>".$rowF["Province"]."</td>";
         echo "</tr>";
         echo "<th>Postal Code:</th>";
         echo "<td>".$rowF["Postal_code"]."</td>";
         echo "</tr>";
         echo "<th>Telephone:</th>";
         echo "<td>".$rowF["Telephone"]."</td>";
         echo "</tr>";
         echo "<th>Web Address:</th>";
         echo "<td>".$rowF["WebAddress"]."</td>";
         echo "</tr>";
         echo "<th>Type:</th>";
         echo "<td>".$rowF["Type"]."</td>";
         echo "</tr>";
     }
    echo "</table>";
    echo "<input type='button' name='back' value='Go back' onclick='history.back()'>";
}

$sql = "SELECT E.First_name,E.Last_name,StartDate,E.DoB,E.Medicare_Card_Number,E.Telephone,E.Address,E.City,
       E.Province,E.Postal_code,E.Citizenship,E.Email_Address,
       (SELECT Role_Description FROM Roles JOIN DegreeOf D on Roles.RoleId = D.RoleID WHERE D.EmployeeID = E.EmployeeID) AS Position
        FROM Employees AS E
        JOIN Work_at Wa on E.EmployeeID = Wa.EmployeeID
        WHERE Wa.Facility_ID=".$_GET["FID"]." AND (Wa.EndDate > CURDATE() OR Wa.EndDate IS NULL)
        order by Position, E.First_name, E.Last_name ASC;";
$result = $conn->query($sql);
echo "<h3>List of Employee</h3>";
if ($result->num_rows > 0) {
echo "<table border='1px solid black'> 
    <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Start Date</th>
    <th>Date of Birth</th>
    <th>Medicare Card Number</th>
    <th>Telephone</th>
    <th>Address</th>
    <th>City</th>
    <th>Province</th>
    <th>Postal Code</th>
    <th>Citizenship</th>
    <th>Email Address</th>
    <th>Position</th>
</tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["First_name"]."</td>";
        echo "<td>".$row["Last_name"]."</td>";
        echo "<td>".$row["StartDate"]."</td>";
        echo "<td>".$row["DoB"]."</td>";
        echo "<td>".$row["Medicare_Card_Number"]."</td>";
        echo "<td>".$row["Telephone"]."</td>";
        echo "<td>".$row["Address"]."</td>";
        echo "<td>".$row["City"]."</td>";
        echo "<td>".$row["Province"]."</td>";
        echo "<td>".$row["Postal_code"]."</td>";
        echo "<td>".$row["Citizenship"]."</td>";
        echo "<td>".$row["Email_Address"]."</td>";
        echo "<td>".$row["Position"]."</td>";
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