<?php foreach ($models as $model):?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $model['name']?></h3>
    </div>
    <div class="panel-body">
        <p><?= $model['text']?></p>
        <p><a href="/?p=post/view&id=<?= $model['id'] ?>" class="btn btn-info">View full</a></p>
    </div>
</div>
<?php endforeach;?>