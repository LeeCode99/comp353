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
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT F.facility_id as facility_id,F.Name as name,F.Address as 'Facility Address',F.City as city,F.Province as province,
       F.Postal_code as postal_code,F.Telephone as telephone,F.WebAddress as webaddress,F.Type as type,F.Capacity as capacity,
       CONCAT(E.Last_name,' ',E.First_name) as 'Manager Name',
       (SELECT COUNT(Work_at.EmployeeID) FROM Work_at WHERE EndDate > CURDATE() 
        OR EndDate IS NULL AND Work_at.Facility_ID = F.facility_id) AS 'Number of Employee'
        FROM Facilities F JOIN Managed M on F.Facility_ID = M.Facility_ID
        join Employees E on E.EmployeeID = M.EmployeeID
        ORDER BY F.Province,F.City,F.Type, `Number of Employee` ASC;
       ";
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
    <th>Manager Name</th>
    <th>Number of Employee</th>
    <th>Actions</th>
</tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th>" . $row["facility_id"] . "</th>";
            echo "<th>" . $row["name"] . "</th>";
            echo "<th>" . $row["Facility Address"] . "</th>";
            echo "<th>" . $row["city"] . "</th>";
            echo "<th>" . $row["type"] . "</th>";
            echo "<th>" . $row["province"] . "</th>";
            echo "<th>" . $row["webaddress"] . "</th>";
            echo "<th>" . $row["postal_code"] . "</th>";
            echo "<th>" . $row["telephone"] . "</th>";
            echo "<th>" . $row["capacity"] . "</th>";
            echo "<th>" . $row["Manager Name"] . "</th>";
            echo "<th>" . $row["Number of Employee"] . "</th>";
            echo "<th><a href=CUEDFacility.php?FID=" . $row["facility_id"] . "&Actions=Edit>Edit
                <a href=CUEDFacility.php?FID=" . $row["facility_id"] . "&Actions=Delete>Delete
                <a href=Query6.php?FID=" . $row["facility_id"] . "&Actions=Show>Show
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