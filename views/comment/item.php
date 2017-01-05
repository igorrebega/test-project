<div class="panel panel-default" id="comment-<?= $item['id'] ?>">
    <div class="panel-body">
        <div>
            <div class="pull-left"><b>Author:</b> <?= $item['login'] ?></div>
            <div class="pull-right rating">
                <?php if ($_SESSION['login_user']['id'] != $item['user_id']): ?>
                    <a href="?p=post/rating&post_id=<?= $post_id ?>&is_plus=1&comment_id=<?= $item['id'] ?>">
                        <span class="label label-success rating-plus">
                            <span class="glyphicon glyphicon-plus">
                            </span>
                        </span>
                    </a>
                <?php endif; ?>
                <span class="label label-primary rating-number"><?=$item['rating']?></span>
                <?php if ($_SESSION['login_user']['id'] != $item['user_id']): ?>
                    <a href="?p=post/rating&post_id=<?= $post_id ?>&is_plus=0&comment_id=<?= $item['id'] ?>">
                        <span class="label label-danger rating-plus">
                            <span class="glyphicon glyphicon-minus">
                            </span>
                        </span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>


        <p class="comment-<?= $item['id'] ?>-text"><?= $item['text'] ?></p>
        <?php if ($_SESSION['login_user']['id'] == $item['user_id']): ?>
            <p>
                <a data-id="<?= $item['id'] ?>" class="comment-edit btn btn-info">Edit</a>
                <a data-id="<?= $item['id'] ?>" class="comment-delete btn btn-danger">Delete</a>
                <a data-id="<?= $item['id'] ?>" class="comment-answer btn btn-primary">Answer</a>

            </p>
        <?php endif; ?>


        <div class="panel-body unvisible" id="comment-<?= $item['id'] ?>-update-form">
            <form>
                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea placeholder="You comment" class="form-control"
                              name="text"><?= $item['text'] ?></textarea>
                </div>
                <button type="button" class="btn-update btn btn-primary" data-id="<?= $item['id'] ?>">Update
                </button>
            </form>
        </div>
        <div class="panel-body unvisible" id="comment-<?= $item['id'] ?>-answer-form">
            <form>
                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea placeholder="You answer" class="form-control"
                              name="text"></textarea>
                </div>
                <button type="button" class="btn-answer btn btn-primary" data-parent_id="<?= $item['id'] ?>"
                        data-id="<?= $post_id ?>">Answer
                </button>
            </form>
        </div>
        <div class="answers">
            <?php foreach ($item['child'] as $child): ?>
                <? \fw\BaseController::renderPartial('comment/item', ['item' => $child, 'post_id' => $post_id]) ?>
            <?php endforeach; ?>
        </div>

    </div>
</div>
