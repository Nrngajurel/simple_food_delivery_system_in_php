<?php
require_once __DIR__ .'/model.php';

class CategoryModel extends Model
{
    protected $table = 'categories';


    public function categoryCount(){
        $sql = "SELECT count(*) as total from {$this->table}";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['total'];
    }

    
}