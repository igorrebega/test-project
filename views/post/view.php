<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $model['name']?></h3>
    </div>
    <div class="panel-body">
        <p><?= $model['text']?></p>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Comments</h3>
    </div>
    <div class="panel-body comments-list">
        <?php foreach ($comments as $item):?>
            <? \fw\BaseController::renderPartial('comment/item',['item'=>$item,'post_id'=>$model['id']])?>
        <?php endforeach;?>
    </div>
</div>
<?php if(isset($_SESSION['login_user'])):?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Write comment</h3>
    </div>
    <div class="panel-body">
        <form>
            <div class="form-group">
                <label for="text">Text</label>
                <textarea placeholder="You comment" class="form-control" name="text" ></textarea>
            </div>
            <button type="button" class="btn btn-default btn-add" data-id="<?= $model['id']?>">Submit</button>
        </form>
    </div>
</div>
<?php endif?>