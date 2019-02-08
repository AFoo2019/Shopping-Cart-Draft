<?php
namespace models;

  class JobModel extends \core\Model{
    public $table;
    public $categories;
    public $joblist;
  public function __construct($pdo){
    $this->TABLE_NAME='jobss';
    parent::__construct($pdo,$this->TABLE_NAME);

    $this->categories=$this->findAll('categories');
  }
  public function listby($param){
    $this->joblist=$this->find('jobss','categoryid',$param);

  }
  public function apply($jobid,$applicantid){
    $this->save('applicantjobs', ['id'=>'','applicantid'=>$applicantid, 'jobid'=>$jobid],'id');
  }
  public function listbyemail($param){
    $i=0;
    $j=0;
    $k=0;
    $id=$this->findValues('id','applicants','applicantemail',$param);
    var_dump(count($id));
    while($i<count($id)){
      $id=$this->findValues('id','applicants','applicantemail',$param)[$i][0];
      var_dump($id);
      echo "in loop a";
      $jobs=$this->findValues('jobid','applicantjobs','applicantid',$id);
      var_dump($jobs);
      while($j<count($jobs)){
        $jobs=$this->findValues('jobid','applicantjobs','applicantid',$id)[$j][0];
        var_dump($jobs);
        echo "in loop b";
        $this->joblist=$this->findValues('jobtitle','jobss','id',$jobs)[0];
        var_dump($this->joblist);
        $j++;
      }
      $i++;
    }

  }
}

?>
