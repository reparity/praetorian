<?php

//get all agents
function getAllAgents($db) {
    $sql = 'Select * FROM agents';
    $stmt = $db->prepare($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get agent by id
function getAgent($db, $agentId) {
    $sql = 'Select * FROM agents ';
    $sql .= 'Where id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $agentId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new requestt
function createRequest($db, $form_data) {
    $sql = 'Insert into requests (name, email, category, description, date) ';
    $sql .= 'values (:name, :email, :category, :description, :date)';
    $stmt = $db->prepare ($sql);

   // if(isset($form_data['price']) && isset($form_data['category_id'])) {
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':email', $form_data['email']);
    $stmt->bindParam(':category', $form_data['category']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->bindParam(':date', $form_data['date']);
    $stmt->execute();
    return $db->lastInsertID(); //insert last number, continue
   // }
}

//update existing record - insert ID by url
function updateProduct($db, $productId, $form_data) {
    $sql = 'UPDATE products SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created WHERE id=:id';

    //echo $sql;
    $stmt = $db->prepare ($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':description', $form_data['description']);
    $stmt->bindParam(':price', $form_data['price']);
    $stmt->bindParam(':category_id', $form_data['category_id']);
    $stmt->bindParam(':created', $form_data['created']);
    $stmt->execute();
    return $stmt->rowCount();
}

//delete existing record
function deleteProduct($db, $productId) {
    $sql = 'DELETE FROM products WHERE id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

//get product by price
function getProductPrice($db, $productPrice) {
    $sql = 'Select p.name, p.description, p.price, c.name as category from products p ';
    $sql .= 'Inner Join categories c on p.category_id = c.id ';
    $sql .= 'Where p.price <= :price order by price';
    $stmt = $db->prepare ($sql);
    $price = (int) $productPrice;
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//update existing record prices by category - insert category by url
function updateProductPriceByCat($db, $productCat, $form_data) {
    $sql = 'UPDATE products SET price=:price WHERE category_id=:cat';

    //echo $sql;
    $stmt = $db->prepare ($sql);
    $cat = (int) $productCat;
    $stmt->bindParam(':cat', $cat, PDO::PARAM_INT);
    $stmt->bindParam(':price', $form_data['price']);
    $stmt->execute();
    return $stmt->rowCount();
}

//delete existing record by name
function deleteProductByName($db, $productName) {
    $sql = "DELETE FROM products WHERE name LIKE :name";
    $stmt = $db->prepare ($sql);
    $name = "%$productName%";
    $stmt->bindValue(':name', $name);
    $stmt->execute();
}

?>