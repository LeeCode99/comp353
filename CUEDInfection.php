<html>
<<<<<<< HEAD
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
if ($_SERVER["REQUEST_METHOD"]=='POST'){
    $iid = $_POST["IID"];
    $itype = $_POST["IType"];

    if ($_POST['Actions']=="Create"){
        $SQLActions = "INSERT INTO Infections (Infection_Reference_Num , Infection_Type) 
                 VALUES (".$iid.",'$itype'); ";
    }
    if ($_POST['Actions']=="Edit"){
        $SQLActions = "UPDATE Infections SET Infection_Type='$itype' Where Infection_Reference_Num = ".$iid .";";
    }
    if ($_POST['Actions']=="Delete"){
        $SQLActions = "Delete from Infections where Infection_Reference_Num = ".$iid.";";
    }
    if ($conn -> query($SQLActions)===true){
        header("Location: Infection.php");
        exit();
    }else{
        echo "Error: ".$SQLActions . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"]=='GET'){
    if ($_GET["Actions"]=="Create"){
        $sql = "select Infection_Reference_Num from Infections order by Infection_Reference_Num DESC;;";
    }
    if ($_GET["Actions"]=="Edit"){
        $sql = "select Infection_Reference_Num, Infection_Type from Infections where Infection_Reference_Num =".$_GET['FID'].";";
    }
    if ($_GET["Actions"]=="Delete"){
        $sql = "select Infection_Reference_Num, Infection_Type from Infections where Infection_Reference_Num =".$_GET['FID'].";";
    }
}
$result = $conn->query($sql);
$row = $result->fetch_row();
?>
<h1>Health Facility Employee Status Tracking System</h1>
<?php include "menu.php"?>
<h2>Create Facility</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table>
        <tr>
            <th>Infection Reference Number: </th>
            <th><input type="text" name="IID" value=<?php if($_GET['Actions']=="Create")
                    echo $row[0]+1;
                else echo $row[0];
                ?>></th>
        </tr>
        <tr>
            <th>Infection Type: </th>
            <th><input type="text" name="IType" value="<?php if ($_GET['Actions']!="Create") echo $row[1]?>"></th>
        </tr>
        <tr>
            <th><input type="submit" name="Actions" value="<?php
                if ($_GET["Actions"]=="Create") echo "Create";
                if ($_GET["Actions"]=="Delete") echo "Delete";
                if ($_GET["Actions"]=="Edit") echo "Edit";
                ?>"></th>
            <th><input type="button" name="back" value="Go back" onclick="history.back()"></th>
        </tr>
    </table>
</form>
</body>
=======

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
        $iid = $_POST["IID"];
        $itype = $_POST["IType"];

        if ($_POST['Actions'] == "Create") {
            $SQLActions = "INSERT INTO Infections (Infection_Reference_Num , Infection_Type) 
                 VALUES (" . $iid . ",'$itype'); ";
        }
        if ($_POST['Actions'] == "Edit") {
            $SQLActions = "UPDATE Infections SET Infection_Type='$itype' Where Infection_Reference_Num = " . $iid . ";";
        }
        if ($_POST['Actions'] == "Delete") {
            $SQLActions = "Delete from Infections where Infection_Reference_Num = " . $iid . ";";
        }
        if ($conn->query($SQLActions) === true) {
            header("Location: Infection.php");
            exit();
        } else {
            echo "Error: " . $SQLActions . "<br>" . $conn->error;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == 'GET') {
        if ($_GET["Actions"] == "Create") {
            $sql = "select Infection_Reference_Num from Infections order by Infection_Reference_Num DESC;;";
        }
        if ($_GET["Actions"] == "Edit") {
            $sql = "select Infection_Reference_Num, Infection_Type from Infections where Infection_Reference_Num =" . $_GET['FID'] . ";";
        }
        if ($_GET["Actions"] == "Delete") {
            $sql = "select Infection_Reference_Num, Infection_Type from Infections where Infection_Reference_Num =" . $_GET['FID'] . ";";
        }
    }
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    ?>
    <h1>Health Facility Employee Status Tracking System</h1>
    <?php include "menu.php" ?>
    <h2>Add infection information</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <th>Infection Reference Number: </th>
                <th><input type="text" name="IID" value=<?php if ($_GET['Actions'] == "Create")
                                                            echo $row[0] + 1;
                                                        else echo $row[0];
                                                        ?> readonly></th>
            </tr>
            <tr>
                <th>Infection Type: </th>
                <th><input type="text" name="IType" value="<?php if ($_GET['Actions'] != "Create") echo $row[1] ?>"></th>
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

>>>>>>> giwon
</html>