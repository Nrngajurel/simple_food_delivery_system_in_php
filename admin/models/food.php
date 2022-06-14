<?php
require_once __DIR__ .'/model.php';

class FoodModel extends Model
{
    protected $table = 'foods';

    public function all(array $columns = ['*'])
    {
        $sql = "SELECT foods.*, categories.title as category_name
         FROM {$this->table}
            join categories on foods.category_id = categories.id";
        if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']){
            $sql .= " where foods.category_id = {$_REQUEST['category_id']}";
        }
        if(isset($_REQUEST['search']) && $_REQUEST['search']){
            $sql .= " where foods.name like '%{$_REQUEST['search']}%'";
        }
        

        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function foodCount()
    {
        $sql = "SELECT count(*) as total from {$this->table}";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['total'];
    }


}