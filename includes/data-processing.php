<?php

/******************************
* data processing
******************************/

// this function saves the data
add_action("wp_ajax_inventory_crud_function", "inventory_crud_function");
add_action("wp_ajax_nopriv_inventory_crud_function", "inventory_crud_function");
// function my_ajax() {

//    /*if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_vote_nonce")) {
//       exit("No naughty business please");
//    }*/
//    $sku=$_REQUEST['sku'];
//    $pur=$_REQUEST['pur'];
//    $sold=$_REQUEST['sold'];
//    //echo $sold.''.$sku.''.$pur;
//    global $wpdb;
//    $table = $wpdb->prefix."postmeta";
//    $result= array();
//    if($pur!='' or $sold!='')
//    {
//    //$liveposts = $wpdb->get_results("SELECT * FROM $table");
//    $liveposts = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table where meta_key=%s and meta_value=%s",'_sku',$sku));
//    $num=$wpdb->num_rows;
//        if($num>0){
//              foreach ($liveposts as $livepost)
//              {
//               $p1=$livepost->post_id;
//               $stok=$wpdb->get_results("SELECT meta_value FROM $table where meta_key='_stock' and post_id='$p1'");
//               foreach ($stok as $quantity) {
//                  $q=$quantity->meta_value;
//                   if ($pur=='' and $sold!='') {
//                     if($sold<$q)
//                     {
//                     $q=$q-$sold;
//                     $wpdb->get_results("UPDATE $table SET `meta_value` =$q WHERE `post_id` ='$p1' and `meta_key`='_stock'");
//                     $result['result']="<div class='result'>New Quantity for ".$sku." has been changed to ".$q."</div>";
//                     }
//                     else
//                     $result['result']="<div class='err'>Present Quantity is less then given value.</div>";
//                  }
//                  elseif ($sold=='' and $pur!='') {

//                   $q=$q+$pur;
//                   $wpdb->get_results("UPDATE $table SET `meta_value` =$q WHERE `post_id` ='$p1' and `meta_key`='_stock'");
//                   $result['result']="<div class='result'>New Quantity for ".$sku." has been changed to ".$q."</div>";

//                  }
//                //

//               }
//              }
//           }
//           else $result['result']="<div class='err'>No products found With SKU ".$sku."</div>"; 
//      }
//      else
//     $result['result']="<div class='err'>Purchased or Sold Quantity Must be given</div>";
//     echo __($result['result'],'aia');
// }

function inventory_crud_function(){
  global $wpdb; // global initialization for database query
  $data=$_REQUEST;
  // echo var_dump($_REQUEST);
  $type=$_REQUEST['type'];
  switch ($type) {
    case 'add_new_user':
    add_new_user($data);
    break;
    case 'get_currency':
    get_currency();
    break;
    case 'get_all_user':
    get_all_user();
    break;
    case 'add_new_product_cat':
    add_new_product_cat($data);
    break;

    case 'get_product_category':
    get_product_category();
    break;
    case 'delete':
    delete($data);
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
function get_currency(){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT * FROM inv_currency");
  // var_dump($fivesdrafts);
  echo json_encode($fivesdrafts);
}
function get_all_user(){
  global $wpdb;
  $fivesdrafts = $wpdb->get_results("SELECT * FROM inv_customer INNER JOIN inv_currency ON inv_customer.inv_currency_inv_currency_id=inv_currency.id");
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
  $fivesdrafts = $wpdb->get_results("SELECT * FROM inv_product_cat");
  // var_dump($fivesdrafts);
  echo json_encode($fivesdrafts);
}
function delete($data){
  // var_dump($data);
  global $wpdb;
  $ret=$wpdb->query($wpdb->prepare("DELETE FROM ".$data['table']." WHERE id=".$data['id']));
    echo $ret;
}
?>