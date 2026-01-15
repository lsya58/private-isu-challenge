<?php
require "vendor/autoload.php";

$dbh = new PDO(
    "mysql:host=mysql;port=3306;dbname=isuconp",
    "root",
    "root"
);

$image_dir = "/home/public/image";
if (!file_exists($image_dir)) {
    mkdir($image_dir, 0777, true);
}

$stmt = $dbh->prepare("SELECT id, mime, imgdata FROM posts WHERE id = ? AND imgdata != ''");

$maxId = $dbh->query("SELECT MAX(id) FROM posts")->fetchColumn();

for ($id = 1; $id <= $maxId; $id++) {
    $stmt->execute([$id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$post) continue;
    
    $ext = "";
    if ($post["mime"] == "image/jpeg") $ext = "jpg";
    elseif ($post["mime"] == "image/png") $ext = "png";
    elseif ($post["mime"] == "image/gif") $ext = "gif";
    
    $filepath = "$image_dir/{$post["id"]}.{$ext}";
    file_put_contents($filepath, $post["imgdata"]);
    
    if ($id % 100 == 0) {
        echo "Migrated $id images...\n";
    }
}

echo "Migration complete!\n";