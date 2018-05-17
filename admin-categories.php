<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;

//Categories
$app->get("/admin/categories", function () {

    User::verifyLogin();

    $categories = Category::listAll();

    $page = new PageAdmin();

    $page->setTpl("categories", [
        'categories' => $categories
    ]);

});

//Create category
$app->get("/admin/categories/create", function () {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("categories-create");

});

//Create category post
$app->post("/admin/categories/create", function () {

    User::verifyLogin();

    $category = new Category();

    $category->setData($_POST);

    $category->save();

    header("Location: /admin/categories");
    exit;

});

//Delete category
$app->get("/admin/categories/:idcategory/delete", function ($idcategory) {

    User::verifyLogin();

    $category = new Category();

    $category->get((int)$idcategory);

    $category->delete();

    header("Location: /admin/categories");
    exit;

});

//Update category
$app->get("/admin/categories/:idcategory", function ($idcategory) {

    User::verifyLogin();

    $category = new Category();

    $category->get((int)$idcategory);

    $page = new PageAdmin();

    $page->setTpl("categories-update", [
        'category' => $category->getValues()
    ]);

});

//Update category post
$app->post("/admin/categories/:idcategory", function ($idcategory) {

    User::verifyLogin();

    $category = new Category();

    $category->get((int)$idcategory);

    $category->setData($_POST);

    $category->save();

    header("Location: /admin/categories");
    exit;

});

//Main site
//Categoria
$app->get("/categories/:idcategory", function ($idcategory) {
    $category = new Category();

    $category->get((int)$idcategory);

    $page = new Page();

    $page->setTpl("category", [
        'category' => $category->getValues(),
        'products' => []
    ]);
});

?>