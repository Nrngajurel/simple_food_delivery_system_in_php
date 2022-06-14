<?php
require_once './helpers.php';
require_once './admin/models/food.php';
require_once './admin/models/category.php';

get_header();

$foodModel = new FoodModel();

$foods = $foodModel->all();
$disable_she_all = false;
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">
                <?=count($foods) && isset($_REQUEST['category_id']) > 0?$foods[0]['category_name']:'Foods'?>
            </a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <?php
        if(count($foods) > 0){
            require_once('./partial-menu.php');
        }else{
            echo '<h2 class="text-center">No Foods Found</h2>';
        }
    ?>
    <!-- fOOD Menu Section Ends Here -->
<?php
    get_footer();