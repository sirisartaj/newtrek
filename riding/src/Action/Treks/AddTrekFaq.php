<?php

namespace App\Action\Treks;

use App\Domain\Treks\Treks;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddTrekFaq
{
  private $treks;
  public function __construct(Treks $treks)
  {
    $this->treks = $treks;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response
  ): ResponseInterface 
  {
    // var_dump($request->getBody());die();
    $data = $request->getBody();
    $data =(array) json_decode($data);
    // var_dump($data);die();
    $treks = $this->treks->addTrekFaq($data);
    $response->getBody()->write((string)json_encode($treks));
    return $response
          ->withHeader('Content-Type', 'application/json');
  }
}