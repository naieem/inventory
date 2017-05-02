<?php
header('Content-Type: application/json');


/******************************
ata processing
******************************/

// this function saves the data
add_action("wp_ajax_inventory_crud_function", "inventory_crud_function");
add_action("wp_ajax_nopriv_inventory_crud_function", "inventory_crud_function");

function inventory_crud_function(){
	global $db;
	// 	global initialization for database query
		  $data=$_REQUEST;             
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
		case 'get_product_category_parent':
				    get_product_category_parent();
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
		case 'delete_recipe':
				    delete_recipe($data);
		break;
		
		
		/*Location crud*/
		case 'add_new_location':
				    add_new_location($data);
		break;
		case 'update_location':
				    update_location($data);
		break;
		
		
		
		/*Inventory crud*/
		case 'add_new_inventory':
				    add_new_inventory($data);
		break;
		case 'get_all_inventory':
				    get_all_inventory($data);
		break;
		case 'update_inventory':
				    update_inventory($data);
		break;
		case 'delete_inventory':
				    delete_inventory($data);
		break;
		
		
		
		/*Order crud*/
		case 'add_new_order':
				    add_new_order($data);
		break;
		case 'get_all_orders':
				    get_all_orders();
		break;
		case 'update_order':
				    update_orders($data);
		break;
		case 'delete_order':
				    delete_orders($data);
		break;
		// 		case 'get_all_inventory':
				    // 		get_all_inventory($data);
		// 		break;
		// 		case 'update_inventory':
				    // 		update_inventory($data);
		// 		break;
		// 		case 'delete_inventory':
				    // 		delete_inventory($data);
		// 		break;
		
		
		case 'get_all_users':
				    get_all_users();
		break;
		
		
		/* recipe crud */
		// 		case 'add_new_recipe':
				    // 		add_new_recipe($data);
		// 		break;
		// 		case 'update_recipe':
				    // 		update_recipe($data);
		// 		break;
		
		
		
		
		/* generic all call*/
		case 'delete':
				    delete($data);
		break;
		case 'get_all':
				    get_all($data);
		break;
		default:
				      # code...
				    break;
	}
	// 	echo $name;
	// 	$insert_result=$db->insert('inv_customer',array('inv_customer_name' => $name,'inv_currency_inv_currency_id' => 1));
	// 	echo $insert_result;
	die();
}

function add_new_user($data){
	// 	var_dump($data);
	// 	global $db;
	global $db;
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
	// 	$insert_result=$db->insert('inv_customer',$datas);
	$insert_result=$db->insert('inv_customer',$datas);
	echo $insert_result;
}
function update_customer($data){
	// 	var_dump($data);
	global $db;
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
	$insert_result=$db->update('inv_customer',$datas,array( 'id' => $data['id'] ));
	echo $insert_result;
}
function get_currency(){
	// 	global $db;
	// 	$fivesdrafts = $db->get_results("SELECT * FROM inv_currency");
	// 	// 	var_dump($fivesdrafts);
	// 	echo json_encode($fivesdrafts);
	global $db;
	$config=array(
		    'tables'=>array("inv_currency"),
		    'fields'=>"*",
		    'join'=>"",
		    'condition'=>"" 
		    );
	$all=$db->get_data($config);
	echo json_encode($all);
}
function get_all_user(){
	// 	global $db;
	// 	$fivesdrafts = $db->get_results("SELECT inv_customer.*,inv_currency.inv_currency_code FROM inv_customer INNER JOIN inv_currency ON inv_customer.inv_currency_inv_currency_id=inv_currency.id");
	// 	echo json_encode($fivesdrafts);
	global $db;
	$config=array(
		    'tables'=>array("inv_customer","inv_currency"),
		    'fields'=>"inv_customer.*,inv_currency.inv_currency_code",
		    'join'=>"INNER",
		    'condition'=>"ON inv_customer.inv_currency_inv_currency_id=inv_currency.id" 
		    );
	$all=$db->get_data($config);
	echo json_encode($all);
}
function add_new_product_cat($data){
	// 	var_dump($data);
	global $db;
	$datas = array(
		    'inv_product_cat_name' => $data['name'],
		    'inv_product_cat_parent' => $data['parent'], 
		    'inv_product_cat_desc' => $data['desc'],
		    'inv_i18n_entitie_name' => 1
		    );
	$insert_result=$db->insert('inv_product_cat',$datas);
	echo $insert_result;
}
function get_product_category(){
	// 	global $db;
	// 	$fivesdrafts = $db->get_results("SELECT * FROM inv_product_cat WHERE id!='0'");
	// 	// 	var_dump($fivesdrafts);
	// 	echo json_encode($fivesdrafts);
	global $db;
	$config=array(
		    'tables'=>array("inv_product_cat"),
		    'fields'=>"*",
		    'join'=>"",
		    'condition'=>"WHERE id!='0'" 
		    );
	$all=$db->get_data($config);
	echo json_encode($all);
}
function get_product_category_parent(){
	global $db;
	$config=array(
		    'tables'=>array("inv_product_cat"),
		    'fields'=>"*",
		    'join'=>"",
		    'condition'=>"WHERE id!='0' AND inv_product_cat_parent=0" 
		    );
	$all=$db->get_data($config);
	echo json_encode($all);
}
function delete($data){
	global $db;
	$condition=array(
		    'id'=>$data['id']
		    );
	$ret=$db->delete($data['table'],$condition);
	echo $ret;
}

function delete_recipe($data){
	global $db;
	
	$condition=array(
		    'inv_recipe_inv_recipe_id_is_main_recipe'=>$data['id']
		    );
	$ret=$db->delete("inv_product_recipe_mapping",$condition);
	if($ret==1){
		$condition=array(
				      'id'=>$data['id']
				      );
		$ret=$db->delete($data['table'],$condition);
		echo $ret;
	}
	else{
		echo "not deleted";
	}
}

function update_product_category($data){
	// 	var_dump($data);
	global $db;
	$datas = array(
		    'inv_product_cat_name' => $data['inv_product_cat_name'],
		    'inv_product_cat_parent' => $data['inv_product_cat_parent'], 
		    'inv_product_cat_desc' => $data['inv_product_cat_desc'],
		    'inv_i18n_entitie_name' => 1
		    );
	$insert_result=$db->update('inv_product_cat',$datas,array( 'id' => $data['id'] ));
	echo $insert_result;
}

function add_new_supplier($data){
	// 	var_dump($data);
	global $db;
	$datas = array(
		    'inv_supplier_name' => $data['name']
		    );
	$insert_result=$db->insert('inv_supplier',$datas);
	// 	var_dump($db->db->lastInsertId());
	echo $insert_result;
}
function get_supplier(){
	global $db;
	$config=array(
		    'tables'=>array("inv_supplier"),
		    'fields'=>"*",
		    'join'=>"",
		    'condition'=>"WHERE id!='0'" 
		    );
	$fivesdrafts = $db->get_data($config);
	// 	var_dump($fivesdrafts);
	echo json_encode($fivesdrafts);
}

function update_supplier($data){
	// 	var_dump($data);
	global $db;
	$datas = array(
		    'inv_supplier_name' => $data['inv_supplier_name']
		    );
	$insert_result=$db->update('inv_supplier',$datas,array( 'id' => $data['id'] ));
	echo $insert_result;
}


function add_new_product($data){
	// 	var_dump($data);
	global $db;
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
	$insert_result=$db->insert('inv_product',$datas);
	echo $insert_result;
}
function get_product(){
	global $db;
	$config=array(
		    'tables'=>array("inv_product"),
		    'fields'=>"*",
		    'join'=>"",
		    'condition'=>"WHERE id!='0'" 
		    );
	$fivesdrafts = $db->get_data($config);
	// 	var_dump($fivesdrafts);
	echo json_encode($fivesdrafts);
}

function update_product($data){
	// 	var_dump($data);
	global $db;
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
	$insert_result=$db->update('inv_product',$datas,array( 'id' => $data['id'] ));
	echo $insert_result;
}

function add_new_recipe_category($data){
	// 	var_dump($data);
	global $db;
	$datas = array(
		    'inv_i18n_entity_name' => 1,
		    'inv_recipe_cat_name' => $data['name'],
		    'inv_recipe_cat_desc' => $data['desc'],
		    );
	$insert_result=$db->insert('inv_recipe_cat',$datas);
	echo $insert_result;
}

function update_recipe_category($data){
	// 	var_dump($data);
	global $db;
	$datas = array(
		    'inv_recipe_cat_name' => $data['inv_recipe_cat_name'],
		    'inv_recipe_cat_desc' => $data['inv_recipe_cat_desc'],
		    'inv_i18n_entity_name' => 1,
		    );
	$insert_result=$db->update('inv_recipe_cat',$datas,array( 'id' => $data['id'] ));
	echo $insert_result;
}

function get_all($data){
	global $db;
	$config=array(
		    'tables'=>array($data["table"]),
		    'fields'=>"*",
		    'join'=>"",
		    'condition'=>"WHERE id!='0'" 
		    );
	$fivesdrafts = $db->get_data($config);
	// 	var_dump($fivesdrafts);
	echo json_encode($fivesdrafts);
}


function add_new_recipe($data){
  $str=$data['config'];
  $l=str_replace("\\","",$str);
  // var_dump($l);
  $result = json_decode ($l);
  var_dump($result->name);
  var_dump($data);
	global $db;
	// 	$datas = array(
		// 	'inv_i18n_entity_name' => 1,
		// 	'inv_recipe_name' => $data['name'],
		// 	'inv_recipe_instructions' => $data['instructions'],
		// 	'inv_recipe_category_inv_recipe_category_id'=>$data['category'],
		// 	'inv_image_inv_image'=>1,    
		// 	);
	// 	$db->insert('inv_recipe',$datas);
	// 	$recipe_id=$db->db->lastInsertId();
	// 	$data['product']=($data['product']!='' ? $data['product'] : 0);
	// 	$data['recipe']=($data['recipe']!='' ? $data['recipe'] : 0);
	// 	// 	var_dump($data);
	// 	$datas1=array(
		// 	'inv_recipe_inv_recipe_id_is_main_recipe' => $recipe_id,
		// 	'inv_product_id_inv_product' => $data['product'],
		// 	'inv_recipe_inv_recipe_id' => $data['recipe'],
		// 	'inv_product_has_inv_recipe_qty' => $data['qty'],
		// 	'inv_inventory_units_inv_inventory_units_id' => $data['unit']
		// 	);
	// 	$res=$db->insert('inv_product_recipe_mapping',$datas1);
	// 	echo $res;
}

function get_all_recipe($data){
	global $db;
	$config=array(
		    'tables'=>array('inv_recipe','inv_product_recipe_mapping'),
		    'fields'=>"*",
		    'join'=>"INNER",
		    'condition'=>"WHERE inv_recipe.id="."inv_product_recipe_mapping.inv_recipe_inv_recipe_id_is_main_recipe" 
		    );
	$fivesdrafts = $db->get_data($config);
	// 	var_dump($fivesdrafts);
	echo json_encode($fivesdrafts);
}


function update_recipe($data){
	// 	var_dump($data);
	global $db;
	$datas1=array(
		    'inv_recipe_inv_recipe_id_is_main_recipe'=>$data['id'],
		    'inv_product_id_inv_product' => $data['inv_product_id_inv_product'],
		    'inv_recipe_inv_recipe_id' => $data['inv_recipe_inv_recipe_id'],
		    'inv_product_has_inv_recipe_qty' => $data['inv_product_has_inv_recipe_qty'],
		    'inv_inventory_units_inv_inventory_units_id' => 
		    $data['inv_inventory_units_inv_inventory_units_id']
		    );
	$insert_result=$db->update('inv_product_recipe_mapping',$datas1,
		    array( 'inv_recipe_inv_recipe_id_is_main_recipe' => $data['id'] ));
	if($insert_result){
		$datas = array(
				      'inv_i18n_entity_name' => 1,
				      'inv_recipe_name' => $data['inv_recipe_name'],
				      'inv_recipe_instructions' => $data['inv_recipe_instructions'],
				      'inv_recipe_category_inv_recipe_category_id'=>
				      $data['inv_recipe_category_inv_recipe_category_id'],
				      'inv_image_inv_image'=>1,    
				      );
		$insert_result=$db->update('inv_recipe',$datas,array( 'id' => $data['id'] ));
	}
	echo $insert_result;
}

function get_all_location($data){
	global $db;
	$config=array(
		    'tables'=>array('inv_location'),
		    'fields'=>"*",
		    'join'=>"",
		    'condition'=>""
		    );
	$fivesdrafts = $db->get_data($config);
	// 	$array = array_map('utf8_encode',$fivesdrafts[0]);
	$json = json_encode($fivesdrafts);
	echo $json;
	// 	var_dump($fivesdrafts);
}

function update_location($data){
	unset($data['action']);
	unset($data['type']);
	unset($data['$hashKey']);
	// 	var_dump($data);
	global $db;
	$insert_result=$db->update('inv_location',$data,array( 'id' => $data['id'] ));
	echo $insert_result;
}

function add_new_location($data){
	unset($data['action']);
	unset($data['type']);
	// 	var_dump($data);
	global $db;
	$res=$db->insert('inv_location',$data);
	echo $res;
}
function get_all_users(){
	$all_user=[];
	$user_query = new WP_User_Query( array( 'role' => '' ) );
	if ( ! empty( $user_query->results ) ) {
		foreach ( $user_query->results as $user ) {
			$all_user[]=$user;
		}
	}
	else {
		echo 'No users found.';
	}
	echo json_encode($all_user);
}

function add_new_inventory($data){
	unset($data['action']);
	unset($data['type']);
	// 	var_dump($data);
	global $db;
	// 	$res=$db->insert('inv_inventory',$data);
	// 	echo $res;
	$datas = array(
		    'inv_inventory_date' =>$data['inv_inventory_date'],
		    'wp_users_id_users' => $data['wp_users_id_users'],
		    'inv_location_inv_location_id' => $data['inv_location_inv_location_id']  
		    );
	$insert_result=$db->insert('inv_inventory',$datas);
	$inventory_id=$db->db->lastInsertId();
	if($insert_result){
		$datas1=array(
				      'inv_inventory_line_amount'=>$data['amount'],
				      'inv_inventory_inv_inventory_id' =>$inventory_id,
				      'inv_inventory_units_inv_inventory_units_id' => $data['unit'],
				      'inv_supplier_inv_supplier_id' => $data['supplier'],
				      'inv_product_id_inv_product' => 
				      $data['product'],
				      'inv_inventory_line_user_id' => $data['wp_users_id_users'],
				      'inv_inventory_line_date_time' => $data['inv_inventory_date'],
				      'inv_location_line_inv_location_id' => 
				      $data['inv_location_inv_location_id']
				      );
		$insert_result=$db->insert('inv_inventory_line',$datas1);
	}
	echo $insert_result;
}
function get_all_inventory(){
	global $db;
	$config=array(
		    'tables'=>array("inv_inventory","inv_inventory_line"),
		    'fields'=>"inv_inventory.*,inv_inventory_line.inv_supplier_inv_supplier_id,inv_inventory_line.inv_product_id_inv_product,inv_inventory_line.inv_inventory_line_amount,inv_inventory_line.inv_inventory_units_inv_inventory_units_id,inv_inventory_line.inv_inventory_line_amount",
		    'join'=>"INNER",
		    'condition'=>"ON inv_inventory.id=inv_inventory_line.inv_inventory_inv_inventory_id" 
		    );
	$all=$db->get_data($config);
	echo json_encode($all);
}

function update_inventory($data){
	// 	var_dump($data);
	global $db;
	$datas = array(
		    'inv_inventory_date' =>$data['inv_inventory_date'],
		    'wp_users_id_users' => $data['wp_users_id_users'],
		    'inv_location_inv_location_id' => $data['inv_location_inv_location_id']  
		    );
	$insert_result=$db->update('inv_inventory',$datas,
		    array( 'id' => $data['id'] ));
	if($insert_result){
		$datas1=array(
				      'inv_inventory_line_amount'=>$data['inv_inventory_line_amount'],
				      'inv_inventory_units_inv_inventory_units_id' => $data['inv_inventory_units_inv_inventory_units_id'],
				      'inv_supplier_inv_supplier_id' => $data['inv_supplier_inv_supplier_id'],
				      'inv_product_id_inv_product' => 
				      $data['inv_product_id_inv_product'],
				      'inv_inventory_line_user_id' => $data['wp_users_id_users'],
				      'inv_inventory_line_date_time' => $data['inv_inventory_date'],
				      'inv_location_line_inv_location_id' => 
				      $data['inv_location_inv_location_id']
				      );
		$insert_result=$db->update('inv_inventory_line',$datas1,array( 'inv_inventory_inv_inventory_id' => $data['id'] ));
	}
	echo $insert_result;
}
function delete_inventory($data){
	global $db;
	$condition=array(
		    'inv_inventory_inv_inventory_id'=>$data['id']
		    );
	$ret=$db->delete('inv_inventory_line',$condition);
	if($ret){
		$condition=array(
				    'id'=>$data['id']
				    );
		$ret=$db->delete('inv_inventory',$condition);
	}
	echo $ret;
}

function add_new_order($data){
	unset($data['action']);
	unset($data['type']);
	// 	var_dump($data);
	global $db;
	// 	$res=$db->insert('inv_inventory',$data);
	// 	echo $res;
	$datas = array(
		    'inv_order_datetime' =>$data['datetime'],
		    'inv_customer_inv_customer_id' => $data['customer'],
		    'inv_order_total' => $data['total']  
		    );
	$insert_result=$db->insert('inv_order_data',$datas);
	$inventory_id=$db->db->lastInsertId();
	if($insert_result){
		$datas1=array(
				      'inv_recipe_id_inv_recipe'=>$data['recipe'],
				      'inv_order_line_qty' =>$data['quantity'],
				      'inv_currency_inv_currency_id' => $data['currency'],
				      'inv_order_data_inv_orderid' => $inventory_id
				      );
		$insert_result=$db->insert('inv_order_details',$datas1);
	}
	echo $insert_result;
}
function get_all_orders(){
	global $db;
	$config=array(
		    'tables'=>array("inv_order_data","inv_order_details"),
		    'fields'=>"inv_order_data.*,inv_order_details.inv_recipe_id_inv_recipe,inv_order_details.inv_order_line_qty,inv_order_details.inv_currency_inv_currency_id",
		    'join'=>"INNER",
		    'condition'=>"ON inv_order_data.inv_order_orderid=inv_order_details.inv_order_data_inv_orderid" 
		    );
	$all=$db->get_data($config);
	echo json_encode($all);
}
function update_orders($data){
	// 	var_dump($data);
	global $db;
	
	$datas=array(
		      'inv_recipe_id_inv_recipe'=>$data['inv_recipe_id_inv_recipe'],
		      'inv_order_line_qty' =>$data['inv_order_line_qty'],
		      'inv_currency_inv_currency_id' => $data['inv_currency_inv_currency_id']
		      );
	$insert_result=$db->update('inv_order_details',$datas,
		    array( 'inv_order_data_inv_orderid' => $data['inv_order_orderid'] ));
	if($insert_result){
		$datas1 = array(
				    'inv_order_datetime' =>$data['inv_order_datetime'],
				    'inv_customer_inv_customer_id' => $data['inv_customer_inv_customer_id'],
				    'inv_order_total' => $data['inv_order_total']  
				    );
		$insert_result=$db->update('inv_order_data',$datas1,array( 'inv_order_orderid' => $data['inv_order_orderid'] ));
	}
	echo $insert_result;
}
function delete_orders($data){
	global $db;
	$condition=array(
		    'inv_order_data_inv_orderid'=>$data['id']
		    );
	$ret=$db->delete('inv_order_details',$condition);
	if($ret){
		$condition=array(
				    'inv_order_orderid'=>$data['id']
				    );
		$ret=$db->delete('inv_order_data',$condition);
	}
	echo $ret;
}
?>