<?php

namespace controllers;


use fw\BaseController;
use models\Comment;
use models\Post;
use models\Rating;

class PostController extends BaseController
{
    /**
     * List of all posts
     */
    public function start()
    {
        $posts = new Post();

        $this->render('post/start', ['models' => $posts->postsList()]);
    }

    /**
     * View one post
     */
    public function
    view()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $posts = new Post();
            if ($posts->getPost($id)) {
                $comment = new Comment();
                $comments = $comment->getComments($id);

                return $this->render('post/view', [
                    'model' => $posts->getPost($id),
                    'comment' => $comment,
                    'comments' => $comments,
                ]);
            }
        }
        return header('Location: /?p=app/error');

    }

    /**
     * Ajax delete comment
     */
    public function commentDelete()
    {
        $this->checkAuth();
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $comment = new Comment();
            if ($comment->delete($id)) {
                echo $id;
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    /**
     * Ajax update comment
     */
    public function commentUpdate()
    {
        $this->checkAuth();

        if (isset($_POST['id']) && isset($_POST['text'])) {
            $id = $_POST['id'];
            $text = $_POST['text'];
            $comment = new Comment();
            if ($comment->update($id, $text)) {
                echo json_encode(['id' => $id, 'text' => $text]);
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    /**
     * Add comment
     */
    public function commentAdd()
    {
        $this->checkAuth();

        if (isset($_POST['text']) && isset($_POST['post_id'])) {
            $text = $_POST['text'];
            $post_id = $_POST['post_id'];
            if (isset($_POST['parent_id'])) {
                $parent_id = $_POST['parent_id'];
            } else {
                $parent_id = 0;
            }
            $comment = new Comment();
            if ($item = $comment->insert($text, $post_id, $parent_id)) {
                BaseController::renderPartial('comment/item', ['item' => $item, 'post_id' => $post_id]);
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    /**
     * Update rating for comment
     */
    public function rating()
    {
        $this->checkAuth();

        if (isset($_GET['is_plus']) && isset($_GET['comment_id'])&& isset($_GET['post_id'])) {
            $is_plus = $_GET['is_plus'];
            $comment_id = $_GET['comment_id'];
            $post_id = $_GET['post_id'];
            $rating = new Rating();
            $rating->insert($is_plus, $comment_id);
            header("Location: ?p=post/view&id=$post_id");

        } else {
            header("HTTP/1.0 404 Not Found");
        }

    }
}