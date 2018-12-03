<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 02/12/2018
 * Time: 12:51
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
        # Create database query from DatabaseController
        # Using aliases here so we can use postID (or userID) in posts/index.php
        # (otherwise aliases are unnecessary)
        $this->db->query('SELECT *, 
                          posts.id as postID,
                          users.id as userID,
                          posts.created_at as postCreated,
                          users.created_at as userCreated
                          FROM posts
                          INNER JOIN users
                          ON posts.user_id = users.id
                          ORDER BY posts.created_at DESC
                          ');

        # Get array of results from resultSet() in DatabaseController
        $results = $this->db->resultSet();

        return $results;
    }

    public function getPostById($id) {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function addPost($data) {
        $this->db->query("INSERT INTO posts (title, body, user_id) VALUES (:t, :b, :u)");

        # Bind Values
        $this->db->bind(':t', $data['title']);
        $this->db->bind(':b', $data['body']);
        $this->db->bind(':u', $data['user_id']);

        # Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}