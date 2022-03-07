<?php
class Category {
    public static function getAll($conn) {
        $sql = "SELECT id,category AS name FROM category";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
}