<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FooService
{

  const KEY = 'app.title';
  
  private $params;
  private $key;

  public function __construct(
    ParameterBagInterface $params
  )
  {
    $this->params = $params;
    $this->key = $params->get(self::KEY);
  }

  public function getKey(): string
  {
    return $this->key;
  }

  public function setParameter(string $parameters): array
  {
    $array = [];
    foreach (explode(',', $parameters) as $value) {
      if (!empty($value)) {
        $array[] = $value;
      }
    }

    return $array;
  }

}