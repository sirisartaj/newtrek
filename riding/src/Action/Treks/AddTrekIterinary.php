<?php

namespace App\Action\Treks;

use App\Domain\Treks\Treks;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddTrekIterinary
{
  private $Treks;
  public function __construct(Treks $Treks)
  {
    $this->Treks = $Treks;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response
  ): ResponseInterface 
  {
      $data = $request->getBody();
     $data =(array) json_decode($data);
    $Treks = $this->Treks->addTrekIterinary($data);
    $response->getBody()->write((string)json_encode($Treks));
    return $response
          ->withHeader('Content-Type', 'application/json');
  }
}