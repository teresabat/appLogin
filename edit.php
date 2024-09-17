<?php include 'db.php'; ?>

<?php
// Verificar se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta SQL para buscar os dados do funcionário com o ID fornecido
    $sql = "SELECT * FROM employee WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Preenche os dados no array $employee
        $employee = $result->fetch_assoc();
    } else {
        echo "Employee not found.";
        exit;
    }
}

// Verificar se o formulário foi enviado via POST para atualizar os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $marrialstatus = $_POST['MarrialStatus'];
    $salariedflag = isset($_POST['SalariedFlag']) ? 1 : 0;
    $gender = $_POST['Gender'];
    $dateofbirth = $_POST['DateOfBirth'];

    // Consulta SQL para atualizar os dados do funcionário
    $sql = "UPDATE employee SET 
            FirstName = '$firstname', 
            LastName = '$lastname', 
            MarrialStatus = '$marrialstatus', 
            SalariedFlag = '$salariedflag', 
            Gender = '$gender', 
            DateOfBirth = '$dateofbirth' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php'); // Redireciona para a página principal
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
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Employee</h2>
        <form method="POST">
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="FirstName" class="form-control" value="<?php echo $employee['FirstName']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="LastName" class="form-control" value="<?php echo $employee['LastName']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Marital Status</label>
                <select name="MarrialStatus" class="form-control" required>
                    <option value="m" <?php echo $employee['MarrialStatus'] == 'm' ? 'selected' : ''; ?>>Married</option>
                    <option value="s" <?php echo $employee['MarrialStatus'] == 's' ? 'selected' : ''; ?>>Single</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Salaried</label>
                <input type="checkbox" name="SalariedFlag" value="1" <?php echo $employee['SalariedFlag'] == 1 ? 'checked' : ''; ?>>
            </div>
            <div class="mb-3">
                <label>Gender</label>
                <select name="Gender" class="form-control" required>
                    <option value="f" <?php echo $employee['Gender'] == 'f' ? 'selected' : ''; ?>>Female</option>
                    <option value="m" <?php echo $employee['Gender'] == 'm' ? 'selected' : ''; ?>>Male</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Date of Birth</label>
                <input type="date" name="DateOfBirth" class="form-control" value="<?php echo $employee['DateOfBirth']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>
</body>
</html>
