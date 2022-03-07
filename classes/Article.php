<?php

class Article {

    public $id;
    public $title;
    public $post;
    public $errors = [];
    public $image_file;

    //return all articles
    public static function getAll($conn) {
        
        $sql = "SELECT id,title,substring(post,1,30) as post
        FROM article 
        ORDER BY id DESC";
        
        $result = $conn->query($sql);
       
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    //Get Articles by Pages
    public static function getPage ($conn,$limit,$offset) {
        $sql = 'SELECT *, substring(post,1,30)as post FROM article 
        ORDER BY id DESC LIMIT :limit OFFSET :offset';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
    


    //return single article
    static function getArticle ($conn,$id, $column = '*') {

    $sql = "SELECT $column FROM article WHERE id = :id";

    $stmt = $conn->prepare($sql);
  
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        //return object instead of array 
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt->execute()) {
            return $stmt->fetch();
        }
   
        }
        // return data with category of single id
        public static function getByCategory($conn, $id) {

            $sql = "SELECT article.id,title,post,category_id,category,image_file 
            FROM article 
            LEFT JOIN article_category 
            ON article.id = article_id 
            LEFT JOIN category 
            ON category_id = category.id 
            WHERE article.id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }




    //Update article by id
        public function updateArticle($conn) {
        
        $sql = "UPDATE article SET title = :title, post = :post WHERE id = :id";

        
        $stmt = $conn->prepare($sql);
    
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':post', $this->post, PDO::PARAM_STR);

        //return object instead of array 
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        return $stmt->execute();

    }


    //Add New article by id
    public function newArticle($conn) {
        
        $sql = "INSERT INTO article (title, post) VALUES (:title, :post)";
        
        $stmt = $conn->prepare($sql);
    
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':post', $this->post, PDO::PARAM_STR);

        //return object instead of array 
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        }

    }

    public function deleteArticle($conn) {

        $sql = "DELETE FROM article WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $alter = $conn->prepare("ALTER TABLE article AUTO_INCREMENT = :id");
        $alter->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return ($alter->execute());
        }
    }

    
    public function validateArticle() {
        
        if ($this->title == '') {
            $this->errors[] = 'Title is required';
        }
        if ($this->post == '') {
            $this->errors[] = 'Content is Required';
        }
        return (empty($this->errors));

    }

    public function setImageFile($conn,$file) {
        $sql = "UPDATE article SET image_file = :image_file
        WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':image_file',$file, $file == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_STR);

        return $stmt->execute();

    }

}
