<?php
require_once '../shakyo-header.php';
require_once 'menu.php';

$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

$pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'staff', 'password');
$stmt = $pdo->prepare("SELECT * FROM product WHERE name LIKE ?");
$stmt->execute(['%' . $keyword . '%']);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<form action="product.php" method="post">
  商品検索
  <input type="text" name="keyword" value="<?= htmlentities($keyword) ?>">
  <input type="submit" value="検索">
</form>
<hr>
<table>
  <thead>
    <tr>
      <th>商品番号</th>
      <th>商品名</th>
      <th>価格</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?= htmlentities($row['id']) ?></td>
        <td><a href="detail.php?id=<?= htmlentities($row['id']) ?>"><?= htmlentities($row['name']) ?></a></td>
        <td><?= htmlentities($row['price']) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php require_once '../footer.php'; ?>