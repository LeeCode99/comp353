<!-- SELECT Employee.First_name, Employee.Last_name, InfectedOf.Date_of_Infection, Facilities.Name
FROM Employees AS Employee
JOIN InfectedOf ON Employee.EmployeeID = InfectedOf.EmployeeID
JOIN Work_at ON Employee.EmployeeID = Work_at.EmployeeID
JOIN Facilities ON Work_at.Facility_ID = Facilities.Facility_ID
JOIN DegreeOf ON Employee.EmployeeID = DegreeOf.EmployeeID
JOIN Roles ON DegreeOf.RoleID = Roles.RoleID
WHERE Roles.Role_Description = 'Doctor' AND InfectedOf.Date_of_Infection >= DATE_SUB(NOW(), INTERVAL 14 DAY)
ORDER BY Facilities.Name ASC, Employee.First_name ASC; -->


<HTML>

<HEAD>
    <TITLE>Health Facility Employee Status Tracking System</TITLE>
</HEAD>

<BODY>
    <h1>Health Facility Employee Status Tracking System</h1>
    <?php include "menu.php" ?>
    <h2>Facilities Information</h2>
    <?php
    $servername = "qac353.encs.concordia.ca";
    $username = "qac353_4";
    $password = "ptkg7903";
    $dbname = "qac353_4";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql1 = "SELECT Employee.First_name, Employee.Last_name, InfectedOf.Date_of_Infection, Facilities.Name
    FROM Employees AS Employee
    JOIN InfectedOf ON Employee.EmployeeID = InfectedOf.EmployeeID
    JOIN Work_at ON Employee.EmployeeID = Work_at.EmployeeID
    JOIN Facilities ON Work_at.Facility_ID = Facilities.Facility_ID
    JOIN DegreeOf ON Employee.EmployeeID = DegreeOf.EmployeeID
    JOIN Roles ON DegreeOf.RoleID = Roles.RoleID
    WHERE Roles.Role_Description = 'Doctor' AND InfectedOf.Date_of_Infection >= DATE_SUB(NOW(), INTERVAL 14 DAY)
    ORDER BY Facilities.Name ASC, Employee.First_name ASC;";

    $result = $conn->query($sql1);
    
    if ($result->num_rows > 0) {
        echo "<table border='1 solid black'> 
        <tr>
        <th>Employee Name: </th>        
        <th>Date of Infection: </th>
        <th>Facility Name: </th>
        </tr>";

        echo "<tr>";
        while ($row = $result->fetch_row()) {
            echo "<th>" . $row[0] . "</th>";
            echo "<th>" . $row[1] . "</th>";
            echo "<th>" . $row[2] . "</th>";
            
            echo "</tr>";
        }
        
    } else {
        
        echo "<h1>Query has no output.</h1> <br/>" . $sql1;
    }

    $conn->close();
    ?>
</BODY>

</HTML>