<?php
namespace App\Domain\Expeditions;

use App\Domain\Expeditions\ExpeditionsRepository;
use App\Exception\ValidationException;
use App\Utilities\ImageUpload;

/**
 * Service.
 */
final class Expeditions
{
  /**
   * @var ExpeditionsRepository
   */
  private $repository;
  /**
   * The constructor.
   *
   * @param ExpeditionsRepository $repository The repository
   */
  public function __construct(ExpeditionsRepository $repository)
  {
    $this->repository = $repository;
  }
  public function getExpeditions(): array
  {        
    $Expeditions = $this->repository->getExpeditions();
    return $Expeditions;
  }
  public function addExpedition($data) {
    extract($data);
    if(empty($Expedition_title))
    {
      $status = array(
      'status' => "208",
      'message' => "Failure Expedition name is required"
      );
    }else{
      $expeditionExist = $this->repository->checkExpeditionName($Expedition_title);
      if($expeditionExist == '0')
      {
        if(isset($expeditionImage['name'])&&!empty($expeditionImage['name']))
        {
          $filedir = UPLOADPATH."expeditions/"; 
          $randName = rand(10101010, 9090909090);
          $newName = "Expedition_". $randName;
          $ext = substr($expeditionImage['name'], strrpos($expeditionImage['name'], '.') + 1);
          list($width, $height) = getimagesize($expeditionImage['tmp_name']); 
          if(($ext == 'jpg')||($ext=='jpeg')||($ext=='png')||($ext=='gif')){
            $ImageUpload = new ImageUpload;
            $ImageUpload->File = $expeditionImage;
            $ImageUpload->method = 1;
            $ImageUpload->SavePath = $filedir;
            $ImageUpload->NewWidth = $width;
            $ImageUpload->NewHeight = $height;
            $ImageUpload->NewName = $newName;
            $ImageUpload->OverWrite = true;
            $err = $ImageUpload->UploadFile();
            $expeditionImage = $newName.".".strtolower($ext);
          }
          else{
              $status = array(
                  'status' => "304",
                  'message' => "Failure Please upload jpg,png,gift,jpeg images only"
               );
            return $status;
          }
        }
        if(isset($overviewImage['name'])&&!empty($overviewImage['name'])){
          $filedir = UPLOADPATH."expeditions/"; 
          $randName = rand(10101010, 9090909090);
          $newName = "Expeditionpagebanner_". $randName;
          $ext = substr($overviewImage['name'], strrpos($overviewImage['name'], '.') + 1);
          list($width, $height) = getimagesize($overviewImage['tmp_name']); 
          if(($ext == 'jpg')||($ext=='jpeg')||($ext=='png')||($ext=='gif')){
            $ImageUpload = new ImageUpload;
            $ImageUpload->File = $overviewImage;
            $ImageUpload->method = 1;
            $ImageUpload->SavePath = $filedir;
            $ImageUpload->NewWidth = $width;
            $ImageUpload->NewHeight = $height;
            $ImageUpload->NewName = $newName;
            $ImageUpload->OverWrite = true;
            $err = $ImageUpload->UploadFile();
            $overviewImage = $newName.".".strtolower($ext);
          }
          else{
            $status = array(
              'status' => "304",
              'message' => "Failure Please upload jpg,png,gift,jpeg images only"
            );
            return $status;
          }
        }
        $created_date = date("Y-m-d H:i:s");
        $data['expeditionImage'] = $expeditionImage;
        $data['overviewImage'] = $overviewImage;
        $data['createdDate'] = $created_date;
        $expeditionId = $this->repository->insertExpedition($data);
        if(!empty($expeditionId) && $expeditionId != '0'){  
         $status = array(
                    'status' => "200",
                    'message' => "Expeditions Added Successfully");
          /*for($x = 0;$x < $count;$x++){
            $data1['expeditionId'] = $expeditionId;
            $data1['description'] = $description[$x];
            $data1['title'] = @$title[$x];
            $data1['createdDate'] = $created_date;
            $data1['createdBy'] = $created_by;
            $data1['status'] = $status;
            $iterinary = $this->repository->addExpeditionIterinaryDetails($data1);
          }*/
          
          
        } else {
          $status = array(
                    'status' => "304",
                    'message' => "Expeditions Details Not Added Successfully");
        }
      }
      else{
        $status = array(
          'status' => "208",
          'message' => "Failure Expedition name exist"
       );
      } 
    }
    return $status;
  }
  public function updateExpedition($data) {
    extract($data);
    if(empty($expedition_title))
    {
      $status = array(
                'status' => "208",
                'message' => "Failure expeditionname is required"
                );
    }else{
      $expeditionExist = $this->repository->checkExpedition($expedition_title,$expedition_id);
      if ($expeditionExist == '0')
      {
        
        $res = $this->repository->updateExpedition($data);    
        if($res == 'true'){
          
          $data['expeditionId'] = $expeditionId;
           
          $status = array(
            'status' => "200",
            'message' => "Successfully Updated");
        } else{
          $status = array(
          'status' => "304",
          'message' => "Expeditions Details Not Updated Successfully");
          
        }
      }else{
        $status = array(
                  'status' => "208",
                  'message' => "Failure Expedition name exist"
              );
      }
    }    
    return $status;
  }
  public function getExpedition($data) {
    $Expedition = $this->repository->getExpedition($data);
    return $Expedition;
  }
  public function UpdateIterinary($data) {
    
      $this->repository->updateExpeditionIterinaryDetails($data);
    
    return $Expedition;
  }

  public function getItineraryExpedition($data) {
    $Expedition = $this->repository->getItineraryExpedition($data);
    return $Expedition;
  }
  public function deleteExpedition($data) {
    $Expedition = $this->repository->deleteExpedition($data);
    return $Expedition;
  }
  
  public function DeleteIterinary($data) {
    $Expedition = $this->repository->DeleteIterinary($data);
    return $Expedition;
  }
  

}