<?php

namespace App\Action\Expeditions;

use App\Domain\Expeditions\Expeditions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetEditFaq
{
  private $expeditions;
  public function __construct(Expeditions $expeditions)
  {
    $this->expeditions = $expeditions;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response, $args 
  ): ResponseInterface
  {
    // var_dump($args);die;
    $faq = $this->expeditions->getEditFaq($args);
    // var_dump($faq);die();
    $response->getBody()->write((string)json_encode($faq));
    return $response->withHeader('Content-Type', 'application/json');
  }
}