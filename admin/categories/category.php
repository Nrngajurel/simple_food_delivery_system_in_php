<?php

require_once './../../helpers.php';
require_once './../models/food.php';
require_once './../models/category.php';

auth_check();

get_admin_header();

$category = new CategoryModel();

$categories = $category->all();

if (isset($_GET['delete_id'])) {
    if($category->delete($_GET['delete_id'])){
        $category->success = 'Category deleted successfully';
        $categories = $category->all();
    }else{
        $category->error = 'Category could not be deleted';
    }  
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        isset($_POST['name']) && !empty($_POST['name'])
        && isset($_FILES['image']) && !empty($_FILES['image'])
    ) {
        $name = $_POST['name'];
        $image = $_FILES['image'];
        // save image
        $save_image = save_image($image);
        if ($save_image['error'] == '') {
            
            $category->create([
                'title' => $name,
                'image' => $save_image['path']
            ]);
            $category->success = 'Categories added successfully';
            $categories = $category->all();
        } else {
            $category->error = $save_image['error'];
        }
    } else {
        $category->error = 'Please fill in all fields';
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
                if (isset($category->error) && !empty($category->error)) {
                    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">' . $category->error . '</span>
                        </div>';
                }
                if (isset($category->success) && !empty($category->success)) {
                    echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">' . $category->success . '</span>
                        </div>';
                }
                ?>
            </div>
            <details class="group" <?= isset($category->error) && !empty($category->error) ? 'open' : '' ?>>
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
                    FormHelper::label('name', 'Category Name');
                    FormHelper::input('name', 'Category Name');
                    FormHelper::label('image', 'Image');
                    FormHelper::image_upload('image');
                    FormHelper::submit('create', 'Create');
                    FormHelper::close_form();
                    ?>
                </div>
            </details>
            <div class="py-5">
                <h1 class="text-2xl font-bold text-grey-500">Category</h1>
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
                                Image
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1.5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Action
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($categories as $cat) : ?>
                        
                        <tr>
                            <td class="sticky left-0 p-4 bg-white">
                                <label class="sr-only" for="row_1">Row 1</label>
                                <input class="w-5 h-5 border-gray-200 rounded" type="checkbox" id="row_1" />
                            </td>
                            <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                <?= $cat['title'] ?>
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                
                                <img src="<?=get_image_link($cat['image'])?>" alt="<?= $cat['image'] ?>" class="w-32 h-32" />
                            </td>
                            <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    <a href="<?= $_SERVER['REQUEST_URI'] ?>?delete_id=<?= $cat['id'] ?>" class="ml-2 text-red-500 hover:text-red-700">
                                        
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>