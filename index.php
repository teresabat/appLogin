<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Employee List</h2>
        <a href="create.php" class="btn btn-primary mb-3">Add New Employee</a>
        <table class="table table-bordered" style="text-align: center;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Marital Status</th>
                    <th>Salaried</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica se a conexão com o banco está ok
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                
                // Consulta para buscar os funcionários
                $sql = "SELECT * FROM employee";
                $result = $conn->query($sql);
                
                // Exibe os resultados se houver registros
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['FirstName']}</td>
                            <td>{$row['LastName']}</td>
                            <td>" . ($row['MarrialStatus'] == 'm' ? 'Married' : 'Single') . "</td>
                            <td>" . ($row['SalariedFlag'] ? 'Yes' : 'No') . "</td>
                            <td>" . ($row['Gender'] == 'm' ? 'Male' : 'Female') . "</td>
                            <td>{$row['DateOfBirth']}</td>
                            <td>
                                <a href='edit.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                <a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No employees found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
