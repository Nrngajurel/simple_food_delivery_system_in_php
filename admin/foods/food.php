<?php

require_once './../../helpers.php';
require_once './../models/food.php';
require_once './../models/category.php';

auth_check();

get_admin_header();

$foodModel = new FoodModel();
$category = new CategoryModel();

$foods = $foodModel->all();
$categories = $category->all();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['price']) && !empty($_POST['price'])
        && isset($_POST['body']) && !empty($_POST['body'])
        && isset($_POST['category_id']) && !empty($_POST['category_id'])
        && isset($_FILES['image']) && !empty($_FILES['image'])
    ) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $body = $_POST['body'];
        $category_id = $_POST['category_id'];
        $image = $_FILES['image'];
        // save image
        $save_image = save_image($image);
        if ($save_image['error'] == '') {
            $foodModel->create([
                'name' => $name,
                'price' => $price,
                'body' => $body,
                'image' => $save_image['path'],
                'category_id' => $category_id
            ]);
            $foodModel->success = 'Food added successfully';
            $foods = $foodModel->all();
        } else {
            $foodModel->error = $save_image['error'];
        }
    } else {
        $foodModel->error = 'Please fill in all fields';
    }
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
            <div>
                <?php
                if (isset($foodModel->error) && !empty($foodModel->error)) {
                    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">' . $foodModel->error . '</span>
                        </div>';
                }
                if (isset($foodModel->success) && !empty($foodModel->success)) {
                    echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">' . $foodModel->success . '</span>
                        </div>';
                }
                ?>
            </div>
            <details class="group" <?= isset($foodModel->error) && !empty($foodModel->error) ? 'open' : '' ?>>
                <summary class="flex items-center px-4 py-2 text-gray-500 rounded-lg cursor-pointer hover:bg-gray-100 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-3 text-sm font-medium"> Add Food </span>

                    <span class="ml-auto transition duration-300 shrink-0 group-open:-rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </summary>

                <div class="mt-1.5 ml-8 flex flex-col">
                    <?php
                    FormHelper::open_form($_SERVER['REQUEST_URI'], 'POST', 'shadow-md rounded-lg p-4 border-gray-300');
                    FormHelper::label('name', 'Food Name');
                    FormHelper::input('name', 'Food Name');
                    FormHelper::label('price', 'Price');
                    FormHelper::input('price', 'Price');
                    FormHelper::label('image', 'Image');
                    FormHelper::image_upload('image');
                    FormHelper::label('Category', 'Category');
                    FormHelper::select('category_id', $categories, 'id', 'title');
                    FormHelper::label('body', 'Description');
                    FormHelper::textarea('body');
                    FormHelper::submit('create', 'Create');
                    FormHelper::close_form();
                    ?>
                </div>
            </details>
            <div class="py-5">
                <h1 class="text-2xl font-bold text-grey-500">Food</h1>
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
                                Name
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Price
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Category
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
                                Description
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($foods as $food) : ?>
                        
                        <tr>
                            <td class="sticky left-0 p-4 bg-white">
                                <label class="sr-only" for="row_1">Row 1</label>
                                <input class="w-5 h-5 border-gray-200 rounded" type="checkbox" id="row_1" />
                            </td>
                            <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                <?= $food['name'] ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <?= $food['price'] ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <?= $food['category_name'] ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                
                                <img src="http://<?= $_SERVER['HTTP_HOST'].''.$food['image'] ?>" alt="<?= $food['image'] ?>" class="w-32 h-32" />
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                <?= $food['body'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>