<?php

require_once './../../helpers.php';
require_once './../models/order.php';

$orderModel = new OrderModel();
$orders = $orderModel->pendingOrders();

auth_check();
get_admin_header();

if(isset($_POST['status']) && isset($_POST['order_id'])) {
    $orderModel->changeStatus($_POST['order_id'], $_POST['status']);
    
}

?>
<div class="flex">
    <div class="w-1/5">
        <?php
        get_admin_sidebar();
        ?>
    </div>

    <div class="w-4/5 p-10">
        <div class="overflow-x-auto">
            <div class="py-5">
                <h1 class="text-2xl font-bold text-yellow-500">Pending Orders</h1>
            </div>
            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="sticky left-0 p-4 text-left bg-white">
                            <label class="sr-only" for="row_all">Select All</label>
                            <input class="w-5 h-5 border-gray-200 rounded" type="checkbox" id="row_all" />
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Client Name
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Client Email
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Client Phone
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Food Name
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Image
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Quantity
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Status
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    <?php
                    foreach ($orders as $order) {

                    ?>
                        <tr>
                            <td class="sticky left-0 p-4 bg-white">
                                <label class="sr-only" for="row_1">Row 1</label>
                                <input class="w-5 h-5 border-gray-200 rounded" type="checkbox" id="row_1" />
                            </td>
                            <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                <?php echo $order['name']; ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <?php echo $order['email']; ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <?php echo $order['phone']; ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <?php echo $order['food_name']; ?> | NPR <?php echo $order['food_price']; ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <img src="<?= get_image_link($order['food_image']) ?>" alt="<?php echo $order['food_name']; ?>" class="w-32 h-32">
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <?php echo $order['qty']; ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <strong class="text-yellow-700 px-3 py-1.5 rounded text-xs font-medium">

                                    <form action="" method="post">
                                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                        <select name="status" id=""
                                            onchange="this.form.submit()"
                                        >
                                            <option value="pending" <?php if ($order['status'] == 'pending') {
                                                                        echo 'selected';
                                                                    } ?>>Pending</option>
                                            <option value="completed" <?php if ($order['status'] == 'completed') {
                                                                            echo 'selected';
                                                                        } ?>>Confirmed</option>
                                            <option value="canceled" <?php if ($order['status'] == 'cancelled') {
                                                                            echo 'selected';
                                                                        } ?>>Cancelled</option>
                                        </select>
                                    </form>
                                </strong>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

?>