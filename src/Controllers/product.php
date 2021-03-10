<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include productProc.php file
include __DIR__ . '/../Controllers/productProc.php';

//read table products
$app->get('/product/get', function (Request $request, Response $response, array $arg){
    return $this->response->withJson(array('data' => 'success'), 200);
});

//request table products by condition
$app->get('/product/[{id}]', function ($request, $response, $args){

    $productId = $args['id'];
    if (!is_numeric($productId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $data = getProduct($this->db, $productId);
    if (empty($data)) {
        return $this->response->withJson(array('error' => 'no data'), 404);
    }
    return $this->response->withJson(array('data' => $data), 200);
});

//add product
$app->post('/product/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    var_dump($form_data);
    $data = createProduct($this->db, $form_data);
    if ($data <= 0) {
        return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data'=> 'success'), 201);
});

//update product
$app->put('/product/update/[{id}]', function ($request, $response, $args) {
    $productId = $args['id'];
    if (!is_numeric($productId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $form_data = $request->getParsedBody();
    $data = updateProduct($this->db, $productId, $form_data);
    if ($data <= 0) {
        return $this->response->withJson(array('error' => 'update data fail'), 500);
    }
    return $this->response->withJson(array('update data' => 'success'), 201);
});

//delete product
$app->delete('/product/del/[{id}]', function ($request, $response, $args) {
    $productId = $args['id'];
    $data = deleteProduct($this->db, $productId);
    if (!is_numeric($productId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $data = deleteProduct($this->db, $productId);
    if (empty($data)) {
        return $this->response->withJson(array('delete' => 'success'), 200);
    }
    return $this->response->withJson(array('delete' => 'fail'), 404);
});

//request table products by condition (price)
$app->get('/product/price/[{price}]', function ($request, $response, $args){

    $productPrice = $args['price'];
    if (!is_numeric($productPrice)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $data = getProductPrice($this->db, $productPrice);
    if (empty($data)) {
        return $this->response->withJson(array('error' => 'no data'), 404);
    }
    return $this->response->withJson(array('data' => $data), 200);
});

//update product price by category
$app->put('/product/update/category/[{cat}]', function ($request, $response, $args) {
    $productCat = $args['cat'];
    if (!is_numeric($productCat)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $form_data = $request->getParsedBody();
    $data = updateProductPriceByCat($this->db, $productCat, $form_data);
    if ($data <= 0) {
        return $this->response->withJson(array('error' => 'update data fail'), 500);
    }
    return $this->response->withJson(array('update data' => 'success'), 201);
});

//delete product by name (fragments)
$app->delete('/product/del/name/[{name}]', function ($request, $response, $args) {
    $productName = $args['name'];
    $data = deleteProductByName($this->db, $productName);
    if (!is_string($productName)) {
        return $this->response->withJson(array('error' => 'string parameter required'), 422);
    }
    $data = deleteProductByName($this->db, $productName);
    if (empty($data)) {
        return $this->response->withJson(array('delete' => 'success'), 200);
    }
    return $this->response->withJson(array('delete' => 'fail'), 404);
    
});

?>