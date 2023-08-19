<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\MessageRepository;
use Carbon\Carbon;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ApiResource(
    description: 'Messages sent between people and not only.',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Delete()
    ]
)]
class Message
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id;

    /**
     * A person who sends the message
     */
    #[ORM\Column(length: 255)]
    private ?string $sender = null;

    /**
     * A person who receives the message
     */
    #[ORM\Column(length: 255)]
    private ?string $recipient = null;

    /**
     * Subject of the message
     */
    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    /**
     * Body of the message
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    /**
     * Timestamp of the message. It is automaticaly set when the message is created.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $timestamp = null;

    /**
     * Status of the message where 0 means removed and 1 means visible
     */
    #[ORM\Column]
    private ?int $status = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(string $Sender): static
    {
        $this->sender = $Sender;

        return $this;
    }

    public function getRecipient(): ?string
    {
        return $this->recipient;
    }

    public function setRecipient(string $recipient): static
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Human readable represantation of how long ago the message was created
     */
    public function getDateTimeAgo(): string
    {
        return Carbon::instance($this->timestamp)->diffForHumans();
    }

    #[ORM\PrePersist]
    public function setTimestampValue()
    {
        $this->timestamp = new \DateTimeImmutable();
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }
}
