<?php

if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode([
        'code' => 400,
    ]);
    return;
}


$id = htmlentities($_POST['id']);

$stmt = $conn->prepare("DELETE FROM guestbook WHERE ID=:id");
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo json_encode([
        'code' => 200,
        'message' => 'success',
    ]);
} else {
    echo json_encode([
        'code' => 500,
        'message' => "Error: " . $sql . "<br>" . mysqli_error($conn),
    ]);
}

$conn = null;