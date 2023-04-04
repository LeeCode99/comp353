<!-- SELECT emp.First_name, emp.Last_name, emp.DoB, emp.Email_Address, MIN(w.StartDate) AS First_Day_of_Work, SUM(HOUR(TIMEDIFF(w.EndDate, w.StartDate))) AS Total_Hours_Scheduled
FROM Employees emp
INNER JOIN Work_at w ON emp.EmployeeID = w.EmployeeID
INNER JOIN DegreeOf d ON emp.EmployeeID = d.EmployeeID
WHERE d.RoleID = 1 AND w.EndDate IS NULL
GROUP BY w.EmployeeID
ORDER BY Total_Hours_Scheduled DESC
LIMIT 1; -->



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

    $sql1 = "SELECT emp.First_name, emp.Last_name, emp.DoB, emp.Email_Address,
    MIN(w.StartDate) AS First_Day_of_Work, TIMESTAMPDIFF(HOUR, w.StartDate, w.EndDate)AS totalhours
    FROM Employees emp
    INNER JOIN Work_at w ON emp.EmployeeID = w.EmployeeID
    INNER JOIN DegreeOf d ON emp.EmployeeID = d.EmployeeID
    WHERE d.RoleID = 1 
    GROUP BY w.EmployeeID
    ORDER BY totalhours DESC
    LIMIT 1;";

    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
        echo "<table border='1 solid black'> 
        <tr>
        <th>Employee Name: </th>        
        <th>Date of Birth: </th>
        <th>Email Address: </th>
        <th>First day of work</th>
        <th>Total hours scheduled</th>
        </tr>";

        echo "<tr>";
        while ($row = $result->fetch_row()) {
            echo "<th>" . $row[0] . " " . $row[1] . "</th>";
            echo "<th>" . $row[2] . "</th>";
            echo "<th>" . $row[3] . "</th>";
            echo "<th>" . $row[4] . "</th>";
            echo "<th>" . $row[5] . "</th>";
            echo "</tr>";
        }
    } else {
        echo "Query has no output.";
    }

    $conn->close();
    ?>
</BODY>

</HTML>