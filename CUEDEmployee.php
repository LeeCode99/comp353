<html>

<head>
    <TITLE>Health Facility Employee Status Tracking System</TITLE>
</head>

<body>
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
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        $eid = $_POST["EID"];
        $eeadd = $_POST["Eeaddress"];
        $ecitizen = $_POST["Ecitizen"];
        $epostal = $_POST["Epostal_code"];
        $eprovince = $_POST["Eprovince"];
        $ecity = $_POST["Ecity"];
        $eadd = $_POST["Eaddress"];
        $etele = $_POST["Etelephone"];
        $edob = $_POST["Edob"];
        $efirstname = $_POST["Efirstname"];
        $elastname = $_POST["Elastname"];
        $emedocare = $_POST["Emedicarenum"];

        if ($_POST['Actions'] == "Create") {
            $SQLActions = "INSERT INTO Employees (EmployeeID,
            Email_Address,
            Citizenship,
            Postal_code,
            Province,
            City,
            Address,
            Telephone,
            DoB,
            First_name,
            Last_name,
            Medicare_Card_Number) 
                VALUES (" . $eid . ",'$eeadd','$ecitizen','$epostal','$eprovince','$ecity','$eadd','$etele','$edob','$efirstname','$elastname','$emedocare'); ";
        }
        if ($_POST['Actions'] == "Edit") {
            $SQLActions = "UPDATE Employees SET Email_Address='" . $eeadd . "', Citizenship='" . $ecitizen . "', Postal_code='" . $epostal . "', Province='" . $eprovince . "', City='" . $ecity . "', Address='" . $eadd . "', Telephone='" . $etele . "', DoB='" . $edob . "', First_name='" . $efirstname . "', Last_name='" . $elastname . "', Medicare_Card_Number='" . $emedocare . "' Where EmployeeID = " . $eid . ";";
        }
        if ($_POST['Actions'] == "Delete") {
            $SQLActions = "Delete from Employees where EmployeeID = " . $eid . ";";
        }
        if ($conn->query($SQLActions) === true) {
            header("Location: Employee.php");
            exit();
        } else {
            echo "Error: " . $SQLActions . "<br>" . $conn->error;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == 'GET') {
        if ($_GET["Actions"] == "Create") {
            $sql = "select EmployeeID from Employees order by EmployeeID DESC;";
        }
        if ($_GET["Actions"] == "Edit") {
            $sql = "select EmployeeID,
            Email_Address,
            Citizenship,
            Postal_code,
            Province,
            City,
            Address,
            Telephone,
            DoB,
            First_name,
            Last_name,
            Medicare_Card_Number 
            from Employees where EmployeeID =" . $_GET['EID'] . ";";
        }
        if ($_GET["Actions"] == "Delete") {
            $sql = "select EmployeeID,
            Email_Address,
            Citizenship,
            Postal_code,
            Province,
            City,
            Address,
            Telephone,
            DoB,
            First_name,
            Last_name,
            Medicare_Card_Number
            from Employees where EmployeeID =" . $_GET['EID'] . ";";
        }
    }


    $result = $conn->query($sql);
    $row = $result->fetch_row();
    ?>
    <h1>Health Facility Employee Status Tracking System</h1>
    <?php include "menu.php" ?>

    <h2>Add Employee information</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>

                <th>Employee ID: </th>
                <th><input type="text" name="EID" value=<?php if ($_GET['Actions'] == "Create") {
                                                            echo $row[0] + 1;
                                                        } else echo $row[0];
                                                        ?> readonly></th>
            </tr>
            <tr>
                <th>Email Address: </th>
                <th><input type="text" name="Eeaddress" value="<?php if ($_GET['Actions'] != "Create") echo $row[1] ?>"></th>
            </tr>
            <tr>
                <th>Citizenship: </th>
                <th><input type="text" name="Ecitizen" value="<?php if ($_GET['Actions'] != "Create") echo $row[2] ?>"></th>
            </tr>
            <tr>
                <th>Postal code: </th>
                <th><input type="text" name="Epostal_code" value="<?php if ($_GET['Actions'] != "Create") echo $row[3] ?>"></th>
            </tr>
            <tr>
                <th>Province: </th>
                <th><input type="text" name="Eprovince" value="<?php if ($_GET['Actions'] != "Create") echo $row[4] ?>"></th>
            </tr>
            <tr>
                <th>City: </th>
                <th><input type="text" name="Ecity" value="<?php if ($_GET['Actions'] != "Create") echo $row[5] ?>"></th>
            </tr>
            <tr>
                <th>Address: </th>
                <th><input type="text" name="Eaddress" value="<?php if ($_GET['Actions'] != "Create") echo $row[6] ?>"></th>
            </tr>
            <tr>
                <th>Telephone: </th>
                <th><input type="text" name="Etelephone" value="<?php if ($_GET['Actions'] != "Create") echo $row[7] ?>"></th>
            </tr>
            <tr>
                <th>Date of birth: </th>
                <th><input type="date" name="Edob" value="<?php if ($_GET['Actions'] != "Create") echo $row[8] ?>"></th>
            </tr>
            <tr>
                <th>First name: </th>
                <th><input type="text" name="Efirstname" value="<?php if ($_GET['Actions'] != "Create") echo $row[9] ?>"></th>
            </tr>
            <tr>
                <th>Last name: </th>
                <th><input type="text" name="Elastname" value="<?php if ($_GET['Actions'] != "Create") echo $row[10] ?>"></th>
            </tr>
            <tr>
                <th>Medicare Number: </th>
                <th><input type="text" name="Emedicarenum" value="<?php if ($_GET['Actions'] != "Create") echo $row[11] ?>"></th>
            </tr>
            <tr>
                <th><input type="submit" name="Actions" value="<?php
                                                                if ($_GET["Actions"] == "Create") echo "Create";
                                                                if ($_GET["Actions"] == "Delete") echo "Delete";
                                                                if ($_GET["Actions"] == "Edit") echo "Edit";
                                                                ?>"></th>
                <th><input type="button" name="back" value="Go back" onclick="history.back()"></th>
            </tr>
        </table>
    </form>
</body>

</html>