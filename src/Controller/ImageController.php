<?php

namespace App\Controller;

use \App\Service\ImageService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImageController extends AbstractController
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @Route("/images/{width}/{height}/{path}", methods={"GET"})
     */
    public function show(int $width, int $height, string $path)
    {
        return $this->imageService->getResizedImage(intval($width), intval($height), 'fit', $path);
    }

    /**
     * @Route("/images/test", methods={"GET"})
     */
    public function test()
    {
        return $this->imageService->getResizedStream(200,200, 'fit', 'https://rickandmortyapi.com/api/character/avatar/3.jpeg');
    }
}
