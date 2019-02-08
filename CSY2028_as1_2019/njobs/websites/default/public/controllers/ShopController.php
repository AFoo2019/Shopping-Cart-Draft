<?php
namespace controllers;


class ShopController extends \core\Controller{
  public function __construct($model){
    parent::__construct($model);

  }
  public function add(){
    if(!empty($_POST["quantity"])) {

    foreach( $this->model->find('jobss','id',$_GET['jobid']) as $k => $v){
      var_dump($v);
      $productByCode=$v;
      	$itemArray = array($productByCode["id"]=>array('name'=>$productByCode["jobtitle"], 'code'=>$productByCode["id"], 'quantity'=>(int)$_POST["quantity"], 'price'=>(int)$productByCode["joblocation"]));
    }


		if(!empty($_SESSION["cart_item"])) {

			if(in_array($productByCode["id"],array_keys($_SESSION["cart_item"]))) {//if item in cart
				foreach($_SESSION["cart_item"] as $k => $v) {//for each item k in the cart
						if($productByCode["id"] == $k) {//if item k in cart
							if(empty($_SESSION["cart_item"][$k]["quantity"])) {//if cart empty (=NULL)set qty<-0
								$_SESSION["cart_item"][$k]["quantity"] = 0;
							}
							$_SESSION["cart_item"][$k]["quantity"] += (int)$_POST["quantity"];//otherwise cart item k qty<- qty=qty+post qty
						}
				}
			} else {
				$_SESSION["cart_item"] =$_SESSION["cart_item"]+$itemArray;//if not in cart add product to cart
			}
		} else {
			$_SESSION["cart_item"] = $itemArray;//if cart empty add product
		}
	}
  }
  public function remove(){
    if(!empty($_SESSION["cart_item"])) {
        foreach($_SESSION["cart_item"] as $k => $v) {
          if($_SESSION["cart_item"][$k]["code"]==$_GET["jobid"])
          unset($_SESSION["cart_item"][$k]);
          if(empty($_SESSION["cart_item"]))
          unset($_SESSION["cart_item"]);
      }
    }
    if(empty($_SESSION["cart_item"])) {
      unset($_SESSION["cart_item"]);
    }
    header('Location:'. $_SERVER['HTTP_REFERER']);
  }
}
?>
