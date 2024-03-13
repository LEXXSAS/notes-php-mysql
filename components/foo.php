<?php

include 'db.php';

$start = 0;
$rowperpage = 4;

// выборка всего с лимитом при загрузке страницы
$sql = $pdo->prepare("SELECT * FROM notes LIMIT $start, $rowperpage");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);

// выборка уникальных значений по автору
$sqltwo = $pdo->prepare("SELECT DISTINCT author FROM notes");
$sqltwo->execute();
$resulttwo = $sqltwo->fetchAll(PDO::FETCH_OBJ);

// выборка уникальных значений по приоритету
$sqlthree = $pdo->prepare("SELECT DISTINCT priority FROM notes");
$sqlthree->execute();
$resultthree = $sqlthree->fetchAll(PDO::FETCH_OBJ);

// выборка по запросу ajax значений по приоритету
if (isset($_POST["priority"]) && $_POST["priorityid"]) {
  $priority = $_POST["priority"];
  $get_priority_id = $_POST["priorityid"];
  $sql = ("UPDATE notes SET priority=? WHERE id=?;");
  $query = $pdo->prepare($sql);
  $query->execute([$priority, $get_priority_id]);
  if ($query) {
    header("Location: ". $_SERVER['HTTP_REFERER']);
  }
}
