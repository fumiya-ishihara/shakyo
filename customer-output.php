<?php require '../shakyo-header.php' ?>
<?php require 'menu.php' ?>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'staff', 'password');

if (isset($_SESSION['customer'])) {
  $id = $_SESSION['customer']['id'];
  $sql = $pdo->prepare('select * from customer where id!=? login=?');
  $sql->execute([$id, $_REQUEST['login']]);
} else {
  $sql = $pdo->prepare('select * from customer where login=?');
  $sql->execute([$_REQUEST['login']]);
}

if (empty($sql->fetchAll())) {
  if (isset($_SESSION['customer'])) {
    $sql = $pdo->prepare('select * from customer where id=? and login=?');
    $sql->execute([])


    echo '会員情報を更新しました。';
  } else {


    echo '会員登録に成功しました。';
  }
} else {


  echo 'ログイン名が既に使用されているので、変更してください。';
}

?>