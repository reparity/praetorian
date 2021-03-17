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
        return $this->response->withRedirect("/adminpage", 301);
    }
    return $this->response->withJson(array('delete' => 'fail'), 404);
});

//update agent assignment
$app->put('/adminpage/update/[{id}]', function ($request, $response, $args) {
    $requestId = $args['id'];
    if (!is_numeric($requestId)) {
        return $this->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $form_data = $request->getParsedBody();
    $data = updateAgent($this->db, $requestId, $form_data);
    if ($data <= 0) {
        return $this->response->withJson(array('error' => 'update data fail'), 500);
    }
    return $this->response->withRedirect("/adminpage", 301);
});

?>