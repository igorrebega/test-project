<?php

namespace models;


use fw\Db;

class Comment extends Db
{

    /**
     * Get comment list for view
     * @param $post_id
     * @param int $parent_id
     * @return array
     */
    public function getComments($post_id, $parent_id = 0)
    {
        $return = [];
        $db = $this->db;
        $post_id = $db->real_escape_string($post_id);
        $parent_id = $db->real_escape_string($parent_id);

        $query = "SELECT comment.*,user.login FROM comment JOIN user ON user.id = comment.user_id AND comment.post_id = $post_id and comment.parent_id = $parent_id";
        $result = $db->query($query);
        if ($result) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $return[$i] = $row;
                $return[$i]['child'] = $this->getComments($post_id,$row['id']);
                $rating = new Rating();
                $id = $row['id'];
                $return[$i]['rating'] = $rating->countRating($id);
                    $i++;
            }
        }

        return $return;
    }

    /**
     * Delete comment by id
     * @param $id
     * @return bool
     */
    public function delete($id){
        $query = "DELETE FROM comment WHERE id = ? and user_id = ?";
        $db = $this->db;
        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param("is",$id,$_SESSION['login_user']['id']);

            if ($stmt->execute()) {
                return true;
            }
        }
        return false;

    }

    /**
     * Update comment
     * @param $id
     * @param $text
     * @return bool
     */
    public function update($id, $text){
        $query = "UPDATE comment SET text = ? WHERE id = ? and user_id = ?";
        $db = $this->db;
        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param("sis",$text,$id,$_SESSION['login_user']['id']);

            if ($stmt->execute()) {
                return true;
            }
        }
        return false;

    }

    /**
     * Insert comment
     * @param $text
     * @param $post_id
     * @param $parent_id
     * @return array|bool
     */
    public function insert($text, $post_id, $parent_id){
        $query = "INSERT INTO comment SET text = ?, post_id = ?,user_id = ?,parent_id=?";
        $db = $this->db;
        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param("siii", $text, $post_id, $_SESSION['login_user']['id'],$parent_id);

            if ($stmt->execute()) {
                $sql = "SELECT comment.*,user.login FROM comment JOIN user ON user.id = comment.user_id AND comment.id = $stmt->insert_id";
                $result = $db->query($sql);
                if ($result) {
                    $return= $result->fetch_assoc();
                    $return['rating'] = 0;
                    $return['child'] = $this->getComments($post_id,$return['id']);
                    return $return;

                }
            }
        }
        return false;
    }


}