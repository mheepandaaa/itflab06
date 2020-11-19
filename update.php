<?php

if (!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['name']) || !isset($_POST['comment']) || empty($_POST['name']) || empty($_POST['comment'])) {
    echo json_encode([
        'code' => 400,
    ]);
    return;
}


$id = htmlentities($_POST['id']);
$name = htmlentities($_POST['name']);
$comment = htmlentities($_POST['comment']);
$link = htmlentities($_POST['link']);

$stmt = $conn->prepare("UPDATE guestbook SET Name = :name, Comment = :comment, Link = :link WHERE ID=:id");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':comment', $comment);
$stmt->bindParam(':link', $link);

if ($stmt->execute()) {
    echo json_encode([
        'code' => 200,
        'message' => 'success',
    ]);
} else {
    echo json_encode([
        'code' => 500,
        'message' => "Error: SQL",
    ]);
}

$conn = null;