<?php

namespace App\Controller;

use \App\Service\ImageService;
use Symfony\Component\HttpFoundation\Response;
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
    public function image(int $width, int $height, string $path)
    {
        return $this->imageService->getResizedImage(intval($width), intval($height), 'fit', $path);
    }

    /**
     * @Route("/images/stream/{width}/{height}/{path}", methods={"GET"})
     */
    public function imageStream(string $path)
    {
        $width = $height = 340;
        return $this->imageService->getResizedStream(intval($width), intval($height), 'fit', '/character/avatar/'.$path);
    }
}
