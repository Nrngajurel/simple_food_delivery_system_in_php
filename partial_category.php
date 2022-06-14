<?php
                foreach ($categories as $cat){
            ?>
            <a href="category-foods.php?category_id=<?=$cat['id'] ?>">
            <div class="box-3 float-container">
                <img src="<?=get_image_link($cat['image'])?>" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white"><?=$cat['title'] ?></h3>
            </div>
            </a>
            <?php
                }
            ?>