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
if ($_SERVER["REQUEST_METHOD"]=='POST'){
    $vid = $_POST["VID"];
    $vtype = $_POST["VType"];

    if ($_POST['Actions']=="Create"){
        $SQLActions = "INSERT INTO Vaccines (Vaccination_Reference_Num , VaccineType) 
                 VALUES (".$vid.",'$vtype'); ";
    }
    if ($_POST['Actions']=="Edit"){
        $SQLActions = "UPDATE Vaccines SET VaccineType='$vtype' Where Vaccination_Reference_Num = ".$vid .";";
    }
    if ($_POST['Actions']=="Delete"){
        $SQLActions = "Delete from Vaccines where Vaccination_Reference_Num = ".$vid.";";
    }
    if ($conn -> query($SQLActions)===true){
        header("Location: Vaccination.php");
        exit();
    }else{
        echo "Error: ".$SQLActions . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"]=='GET'){
    if ($_GET["Actions"]=="Create"){
        $sql = "select Vaccination_Reference_Num from Vaccines order by Vaccination_Reference_Num DESC;;";
    }
    if ($_GET["Actions"]=="Edit"){
        $sql = "select Vaccination_Reference_Num, VaccineType from Vaccines where Vaccination_Reference_Num =".$_GET['FID'].";";
    }
    if ($_GET["Actions"]=="Delete"){
        $sql = "select Vaccination_Reference_Num, VaccineType from Vaccines where Vaccination_Reference_Num =".$_GET['FID'].";";
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
            <th><input type="text" name="VID" value=<?php if($_GET['Actions']=="Create")
                    echo $row[0]+1;
                else echo $row[0];
<<<<<<< HEAD
                ?>></th>
=======
                ?> readonly></th>
>>>>>>> giwon
        </tr>
        <tr>
            <th>Infection Type: </th>
            <th><input type="text" name="VType" value="<?php if ($_GET['Actions']!="Create") echo $row[1]?>"></th>
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
</html>