<?php

namespace App\Action\Hostels;

use App\Domain\Hostels\Hostels;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetEditFaq
{
  private $hostels;
  public function __construct(Hostels $hostels)
  {
    $this->hostels = $hostels;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response, $args 
  ): ResponseInterface
  {
    // var_dump($args);die;
    $faq = $this->hostels->getEditFaq($args);
    // var_dump($faq);die();
    $response->getBody()->write((string)json_encode($faq));
    return $response->withHeader('Content-Type', 'application/json');
  }
}