<?php
require_once './helpers.php';
require_once './admin/models/food.php';
require_once './admin/models/order.php';

    $order = new OrderModel();


    get_header();

    $foodModel = new FoodModel();

    if(!isset($_REQUEST['food_id']) || empty($_REQUEST['food_id'])){
        redirect('index.php');
    }

    $food = $foodModel->find(isset($_REQUEST['food_id']) ? $_REQUEST['food_id'] : null);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (
            isset($_POST['food_id']) && !empty($_POST['food_id']) &&
            isset($_POST['qty']) && !empty($_POST['qty']) &&
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['phone']) && !empty($_POST['phone']) &&
            isset($_POST['email']) && !empty($_POST['email']) &&
            isset($_POST['address']) && !empty($_POST['address'])
        ) {

            $food_id = $_POST['food_id'];
            $qty = $_POST['qty'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            
            $order->create([
                'food_id' => $food_id,
                'qty' => $qty,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'status' => 'pending'
            ]);

            $order->success = 'Order placed successfully';
            
        } else {
            $order->error = 'Please fill in all fields';
        }
    }
    
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h3 class="text-center text-white">Fill this form to confirm your order.</h3>
            <h2 class="text-center text-white">
                
                <?php
                    if (isset($order->error) && !empty($order->error)) {
                        echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">' . $order->error . '</span>
                            </div>';
                    }
                    if (isset($order->success) && !empty($order->success)) {
                        echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">' . $order->success . '</span>
                            </div>';
                    }
                    ?>
            </h2>

            <form action="?food_id=<?=$_REQUEST['food_id']?>" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?=get_image_link($food['image']) ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3>
                            <?= $food['name']?>
                        </h3>
                        <p class="food-price">NPR <?= $food['price']?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="name" placeholder="E.g. Pawan Stha" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="phone" placeholder="E.g. xxxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. nrngajurel@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Kathmandu Nepal" class="input-responsive" required></textarea>
                    <input type="hidden" name="food_id" value="<?=$_REQUEST['food_id']?>">


                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php
    get_footer();