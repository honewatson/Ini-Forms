<h3>Files</h3>
<ul>
    <li><a href="/index.php">New</a></li>
    <?php foreach($model as $item) :?>

    <li><a href="/index.php?sku=<?php echo $item; ?>"><?php echo $item; ?></a></li>
    <?php endforeach; ?>
</ul>