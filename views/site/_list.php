<?php
use yii\helpers\Html;
?>
<?php echo $model->name; ?>
<ul>
    <?php foreach ($model->authors as $author) { ?>
        <li class="book-item">
            <?= Html::encode($author->name) ?>
        </li>
    <?php } ?>
</ul>