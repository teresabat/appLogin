<?php include 'db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $marrialstatus = $_POST['MarrialStatus'];
    $salariedflag = isset($_POST['SalariedFlag']) ? 1 : 0;
    $gender = $_POST['Gender'];
    $dateofbirth = $_POST['DateOfBirth'];

    $sql = "INSERT INTO employee (FirstName, LastName, MarrialStatus, SalariedFlag, Gender, DateOfBirth) 
            VALUES ('$firstname', '$lastname', '$marrialstatus', '$salariedflag', '$gender', '$dateofbirth')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Employee</h2>
        <form method="POST">
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="FirstName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="LastName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Marital Status</label>
                <select name="MarrialStatus" class="form-control" required>
                    <option value="m">Married</option>
                    <option value="s">Single</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Salaried</label>
                <input type="checkbox" name="SalariedFlag" value="1">
            </div>
            <div class="mb-3">
                <label>Gender</label>
                <select name="Gender" class="form-control" required>
                    <option value="f">Female</option>
                    <option value="m">Male</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Date of Birth</label>
                <input type="date" name="DateOfBirth" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
    </div>
</body>
</html>
