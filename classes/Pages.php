<?php

class Pages {
    public $limit;
    public $offset;
    public $previous;
    public $next;
    public $total;
    //show record per page
    function __construct($conn,$result_per_page,$page_no)
    {

        $this->limit = $result_per_page; //later use
        $page_no = filter_var($page_no, FILTER_VALIDATE_INT, 
        ['options' => 
        ['default' => 1, 'min_range' => 1]
        ] );
        $this->previous = $page_no - 1;
        $this->next = $page_no + 1;
        $total_records = Pages::getPages($conn);

        $total_pages = ceil($total_records / $result_per_page);

        $this->total = $total_pages;
        $this->offset = $result_per_page * ($page_no - 1);
     
        
    }
        

    public static function getPages($conn) {
        
        $sql = "SELECT COUNT(id) AS total FROM article";
        
        $result = $conn->query($sql);
       
        return $result->fetchColumn();
        }
}