<?php
namespace carshop;

class Routes {
    public $table = array();

    public function __construct() {
      //admin routes
        $this->table['jobss'] = array(new \core\Router('JobModel', 'HomeView', 'BController'),'');
        // $this->table['storysave']= array(new \core\Router('HomeModel', 'HomeAdminView', 'BController'),'login');

        $this->table['access'] =  array(new \core\Router('AccountModel', 'AccessView', 'AccessController'),'');

        $this->table['accounts'] =  array(new \core\Router('AccountModel', 'AccountView', 'BController'),'login');
        $this->table['accountsave'] =  array(new \core\Router('AccountModel', 'AccountAdminView', 'AccessController'),'login');

        // $this->table['applicants'] =  array(new \core\Router('ApplicantModel', 'ApplicantListView', 'ApplicantController'),'login');
        $this->table['applicantsbyjob'] =  array(new \core\Router('ApplicantModel', 'ApplicantsByJobView', 'ApplicantController'),'');
        $this->table['applicantregister'] =  array(new \core\Router('ApplicantModel', 'ApplicantRegisterView', 'ApplicantController'),'login');

        // $this->table['jobss'] =  array(new \core\Router('JobModel', 'JobView', 'JobController'),'');
        $this->table['jobsave'] =  array(new \core\Router('JobModel', 'JobAdminView', 'JobController'),'login');
        $this->table['jobfilteredlist'] =  array(new \core\Router('JobModel', 'JobFilteredView', 'JobController'),'login');

        $this->table['categories'] =  array(new \core\Router('CategoryModel', 'CategoryView', 'BController'),'login');
        $this->table['shop'] =  array(new \core\Router('JobModel', 'HomeView', 'ShopController'),'');
        $this->table['payment'] =  array(new \core\Router('JobModel', 'CartView', 'ShopController'),'');


    }
    public function getRoute($route) {
      if ( !isset($this->table[$route][0])) {
        return $this->table['jobss'][0];
      }
      elseif( $this->table[$route][1]==='login'&& isset($_SESSION['loggedin'])){//should be !isset.condition isset is a quick fix.
        return $this->table['jobss'][0];
      }
        $route = strtolower($route);
        return $this->table[$route][0];
    }
}
?>
