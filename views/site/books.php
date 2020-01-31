<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;
?>
<div class="site-index">
    <?php echo ListView::widget([
        'dataProvider' => $listDataProvider,
        'itemView' => '_list',
    ]);
    ?>
</div>
