<?php

namespace App\Action\BikeTrips;

use App\Domain\BikeTrips\BikeTrips;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetEditFaq
{
  private $bikeTrips;
  public function __construct(BikeTrips $bikeTrips)
  {
    $this->bikeTrips = $bikeTrips;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response, $args 
  ): ResponseInterface
  {
    // var_dump($args);die;
    $faq = $this->bikeTrips->getEditFaq($args);
    // var_dump($faq);die();
    $response->getBody()->write((string)json_encode($faq));
    return $response->withHeader('Content-Type', 'application/json');
  }
}