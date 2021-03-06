<?php

namespace App\Service;

use League\Glide\ServerFactory;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Symfony\Component\HttpClient\HttpClient;
use League\Glide\Responses\SymfonyResponseFactory;

class ImageService
{
  private $signKey; //Pas encore implémenté
  private $cachePath;
  private $imgPath;
  private $server;
  private $client;
  private $streamUrl;

  public function __construct(String $signKey, String $imgPath, String $cachePath, String $streamUrl)
  {
      $this->signKey = $signKey;
      $this->cachePath = $cachePath;
      $this->imgPath = $imgPath;
      $this->client = HttpClient::create();
      $this->streamUrl = $streamUrl;
      
      $this->server = ServerFactory::create([
        'source' => new Filesystem(new Local($this->imgPath)),
        'cache'  => new Filesystem(new Local($this->cachePath)),
        'response' => new SymfonyResponseFactory(),
        'defaults' => [
            'fm'  => 'jpg',
            'fit' => 'fit'
        ]
      ]);
  }

  /**
   * Méthode de redimmensionnement d'un fichier image
   */
  public function getResizedImage(int $width = null, int $height = null, String $fit = null, string $path)
  {
    return $this->server->getImageResponse($path, $this->makeParamsArray($width, $height, $fit));
  }

  /**
   * Méthode de redimmensionnement d'une image streamée
   */
  public function getResizedStream(int $width = null, int $height = null, String $fit = null, string $path)
  { 
    $fullname = $this->createImgFromStream($path);
    if($fullname)
    {
      $filename = explode('/', $path);
      $file = \array_pop($filename);
      return $this->getResizedImage($width, $height, $fit, $file);
    }
    return $this->server->getImageResponse('/', $this->makeParamsArray($width, $height, $fit));
  }

  /**
   * Génération d'un fichier image à partir un stream
   */
  public function createImgFromStream(String $path)
  {
    $filename = explode('/', $path);
    $fullname = $this->imgPath.'/'.array_pop($filename);
    if(\file_exists($fullname))
    {
      return $fullname;
    }
    try{
      $url = $this->streamUrl.$path;
      $res = $this->client->request('GET', $url);
      if($res->getStatusCode() == 200)
      {
        $content = $res->getContent();
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