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
        try {
            $container = $this->repo->getContainerBySlug($slug, ContainerRepository::CONT_INCLUDE_ITEMS);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e);
        }

        return $container;
    }
}
