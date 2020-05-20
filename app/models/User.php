<?php 
    class User{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function register($data){
            $this->db->query('insert into users (name,email,password) values(:name, :email, :password)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }

        }

        public function login($email, $password){
            $this->db->query('select * from users where email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        public function findUserByEmail($email){
            $this->db->query('select * from users where email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

        public function getUserById($postId){
            $this->db->query('select * from users where id = :id');
            $this->db->bind(':id', $postId);
            $row = $this->db->single();
            return $row;
        }
    }