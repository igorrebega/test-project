<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.01.17
 * Time: 18:26
 */

namespace models;


use fw\Db;

class Rating extends Db
{
    /**
     * Insert rating row
     * @param $is_plus
     * @param $comment_id
     * @return int
     */
    public function insert($is_plus, $comment_id)
    {
        $db = $this->db;
        $is_plus = $db->real_escape_string($is_plus);
        $comment_id = $db->real_escape_string($comment_id);
        $user_id = $_SESSION['login_user']['id'];
        $sql = "SELECT id FROM comment WHERE user_id = $user_id AND id = $comment_id";
        $result2 = $db->query($sql);
        if ($result2->num_rows==0) {
            $sql = "SELECT id FROM rating WHERE user_id = $user_id AND comment_id = $comment_id";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                $db->query("UPDATE rating SET is_plus = $is_plus WHERE comment_id = $comment_id");
            } else {
                $db->query("INSERT INTO rating SET user_id = $user_id,comment_id = $comment_id,is_plus = $is_plus");
            }
        }
        return $this->countRating($comment_id);
    }

    /**
     * Count rating
     * @param $comment_id
     * @return int
     */
    public function countRating($comment_id)
    {

        $rating = 0;
        $query = "SELECT * FROM rating WHERE comment_id = $comment_id";
        $result = $this->db->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                if ($row['is_plus']) {
                    $rating++;
                } else {
                    $rating--;
                }
            }

        }
        return $rating;
    }
}