<?php
    class Post{
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query('select *, posts.id as postId, users.id as userId, posts.created_at as postCreated from posts INNER JOIN users ON  posts.user_id = users.id order by posts.created_at desc');
            $results = $this->db->resultSet();
            return $results;
        }

        public function addPost($data){
            $this->db->query('insert into posts (title,user_id,body) values(:title, :user_id, :body)');
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':body', $data['body']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getPostById($id){
            $this->db->query('Select * from posts where id = :id');
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            return $row;
        }

        public function updatePost($data){
            $this->db->query('update posts set title= :title,body = :body where id = :id');
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':id', $data['id']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function deletePost($data){
            $this->db->query('delete from posts where id = :id');
            $this->db->bind(':id', $data['id']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

    }