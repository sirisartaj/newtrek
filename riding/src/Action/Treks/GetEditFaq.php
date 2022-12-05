<?php

namespace App\Action\Treks;

use App\Domain\Treks\Treks;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetEditFaq
{
  private $treks;
  public function __construct(Treks $treks)
  {
    $this->treks = $treks;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response, $args 
  ): ResponseInterface
  {
    // var_dump($args);die;
    $faq = $this->treks->getEditFaq($args);
    // var_dump($faq);die();
    $response->getBody()->write((string)json_encode($faq));
    return $response->withHeader('Content-Type', 'application/json');
  }
}