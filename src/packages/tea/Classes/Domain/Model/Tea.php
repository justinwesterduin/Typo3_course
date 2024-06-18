<?php

declare(strict_types=1);

namespace TTN\Tea\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Tea extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $title;
    protected string $description;
    protected Brand $brand;

    public function getBrand(): Brand
    {
        return $this -> brand;
    }

    public function setBrand(Brand $brand): void
    {
        $this -> brand = $brand;
    }

    public function getTitle(): string
    {
        return $this -> title;
    }

    public function setTitle(string $title): void
    {
        $this -> title = $title;
    }

    public function getDescription(): string
    {
        return $this -> description;
    }

    public function setDescription(string $description): void
    {
        $this -> description = $description;
    }


}
