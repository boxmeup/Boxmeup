<?php

namespace Boxmeup\Web\Converter;

use Boxmeup\Repository\ContainerRepository;
use Boxmeup\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContainerConverter
{
    protected $repo;

    public function __construct(ContainerRepository $repo)
    {
        $this->repo = $repo;
    }

    public function convert($slug)
    {
        return $this->getContainer($slug);
    }

    public function convertItems($slug)
    {
        return $this->getContainer($slug, ContainerRepository::CONT_INCLUDE_ITEMS);
    }

    protected function getContainer($slug, $options = 0)
    {
        try {
            $container = $this->repo->getContainerBySlug($slug, $options);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e);
        }

        return $container;
    }
}
