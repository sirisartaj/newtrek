<?php

namespace App\Action;

use App\Domain\Users\Service\Users;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ForgotPassword
{
  private $users;
  public function __construct(Users $users)
  {
    $this->users = $users;
  }
  public function __invoke(
      ServerRequestInterface $request, 
      ResponseInterface $response
  ): ResponseInterface 
  {
    $data = $request->getBody();
    $data =(array) json_decode($data);
    //$uploadedFiles = $request->getUploadedFiles();
    $users = $this->users->forgotPassword($data);
    $response->getBody()->write((string)json_encode($users));
    return $response
          ->withHeader('Content-Type', 'application/json');
  }
}