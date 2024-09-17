<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];

$sql = "DELETE FROM employee WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
