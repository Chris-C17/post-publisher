<?php
/**
 * Convention is to have models Singular and Controllers plural
 * User: c_chambers
 * Date: 20/11/2018
 * Time: 20:02
 */
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseController();
    }

    public function getPosts()
    {
        $this->db->query("SELECT * FROM posts");

        return $this->db->resultSet();
    }
}

# It appears to be looking for the mvc.db in the public folder