<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Course
{
    const TYPE_PSC1 = 'psc1';

    const TYPES = [
        self::TYPE_PSC1,
    ];

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $type = self::TYPE_PSC1;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $numberOfStudent = 10;

    /**
     * @var Office|null
     * @ORM\ManyToOne(targetEntity=Office::class)
     * @Assert\NotNull
     */
    private $office;

    /**
     * @var \DateTimeImmutable|null
     * @ORM\Column(type="datetime_immutable")
     * @Assert\NotNull
     */
    private $start;

    /**
     * @var \DateTimeImmutable|null
     * @ORM\Column(type="datetime_immutable")
     * @Assert\NotNull
     */
    private $end;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $addressName = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $addressLine = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $postalCode = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $city = '';

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->start = (new \DateTimeImmutable())->setTime(8, 0);
        $this->end = (new \DateTimeImmutable())->setTime(18, 0);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getNumberOfStudent(): int
    {
        return $this->numberOfStudent;
    }

    public function setNumberOfStudent(int $numberOfStudent): void
    {
        $this->numberOfStudent = $numberOfStudent;
    }

    public function getOffice(): ?Office
    {
        return $this->office;
    }

    public function setOffice(Office $office): void
    {
        $this->office = $office;
    }

    public function getStart(): ?\DateTimeImmutable
    {
        return $this->start;
    }

    public function setStart(\DateTimeImmutable $start): void
    {
        $this->start = $start;
    }

    public function getEnd(): ?\DateTimeImmutable
    {
        return $this->end;
    }

    public function setEnd(\DateTimeImmutable $end): void
    {
        $this->end = $end;
    }

    public function getAddressName(): string
    {
        return $this->addressName;
    }

    public function setAddressName(string $addressName): void
    {
        $this->addressName = $addressName;
    }

    public function getAddressLine(): string
    {
        return $this->addressLine;
    }

    public function setAddressLine(string $addressLine): void
    {
        $this->addressLine = $addressLine;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }
}
