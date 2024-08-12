<?php

declare(strict_types=1);

namespace App\User\Entity;

use App\Notification\Entity\Notification;
use App\PurchasePlan\Entity\PurchasePlan;
use App\User\Domain\Role;
use App\User\Domain\Status;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\Column(name: 'user_id', type: "uuid_binary", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    protected UuidInterface $userId;

    /** @var ArrayCollection<int, Notification> */
    #[ORM\OneToMany(targetEntity: Notification::class, mappedBy: 'user')]
    protected Collection $notifications;

    #[ORM\Column(name: 'date_created', type: Types::DATETIME_IMMUTABLE)]
    protected \DateTimeImmutable $date_created;

    public function __construct(
        #[ORM\Column(name: 'user_name', type: Types::STRING, length: 255)]
        protected string $userName,
        #[ORM\Column(name: 'password', type: Types::STRING, length: 255)]
        protected string $password,
        #[ORM\Column(name: 'purchase_plan_id', type: 'uuid_binary')]
        protected UuidInterface $purchasePlanId,
        #[ORM\Column(name: 'role', type: Types::STRING, length: 255)]
        protected string $role = Role::User->value,
        #[ORM\Column(name: 'status', type: Types::STRING, length: 255)]
        protected string $status = Status::Active->value,
    ) {
        $this->date_created = new \DateTimeImmutable('now');
    }

    public function getUserId(): UuidInterface
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): Role
    {
        return Role::tryFrom($this->role);
    }

    public function getStatus(): Status
    {
        return Status::tryFrom($this->status);
    }

    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function getDateCreated(): \DateTimeImmutable
    {
        return $this->date_created;
    }
}
