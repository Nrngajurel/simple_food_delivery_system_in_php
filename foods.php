<?php
require_once './helpers.php';
require_once './admin/models/food.php';
require_once './admin/models/category.php';

get_header();

$foodModel = new FoodModel();

$foods = $foodModel->all();
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="/foods.php" method="GET">
                <input type="search"
                value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"
                 name="search"
                  placeholder="Search for Food.."
                   required>
                <input type="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <?php
        require_once('./partial-menu.php');
    ?>
    <!-- fOOD Menu Section Ends Here -->
<?php
    get_footer();