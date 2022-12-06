<?php
namespace App\Domain\LeisurePackages;

use App\Domain\LeisurePackages\LeisurePackagesRepository;
use App\Exception\ValidationException;
use App\Utilities\ImageUpload;

/**
 * Service.
 */
final class LeisurePackages
{
  /**
   * @var LeisurePackagesRepository
   */
  private $repository;
  /**
   * The constructor.
   *
   * @param LeisurePackagesRepository $repository The repository
   */
  public function __construct(LeisurePackagesRepository $repository)
  {
    $this->repository = $repository;
  }
  public function getLeisurePackages(): array
  {   
    $LeisurePackages = $this->repository->getLeisurePackages();
    return $LeisurePackages;
  }
  public function addLeisurePackage($data) {
    extract($data);    
    
    $LeisurePackages = $this->repository->addLeisurePackage($data);
    return $LeisurePackages;
  }
 public function updateLeisurePackage($data) {
    
    extract($data);
    
    $LeisurePackages = $this->repository->updateLeisurePackage($data);
    return $LeisurePackages;
  }
  public function getLeisurePackage($data): array
  {        
    $LeisurePackages = $this->repository->getLeisurePackage($data);
    return $LeisurePackages;
  }
  public function updateLeisurePackageStatus($data) {
    $LeisurePackages = $this->repository->updateLeisurePackageStatus($data);
    return $LeisurePackages;
  }
  public function addAddOnActivity($data) {
    $LeisurePackages = $this->repository->addAddOnActivity($data);
    return $LeisurePackages;
  }
  public function updateAddOnActivity($data) {
    $LeisurePackages = $this->repository->updateAddOnActivity($data);
    return $LeisurePackages;
  }
  public function getAddOnActivity($data) {
    $LeisurePackages = $this->repository->getAddOnActivity($data);
    return $LeisurePackages;
  }
  public function updateAddOnActivityStatus($data) {
    $LeisurePackages = $this->repository->updateAddOnActivityStatus($data);
    return $LeisurePackages;
  }
  public function getFaq($data) {
    $LeisurePackages = $this->repository->getFaq($data);
    return $LeisurePackages;
  }
  public function addLpFaq($data) {
    $LeisurePackages = $this->repository->addLpFaq($data);
    return $LeisurePackages;
  }
  public function getEditFaq($data) {
    $LeisurePackages = $this->repository->getEditFaq($data);
    return $LeisurePackages;
  }
  public function updateLpFaq($data) {
    $LeisurePackages = $this->repository->updateLpFaq($data);
    return $LeisurePackages;
  }
  public function updateLpFaqStatus($data) {
    $LeisurePackages = $this->repository->updateLpFaqStatus($data);
    return $LeisurePackages;
  }
  public function getGallery($data) {
    $LeisurePackages = $this->repository->getGallery($data);
    return $LeisurePackages; 
  }
  public function addGallery($data) {
    $LeisurePackages = $this->repository->addGallery($data);
    return $LeisurePackages; 
  }
  public function DeleteGallery($data) {
    $LeisurePackages = $this->repository->DeleteGallery($data);
    return $LeisurePackages; 
  }
  public function getItineraryLeisure($data) {
    $LeisurePackagesItinerary = $this->repository->getItineraryLeisure($data);
    return $LeisurePackagesItinerary;
  }
  public function editLeisureIterinary($data) {
    $editLeisurePackagesItinerary = $this->repository->updateLeisureitinerary($data);
    return $editLeisurePackagesItinerary;
  } 
  public function addLeisureIterinary($data) {
    $addLeisureIterinary = $this->repository->addLeisureIterinary($data);
    return $addLeisureIterinary;
  }
   public function UpdateLeisurePackageitiStatus($data) {
    $UpdateLeisurePackageitiStatus = $this->repository->UpdateLeisurePackageitiStatus($data);
    return $UpdateLeisurePackageitiStatus;
  }
  
}