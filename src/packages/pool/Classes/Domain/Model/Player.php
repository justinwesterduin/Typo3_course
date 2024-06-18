<?php
declare(strict_types=1);

namespace MaxServ\Pool\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Player extends AbstractEntity
{
    public function __construct(
        protected ?string $name = '',
        protected ?string $email = ''
    )
    {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
}