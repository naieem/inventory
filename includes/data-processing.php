<?php

/******************************
* data processing
******************************/

// this function saves the data
add_action("wp_ajax_inventory_crud_function", "inventory_crud_function");
add_action("wp_ajax_nopriv_inventory_crud_function", "inventory_crud_function");

function inventory_crud_function(){
  global $wpdb; // global initialization for database query
  $data=$_REQUEST;
  // echo var_dump($_REQUEST);
  $type=$_REQUEST['type'];
  switch ($type) {
    /* user crud */
    case 'add_new_user':
    add_new_user($data);
    break;
    case 'update_customer':
    update_customer($data);
    break;
    case 'get_currency':
    get_currency();
    break;
    case 'get_all_user':
    get_all_user();
    break;
    /* product category crud*/
    case 'add_new_product_cat':
    add_new_product_cat($data);
    break;

    case 'get_product_category':
    get_product_category();
    break;
    case 'delete':
    delete($data);
    break;
    case 'update_product_category':
    update_product_category($data);
    break;
    /* supplier crud */
    case 'add_new_supplier':
    add_new_supplier($data);
    break;

    case 'get_supplier':
    get_supplier();
    break;
    case 'delete':
    delete($data);
    break;
    case 'update_supplier':
    update_supplier($data);
    break;

    /* product crud */
    case 'add_new_product':
    add_new_product($data);
    break;

    case 'get_product':
    get_product();
    break;
    case 'delete':
    delete($data);
    break;
    case 'update_product':
    update_product($data);
    break;
    
    /* recipe category crud */
    case 'add_new_recipe_category':
    add_new_recipe_category($data);
    break;

    case 'update_recipe_category':
    update_recipe_category($data);
    break;

    /* recipe crud */
    case 'add_new_recipe':
    add_new_recipe($data);
    break;

    case 'get_all_recipe':
    get_all_recipe($data);
    break;
    case 'update_recipe':
    update_recipe($data);
    break;

    /* generic get all call*/
    case 'get_all':
    get_all($data);
    break;
    default:
      # code...
    break;
  }
  // echo $name;
  // $insert_result=$wpdb->insert('inv_customer',array('inv_customer_name' => $name,'inv_currency_inv_currency_id' => 1));
  // echo $insert_result;
  die();
}

function add_new_user($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_customer_name' => $data['name'],
    'inv_customer_email' => $data['email'], 
    'inv_customer_phone_number' => $data['phone'],
    'inv_customer_company' => $data['company'],
    'inv_customer_street_address' => $data['street'],
    'inv_customer_city' => $data['city'],
    'inv_customer_province' => $data['province'],
    'inv_customer_postal_code' => $data['postal'],
    'inv_customer_country' => $data['country'],
    'inv_currency_inv_currency_id' => $data['currency']
    );
  $insert_result=$wpdb->insert('inv_customer',$datas);
  echo $insert_result;
}
function update_customer($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_customer_name' => $data['inv_customer_name'],
    'inv_customer_email' => $data['inv_customer_email'], 
    'inv_customer_phone_number' => $data['inv_customer_phone_number'],
    'inv_customer_company' => $data['inv_customer_company'],
    'inv_customer_street_address' => $data['inv_customer_street_address'],
    'inv_customer_city' => $data['inv_customer_city'],
    'inv_customer_province' => $data['inv_customer_province'],
    'inv_customer_postal_code' => $data['inv_customer_postal_code'],
    'inv_customer_country' => $data['inv_customer_country'],
    'inv_currency_inv_currency_id' => $data['inv_currency_inv_currency_id']
    );
  $insert_result=$wpdb->update('inv_customer',$datas,array( 'id' => $data['id'] ));
  echo $insert_result;
}
function get_currency(){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT * FROM inv_currency");
  // var_dump($fivesdrafts);
  echo json_encode($fivesdrafts);
}
function get_all_user(){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT inv_customer.*,inv_currency.inv_currency_code FROM inv_customer INNER JOIN inv_currency ON inv_customer.inv_currency_inv_currency_id=inv_currency.id");
  echo json_encode($fivesdrafts);
}
function add_new_product_cat($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_product_cat_name' => $data['name'],
    'inv_product_cat_parent' => $data['parent'], 
    'inv_product_cat_desc' => $data['desc'],
    'inv_i18n_entitie_name' => 1
    );
  $insert_result=$wpdb->insert('inv_product_cat',$datas);
  echo $insert_result;
}
function get_product_category(){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT * FROM inv_product_cat WHERE id!='0'");
  // var_dump($fivesdrafts);
  echo json_encode($fivesdrafts);
}
function delete($data){
  // var_dump($data);
  global $wpdb;
  $ret=$wpdb->query($wpdb->prepare("DELETE FROM ".$data['table']." WHERE id=".$data['id']));
  echo $ret;
}

function update_product_category($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_product_cat_name' => $data['inv_product_cat_name'],
    'inv_product_cat_parent' => $data['inv_product_cat_parent'], 
    'inv_product_cat_desc' => $data['inv_product_cat_desc'],
    'inv_i18n_entitie_name' => 1
    );
  $insert_result=$wpdb->update('inv_product_cat',$datas,array( 'id' => $data['id'] ));
  echo $insert_result;
}

function add_new_supplier($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_supplier_name' => $data['name']
    );
  $insert_result=$wpdb->insert('inv_supplier',$datas);
  echo $insert_result;
}
function get_supplier(){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT * FROM inv_supplier WHERE id!='0'");
  // var_dump($fivesdrafts);
  echo json_encode($fivesdrafts);
}

function update_supplier($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_supplier_name' => $data['inv_supplier_name']
    );
  $insert_result=$wpdb->update('inv_supplier',$datas,array( 'id' => $data['id'] ));
  echo $insert_result;
}


function add_new_product($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_product_name' => $data['name'],
    'inv_product_barcode' => $data['barcode'],
    'inv_product_size' => $data['size'],
    'inv_product_full_weight' => $data['fweight'],
    'inv_product_empty_weight' => $data['eweight'],
    'inv_product_cost' => $data['cost'],
    'inv_i18n_entity_name' => 1,
    'inv_product_category_id' => $data['category'],
    'inv_product_supplier_id' => $data['supplier']
    );
  $insert_result=$wpdb->insert('inv_product',$datas);
  echo $insert_result;
}
function get_product(){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT * FROM inv_product WHERE id!='0'");
  // var_dump($fivesdrafts);
  echo json_encode($fivesdrafts);
}

function update_product($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_product_name' => $data['inv_product_name'],
    'inv_product_barcode' => $data['inv_product_barcode'],
    'inv_product_size' => $data['inv_product_size'],
    'inv_product_full_weight' => $data['inv_product_full_weight'],
    'inv_product_empty_weight' => $data['inv_product_empty_weight'],
    'inv_product_cost' => $data['inv_product_cost'],
    'inv_i18n_entity_name' => 1,
    'inv_product_category_id' => $data['inv_product_category_id'],
    'inv_product_supplier_id' => $data['inv_product_supplier_id']
    );
  $insert_result=$wpdb->update('inv_product',$datas,array( 'id' => $data['id'] ));
  echo $insert_result;
}

function add_new_recipe_category($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_i18n_entity_name' => 1,
    'inv_recipe_cat_name' => $data['name'],
    'inv_recipe_cat_desc' => $data['desc'],
    );
  $insert_result=$wpdb->insert('inv_recipe_cat',$datas);
  echo $insert_result;
}

function update_recipe_category($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_recipe_cat_name' => $data['inv_recipe_cat_name'],
    'inv_recipe_cat_desc' => $data['inv_recipe_cat_desc'],
    'inv_i18n_entity_name' => 1,
    );
  $insert_result=$wpdb->update('inv_recipe_cat',$datas,array( 'id' => $data['id'] ));
  echo $insert_result;
}

function get_all($data){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT * FROM ".$data["table"]." WHERE id !=0");
  // var_dump($fivesdrafts);
  echo json_encode($fivesdrafts);
}


function add_new_recipe($data){
  // var_dump($data);
  global $wpdb;
  $datas = array(
    'inv_i18n_entity_name' => 1,
    'inv_recipe_name' => $data['name'],
    'inv_recipe_instructions' => $data['instructions'],
    'inv_recipe_category_inv_recipe_category_id'=>$data['category'],
    'inv_image_inv_image'=>1,    
    );
  $wpdb->insert('inv_recipe',$datas);
  $recipe_id=$wpdb->insert_id;
  $data['product']=($data['product']!='' ? $data['product'] : 0);
  $data['recipe']=($data['recipe']!='' ? $data['recipe'] : 0);
  // var_dump($data);
  $datas1=array(
    'inv_recipe_inv_recipe_id_is_main_recipe' => $recipe_id,
    'inv_product_id_inv_product' => $data['product'],
    'inv_recipe_inv_recipe_id' => $data['recipe'],
    'inv_product_has_inv_recipe_qty' => $data['qty'],
    'inv_inventory_units_inv_inventory_units_id' => $data['unit']
    );
  $res=$wpdb->insert('inv_product_recipe_mapping',$datas1);
  echo $res;
}

function get_all_recipe($data){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT * FROM inv_recipe INNER JOIN inv_product_recipe_mapping ON inv_recipe.id = inv_product_recipe_mapping.inv_recipe_inv_recipe_id_is_main_recipe");
  // var_dump($fivesdrafts);
  echo json_encode($fivesdrafts);
}


function update_recipe($data){
  // var_dump($data);
  global $wpdb;
  
  $datas1=array(
    'inv_recipe_inv_recipe_id_is_main_recipe'=>$data['id'],
    'inv_product_id_inv_product' => $data['inv_product_id_inv_product'],
    'inv_recipe_inv_recipe_id' => $data['inv_recipe_inv_recipe_id'],
    'inv_product_has_inv_recipe_qty' => $data['inv_product_has_inv_recipe_qty'],
    'inv_inventory_units_inv_inventory_units_id' => $data['inv_inventory_units_inv_inventory_units_id']
    );
  $wpdb->update('inv_product_recipe_mapping',$datas1,array( 'inv_recipe_inv_recipe_id_is_main_recipe' => $data['id'] ));

  $datas = array(
    'inv_i18n_entity_name' => 1,
    'inv_recipe_name' => $data['inv_recipe_name'],
    'inv_recipe_instructions' => $data['inv_recipe_instructions'],
    'inv_recipe_category_inv_recipe_category_id'=>$data['inv_recipe_category_inv_recipe_category_id'],
    'inv_image_inv_image'=>1,    
    );
  $insert_result=$wpdb->update('inv_recipe',$datas,array( 'id' => $data['id'] ));
  echo $insert_result;
}

?>