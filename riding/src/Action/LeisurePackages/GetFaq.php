<?php

namespace App\Action\LeisurePackages;

use App\Domain\LeisurePackages\LeisurePackages;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetFaq
{
  private $lp;
  public function __construct(LeisurePackages $lp)
  {
    $this->lp = $lp;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response, $args 
  ): ResponseInterface
  {
    $lp = $this->lp->getFaq($args);
    $response->getBody()->write((string)json_encode($lp));
    return $response->withHeader('Content-Type', 'application/json');
  }
}