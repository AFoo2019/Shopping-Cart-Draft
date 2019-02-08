<?php
namespace views;

class JobAdminView extends \core\View{
  public $form;
  public $row;
  public $categorys;
  public $categorylist;
  public $defaultcategory;
  public function __construct($route, $model) {
      parent::__construct($route,$model);
      $this->form   = new \core\Template('./views/templates/admin_jobs_tpl.html');
      $this->categorylist='';

      if (isset($_GET['id'])) {
        $this->row=$this->model->find('jobss','id',$_GET['id'])[0];

        $this->defaultcategory=$this->model->findValues('category','categories','id',$this->row['categoryid']);

      }
      else {
        $this->row = null;
      }
      $this->form->set('jobtitle',$this->row['jobtitle']);
      $this->form->set('jobdateofpub',date("Y-m-d"));
      $this->form->set('joblocation',$this->row['joblocation']);
      $this->form->set('jobdescription',$this->row['jobdescription']);
      $this->form->set('jobid',$this->row['id']);





      //set values in the select box
      foreach ($this->model->categories as $category) {
        if($category['category']===$this->defaultcategory){
          $this->categorylist.='<option selected="">Select Category</option>';
        }
        else{
          $this->categorylist.= '<option value="'. $category['id'].'">'. $category['category'].'</option>';
        }
      }
      $this->form->set('categoryoptions',$this->categorylist);

      $this->content.=$this->form->output();
    }
  }
  ?>
