<?php

require_once './../helpers.php';
require_once './models/food.php';
require_once './models/category.php';
require_once './models/order.php';

auth_check();
get_admin_header();

$foodModel = new FoodModel();
$categoryModel = new CategoryModel();
$orderModel = new OrderModel();


?>
<div class="flex">
    <div class="w-1/5">
        <?php
        get_admin_sidebar();
        ?>
    </div>
    <div class="w-4/5 p-10">
        <section class="text-center">
            <div class="max-w-screen-xl mx-auto">
                <ul class="grid grid-cols-2 gap-4 border-2 border-orange-600 rounded-xl lg:grid-cols-4">
                    <li class="p-8">
                        <p class="text-2xl font-extrabold text-orange-500">
                            <?= $orderModel->orderCount('pending') ?>
                        </p>
                        <p class="mt-1 text-lg font-medium">Pending Orders</p>
                    </li>

                    <li class="p-8">
                        <p class="text-2xl font-extrabold text-orange-500">
                            <?= $orderModel->orderCount('completed') ?>
                        </p>
                        <p class="mt-1 text-lg font-medium">Completed Order</p>
                    </li>

                    <li class="p-8">
                        <p class="text-2xl font-extrabold text-orange-500">
                            <?= $foodModel->foodCount() ?>
                        </p>
                        <p class="mt-1 text-lg font-medium">Food Items</p>
                    </li>

                    <li class="p-8">
                        <p class="text-2xl font-extrabold text-orange-500">
                            <?= $categoryModel->categoryCount() ?>
                        </p>
                        <p class="mt-1 text-lg font-medium">Categories</p>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</div>

?>