<?php
namespace views;

class CartView extends \core\View{
  public $form;
  public $row;

  public function __construct($route, $model) {
      parent::__construct($route,$model);
      $total_quantity=0;
      $total_price=0;
      $this->section   = new \core\Template('./views/templates/tpl_cart.html');
      $this->list_item   = new \core\Template('./views/templates/tpl_cart_list.html');
      $this->temp = '';
      if(!empty($_SESSION["cart_item"])){
      foreach ($_SESSION["cart_item"] as $item){
            $item_price = $item["quantity"]*$item["price"];

    	      $this->list_item->set('quantity',$item["quantity"]);
            $this->list_item->set('price',$item['price']);
            $this->list_item->set('name',$item['name']);

              $this->list_item->set('jobid',$item['code']);
    				$total_quantity += $item["quantity"];
    				$total_price += ($item["price"]*$item["quantity"]);

            $this->temp.=$this->list_item->output();
    		}
        }
        $this->section->set('list',$this->temp);
        $this->section->set('total_quantity',$total_quantity);
        $this->section->set('total_price',$total_price);

        $this->content.=$this->section->output();

}
}
