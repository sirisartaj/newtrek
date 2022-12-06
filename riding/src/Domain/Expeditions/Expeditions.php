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
        
        
        $created_date = date("Y-m-d H:i:s");
        
        $data['createdDate'] = $created_date;
        $expeditionId = $this->repository->insertExpedition($data);
        if(!empty($expeditionId) && $expeditionId != '0'){  
          
           $status = array(
                    'status' => "200",
                    'message' => "Expeditions Details Added Successfully",
                    'expedition_id' => $expeditionId
                    );
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
  public function deleteExpedition($data) {
    $Expedition = $this->repository->deleteExpedition($data);
    return $Expedition;
  }
  
  public function getItineraryExpedition($data) {
    $Expedition = $this->repository->getItineraryExpedition($data);
    return $Expedition;
  }

  public function getBatches($data) {
    $Expedition = $this->repository->getBatches($data);
    return $Expedition;
  }
  public function addBatch($data) {
    $Expedition = $this->repository->addBatch($data);
    return $Expedition;
  }
  public function getBatch($data) {
    $Expedition = $this->repository->getBatch($data);
    return $Expedition;
  }
  public function updateBatch($data) {
    $Expedition = $this->repository->updateBatch($data);
    return $Expedition;
  }
  public function getExpeditionFee($data) {
    $Expedition = $this->repository->getExpeditionFee($data);
    return $Expedition;
  }
  public function updateExpeditionFee($data) {
    $Expedition = $this->repository->updateExpeditionFee($data);
    return $Expedition;
  }
  public function updatePopular($data) {
    $Expedition = $this->repository->updatePopular($data);
    return $Expedition;
  }
  public function getBatchBookings($data) {
    $Expedition = $this->repository->getBatchBookings($data);
    return $Expedition;
  }
  public function getBookings() {
    $Expedition = $this->repository->getBookings();
    return $Expedition;
  }
  public function getParticipants($data) {
    $Expedition = $this->repository->getParticipants($data);
    return $Expedition;
  }
  public function getBookingDetails($data) {
    $Expedition = $this->repository->getBookingDetails($data);
    return $Expedition;
  }
  public function addOrganizer($data) {
    $Expedition = $this->repository->addOrganizer($data);
    return $Expedition;
  }
  public function getOrganizerDetails($data) {
    $Expedition = $this->repository->getOrganizerDetails($data);
    return $Expedition;
  }
  public function getOrganizerExpeditions($data) {
    $Expedition = $this->repository->getOrganizerExpeditions($data);
    return $Expedition;
  }
  public function deleteOrganizer($data) {
    $Expedition = $this->repository->deleteOrganizer($data);
    return $Expedition;
  }
  public function addExpeditionCoupon($data) {
    $Expedition = $this->repository->addExpeditionCoupon($data);
    return $Expedition;
  }
  public function getExpeditionCoupons($data) {
    $Expedition = $this->repository->getExpeditionCoupons($data);
    return $Expedition;
  }
  public function getCouponExpeditions($data) {
    $Expedition = $this->repository->getCouponExpeditions($data);
    return $Expedition;
  }
  public function deleteExpeditionCoupon($data) {
    $Expedition = $this->repository->deleteExpeditionCoupon($data);
    return $Expedition;
  }
  public function getExpeditionGallery($data) {
    $Expedition = $this->repository->getExpeditionGallery($data);
    return $Expedition;
  }
  public function addExpeditionGallery($data) {
    extract($data);
    if(isset($expeditionImage['name'])&&!empty($expeditionImage['name'])){
      $filedir = UPLOADPATH."expeditions/"; 
      // $filedir = UPLOADPATH."expeditions/gallery/"; 
      $randName = rand(10101010, 9090909090);
      $newName = "Expedition_". $randName;
      $ext = substr($expeditionImage['name'], strrpos($expeditionImage['name'], '.') + 1);
      if(($ext == 'jpg')||($ext=='jpeg')||($ext=='png')||($ext=='gif')){
        list($width, $height) = getimagesize($expeditionImage['tmp_name']); 
        $ImageUpload = new ImageUpload;
        $ImageUpload->File = $expeditionImage;
        $ImageUpload->method = 1;
        $ImageUpload->SavePath = $filedir;
        $ImageUpload->NewWidth = $width;
        $ImageUpload->NewHeight = $height;
        $ImageUpload->NewName = $newName;
        $ImageUpload->OverWrite = true;
        $err = $ImageUpload->UploadFile();
        $expeditiongal_image = $newName.".".strtolower($ext);
      }else{
        $status = array(
            'status' => "400",
            'message' => "Failure Please upload jpg,png,gift,jpeg images only"
        );
        return $status;
      }
    }
    $data['expeditiongal_image'] = $expeditiongal_image;
    $expedition = $this->repository->addExpeditionGallery($data);
    return $expedition;
  }
  public function deleteExpeditionGallery($data) {
    $Expedition = $this->repository->deleteExpeditionGallery($data);
    return $Expedition;
  }
  public function getExpeditionReviews() {
    $Expedition = $this->repository->getExpeditionReviews();
    return $Expedition;
  }
  public function addExpeditionReview($data) {
    extract($data);
    if(empty($name))
    {
      $status = array(
      'status' => "206",
      'message' => "Failure name is required"
      );
    }else{
      $status = $this->repository->addExpeditionReview($data);
    }
    return $status;
  }
  public function getExpeditionReview($data) {
    $Expedition = $this->repository->getExpeditionReview($data);
    return $Expedition;
  }
  public function updateExpeditionReview($data) {
    $Expedition = $this->repository->updateExpeditionReview($data);
    return $Expedition;
  }
  public function addExpeditionRentals($data) {
    extract($data);
    if(empty($expeditionId)||empty($rentalItem)){
      $status = array(
      'status' => "206",
      'message' => "Failure Please enter proper data"
      );
    }
    else{
      $status = $this->repository->addExpeditionRentals($data);
    }
    return $status;
  }
  public function getExpeditionRentals($data) {
    $Expedition = $this->repository->getExpeditionRentals($data);
    return $Expedition;
  }
  public function getRentalExpeditions($data) {
    $Expedition = $this->repository->getRentalExpeditions($data);
    return $Expedition;
  }
  public function getBatchRentals($data) {
    $Expedition = $this->repository->getBatchRentals($data);
    return $Expedition;
  }
  public function getExpeditionBatchRental($data) {
    $Expedition = $this->repository->getExpeditionBatchRental($data);
    return $Expedition;
  }
  public function deleteExpeditionRental($data) {
    $Expedition = $this->repository->deleteExpeditionRental($data);
    return $Expedition;
  }
  public function getTransactions() {
    $Expedition = $this->repository->getTransactions();
    return $Expedition;
  }
  public function getTransactionDetails($data) {
     $Expedition = $this->repository->getTransactionDetails($data);
    return $Expedition;
  }
  public function addExpeditionFaq($data) {
    $Expedition = $this->repository->addExpeditionFaq($data);
    return $Expedition;
  }
  public function updateExpeditionFaq($data) {
    $Expedition = $this->repository->updateExpeditionFaq($data);
    return $Expedition;
  }
  public function getFaq($data) {
    $Expedition = $this->repository->getFaq($data);
    return $Expedition;
  }
  public function getEditFaq($data) {
    // var_dump($data);die();
    $Expedition = $this->repository->getEditFaq($data);
    return $Expedition;
  }
  public function updateExpeditionStatus($data) {
    $Expedition = $this->repository->updateExpeditionStatus($data);
    return $Expedition;
  }
  public function updateBatchStatus($data) {
    $Expedition = $this->repository->updateBatchStatus($data);
    return $Expedition;
  }
  public function updateOrganizerStatus($data) {
    $Expedition = $this->repository->updateOrganizerStatus($data);
    return $Expedition;
  }
  public function updateCouponStatus($data) {
    $Expedition = $this->repository->updateCouponStatus($data);
    return $Expedition;
  }
  public function updateExpeditionImageStatus($data) {
    $Expedition = $this->repository->updateExpeditionImageStatus($data);
    return $Expedition;
  }
  public function updateExpeditionRentalStatus($data) {
    $Expedition = $this->repository->updateExpeditionRentalStatus($data);
    return $Expedition;
  }
  public function updateExpeditionFaqStatus($data) {
    $Expedition = $this->repository->updateExpeditionFaqStatus($data);
    return $Expedition;
  }
  public function UpdateIterinary($data) {
     $Expedition =  $this->repository->updateExpeditionIterinaryDetails($data);
    return $Expedition;
  }
}