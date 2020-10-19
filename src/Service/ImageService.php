<?php

namespace App\Service;

use League\Glide\ServerFactory;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Symfony\Component\HttpClient\HttpClient;
use League\Glide\Responses\SymfonyResponseFactory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImageService
{
  private $signKey;
  private $cachePath;
  private $imgPath;
  private $server;
  private $client;

  public function __construct(String $signKey, String $imgPath, String $cachePath, ParameterBagInterface $parameterBag)
  {
      $this->signKey = $signKey;
      $this->cachePath = $cachePath;
      $this->imgPath = $imgPath;
      $this->client = HttpClient::create();
      
      $this->server = ServerFactory::create([
        'source' =>new Filesystem(new Local($this->imgPath)),
        'cache'  => $this->cachePath,
        'response' => new SymfonyResponseFactory(),
        'defaults' => [
            'fm'  => 'jpg',
            'fit' => 'fit'
        ]
      ]);
  }

  public function getResizedImage(int $width = null, int $height = null, String $fit = null, string $path)
  {
    return $this->server->getImageResponse($path, $this->makeParamsArray($width, $height, $fit));
  }

  public function getResizedStream(int $width = null, int $height = null, String $fit = null, string $url)
  { 
    $fullname = $this->createImgFromStream($url);
    if($fullname)
    {
      return $this->getResizedImage($width, $height, $fit, $fullname);
    }
  }

  public function createImgFromStream(String $url)
  {
    try{
      $res = $this->client->request('GET', $url);
      if($res->getStatusCode() == 200)
      {
        $content = $res->getContent();
        $filename = explode('/', $url);
        $fullname = $this->imgPath.'/'.array_pop($filename);
        $file = file_put_contents($fullname, $content);
        return $fullname;
      }
      return null;
    }
    catch(\Exception $e)
    {
      return null;
    }
  }

  private function makeParamsArray(int $width = null, int $height = null, String $fit = null)
  {
    $params = [];
    if($width != null) {
      $params['w'] = $width;
    }
    if($height != null) {
      $params['h'] = $height;
    }
    if($fit != null) {
      $params['fit'] = $fit;
    }
    return $params;
  }
}