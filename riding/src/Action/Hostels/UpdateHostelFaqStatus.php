<?php

namespace App\Action\Hostels;

use App\Domain\Hostels\Hostels;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UpdateHostelFaqStatus
{
  private $hostels;
  public function __construct(Hostels $hostels)
  {
    $this->hostels = $hostels;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response
  ): ResponseInterface 
  {
     $data = $request->getBody();
    $data =(array) json_decode($data); 
    //$data = array_merge($_POST, $_FILES);
    $res = $this->hostels->updateHostelFaqStatus($data);
    $response->getBody()->write((string)json_encode($res));
    return $response
          ->withHeader('Content-Type', 'application/json');
  }
}