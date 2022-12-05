<?php

namespace App\Action\LeisurePackages;

use App\Domain\LeisurePackages\LeisurePackages;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetEditFaq
{
  private $leisurePackages;
  public function __construct(LeisurePackages $leisurePackages)
  {
    $this->leisurePackages = $leisurePackages;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response, $args 
  ): ResponseInterface
  {
    // var_dump($args);die;
    $faq = $this->leisurePackages->getEditFaq($args);
    // var_dump($faq);die();
    $response->getBody()->write((string)json_encode($faq));
    return $response->withHeader('Content-Type', 'application/json');
  }
}