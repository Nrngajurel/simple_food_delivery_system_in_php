<?php
require_once './helpers.php';
require_once './admin/models/food.php';
require_once './admin/models/category.php';

get_header();

$category = new CategoryModel();

$categories = $category->all();
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        require_once('./partial_category.php');
        ?>



        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php
get_footer();
?>