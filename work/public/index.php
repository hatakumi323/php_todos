<?php

require_once(__DIR__ . '/../app/config.php');

createToken();

$pdo = getPdoInstance();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validateToken();
  addTodo($pdo);

  header('Location: . SITE_URL');
  exit;
}

$todos = getTodos($pdo);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h1>Todos</h1>

  <form action="" method="POST">
    <input type="text" name="title" placeholder="Type new todo.">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>

  <ul>
    <?php foreach ($todos as $todo) : ?>
      <li>
        <form action="" method="POST">
          <input type="checkbox" name="" id="" <?= $todo->is_done ? 'checked' : ''; ?>>
          <input type="hidden" name="id" value="<?= h($todo->id); ?>">
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
        <span class="<?= $todo->is_done ? 'done' : ''; ?>">
          <?= h($todo->title); ?>
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
</body>

</html>
