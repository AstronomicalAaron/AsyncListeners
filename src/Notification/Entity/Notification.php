<?php

declare(strict_types=1);

namespace App\Notification\Entity;

use App\User\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'notification')]
class Notification
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid_binary", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    protected UuidInterface $notificationId;

    #[ORM\Column(name: 'date_created', type: Types::DATETIME_IMMUTABLE)]
    protected \DateTimeImmutable $date_created;

    public function __construct(
        #[ORM\Column(name: 'user_id', type: 'uuid')]
        #[ORM\Id, ORM\ManyToOne(targetEntity: User::class)]
        protected User $user,
        #[ORM\Column(name: 'name', type: Types::STRING, length: 255)]
        protected string $notification,
    ) {
    }

    public function getNotificationId(): UuidInterface
    {
        return $this->notificationId;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getNotification(): string
    {
        return $this->notification;
    }

    public function getDateCreated(): \DateTimeImmutable
    {
        return $this->date_created;
    }
}
