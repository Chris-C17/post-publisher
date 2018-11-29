<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 29/11/2018
 * Time: 13:39
 */

# Models should be singular
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseController();
    }

    # Find user by email
    public function findUserByEmail($email)
    {
//        # If you just want a count can use this
//        $this->db->query('SELECT COUNT(*) FROM users WHERE email = :e');

        $this->db->query('SELECT * FROM users WHERE email = :e');
        $this->db->bind(':e', $email);
        $row = $this->db->single();

        # Check row
        if($row){
            return true;
        } else {
            return false;
        }
    }
}