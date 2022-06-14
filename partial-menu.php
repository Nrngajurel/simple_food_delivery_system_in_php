<section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                foreach ($foods as $food){

            ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="<?=get_image_link($food['image']) ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?= $food['name']?></h4>
                    <p class="food-price">NPR <?= $food['price']?></p>
                    <p class="food-detail">
                        <?= $food['body']?>
                    </p>
                    <br>

                    <a href="order.php?food_id=<?= $food['id']?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

        <?php
            if(!isset($disable_she_all) || $disable_she_all){

        ?>
        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
        <?php
            }
        ?>
    </section>