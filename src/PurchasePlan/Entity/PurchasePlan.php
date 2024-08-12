<?php

declare(strict_types=1);

namespace App\PurchasePlan\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'purchase_plan')]
class PurchasePlan
{
    #[ORM\Id]
    #[ORM\Column(name: 'purchase_plan_id', type: "uuid_binary", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    protected UuidInterface $purchasePlanId;

    public function __construct(
        #[ORM\Column(name: 'name', type: Types::STRING, length: 255)]
        protected string $name,
        #[ORM\Column(name: 'price', type: Types::INTEGER)]
        protected int $price,
    ) {
    }

    public function getPurchasePlanId(): UuidInterface
    {
        return $this->purchasePlanId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
