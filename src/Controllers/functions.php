<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include functionsProc.php file
include __DIR__ . '/../Controllers/functionsProc.php';

//read table agents
$app->get('/adminpage/get', function (Request $request, Response $response, array $arg){
    $data = getAllAgents($this->db);
    return $this->response->withJson(array('data' => $data), 200);
});

//request table agents by condition
$app->get('/adminpage/agent/[{id}]', function ($request, $response, $args){

    $agentId = $args['id'];
    if (!is_numeric($agentId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $data = getAgent($this->db, $agentId);
    if (empty($data)) {
        return $this->response->withJson(array('error' => 'no data'), 404);
    }
    return $this->response->withJson(array('data' => $data), 200);
});

//add request
$app->post('/request/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    var_dump($form_data);
    $data = createRequest($this->db, $form_data);
    if ($data <= 0) {
        return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data'=> 'success'), 201);
});

//login
$app->post('/auth', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = authCheck($this->db, $form_data);
    if ($data <= 0) {
        //return $this->renderer->render($response, "/../public/login.phtml");
        $url = $this->router->pathFor('route.login', ['login']);
        return $response->withStatus(302)->withHeader('Location', $url);
    }
    //return $this->renderer->render($response, "/../public/adminpage.phtml");
    $url = $this->router->pathFor('route.admin', ['adminpage']);
    return $response->withStatus(302)->withHeader('Location', $url);
});

//delete request
$app->delete('/adminpage/delete/[{id}]', function ($request, $response, $args) {
    $requestId = $args['id'];
    $data = deleteRequest($this->db, $requestId);
    if (!is_numeric($requestId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $data = deleteRequest($this->db, $requestId);
    if (empty($data)) {
        return $this->response->withJson(array('delete' => 'success'), 200);
    }
    return $this->response->withJson(array('delete' => 'fail'), 404);
});

/** all code below is unedited
 * do not use it
 */

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