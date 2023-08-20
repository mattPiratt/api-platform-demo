<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Metadata\ApiFilter;
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
use Symfony\Component\Validator\Constraints as Assert;

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
    ],
    paginationItemsPerPage: 8
)]
#[ApiFilter(NumericFilter::class, properties: ['status'])]
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
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: "Field must be at least 3 characters long",
        maxMessage: "Field must be maximum 100 characters long",
    )]
    private ?string $sender = null;

    /**
     * A person who receives the message
     */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: "Field must be at least 3 characters long",
        maxMessage: "Field must be maximum 100 characters long",
    )]
    private ?string $recipient = null;

    /**
     * Subject of the message
     */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 200,
        minMessage: "Field must be at least 3 characters long",
        maxMessage: "Field must be maximum 200 characters long",
    )]
    private ?string $subject = null;

    /**
     * Body of the message
     */
    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
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
    #[Assert\Choice(
        choices: [0, 1],
        message: "The value must be either 0 or 1"
    )]
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
