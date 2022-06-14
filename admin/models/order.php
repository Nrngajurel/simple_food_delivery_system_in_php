<?php
require_once __DIR__ .'/model.php';

class OrderModel extends Model
{
    protected $table = 'orders';

    public function pendingOrders()
    {
        $sql = "SELECT orders.*, foods.name as food_name, foods.price as food_price, foods.image as food_image
         FROM $this->table
         join foods on foods.id = orders.food_id
         WHERE status = 'pending';";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function completedOrders()
    {
        $sql = "SELECT orders.*, foods.name as food_name, foods.price as food_price, foods.image as food_image
         FROM $this->table
         join foods on foods.id = orders.food_id
         WHERE status = 'completed';";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function canceledOrders()
    {
        $sql = "SELECT orders.*, foods.name as food_name, foods.price as food_price, foods.image as food_image
         FROM $this->table
         join foods on foods.id = orders.food_id
         WHERE status = 'canceled';";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // change status by id
    public function changeStatus($id, $status)
    {
        $sql = "UPDATE $this->table SET status = '$status' WHERE id = $id";
        $this->db->query($sql);
        return $this->db->conn->affected_rows == 1;
    }


    public function orderCount($status){
        $sql = "SELECT count(*) as total from {$this->table} where status = '$status'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['total'];
    }
}