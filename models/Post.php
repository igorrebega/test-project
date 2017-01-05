<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.01.17
 * Time: 20:18
 */

namespace models;


use fw\Db;

class Post extends Db
{
    /**
     * List of all posts
     * @return array
     */
    public function postsList(){
        $return = [];
        $query = "SELECT * FROM post";
        $db = $this->db;
        if($db->query($query)){
            $result =  $db->query($query);
            while ($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
        }

        return $return;
    }

    /**
     * Get one post by id
     * @param $id
     * @return array|bool
     */
    public function getPost($id){
        $query = "SELECT id,text,name FROM post where id = ?";
        $db = $this->db;
        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param("i",$id);

            $stmt->execute();
            $stmt->bind_result($id,$text,$name);
            $stmt->fetch();
            if($id){
                $return = ['id'=>$id,'text'=>$text,'name'=>$name];
                return $return;
            }

            $stmt->close();
        }
        return false;
    }
}