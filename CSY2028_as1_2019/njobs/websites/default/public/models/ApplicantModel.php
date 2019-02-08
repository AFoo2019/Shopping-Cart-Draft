<?php
namespace models;

class ApplicantModel extends \core\Model{

  public function __construct($pdo){
    $this->TABLE_NAME='applicants';
    parent::__construct($pdo,$this->TABLE_NAME);
  }
  // public function apply($aid,$jid){
  //   try{
  //     // $this->insert('applicantjobs', ['applicantid'=>$aid, 'jobid'=>$jid]);
  //     // throw new Exception('You already applied for this job');
  //   }
  //   catch (\Exception $e){
  //
  //
  //     var_dump($e->getMessage());
  //    }
  //
  // }
  public function apply(){
    $this->save('applicantjobs', ['id'=>$_GET['id'],'applicantid'=>$_GET['applicantid'], 'jobid'=>$_GET['jobid']],'id');
  }
}
?>
