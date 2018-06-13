<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Trainee
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    const GENDERS = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
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
    private $gender = self::GENDER_MALE;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $lastName = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $maidenName = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $firstName = '';

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $birthDate;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $birthPlace = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $birthDepartment = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $adressLine = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $adressPostalCode = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $adressCity = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $phone = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Email
     * @Assert\NotBlank
     */
    private $email = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $work = '';

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $study = '';

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var Course|null
     * @ORM\ManyToOne(targetEntity=Course::class)
     */
    private $course;

    public function __construct(Course $course)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->createdAt = new \DateTimeImmutable();
        $this->course = $course;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getMaidenName(): string
    {
        return $this->maidenName;
    }

    public function setMaidenName(string $maidenName): void
    {
        $this->maidenName = $maidenName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeImmutable $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getBirthPlace(): string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(string $birthPlace): void
    {
        $this->birthPlace = $birthPlace;
    }

    public function getBirthDepartment(): string
    {
        return $this->birthDepartment;
    }

    public function setBirthDepartment(string $birthDepartment): void
    {
        $this->birthDepartment = $birthDepartment;
    }

    public function getAdressLine(): string
    {
        return $this->adressLine;
    }

    public function setAdressLine(string $adressLine): void
    {
        $this->adressLine = $adressLine;
    }

    public function getAdressPostalCode(): string
    {
        return $this->adressPostalCode;
    }

    public function setAdressPostalCode(string $adressPostalCode): void
    {
        $this->adressPostalCode = $adressPostalCode;
    }

    public function getAdressCity(): string
    {
        return $this->adressCity;
    }

    public function setAdressCity(string $adressCity): void
    {
        $this->adressCity = $adressCity;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getWork(): string
    {
        return $this->work;
    }

    public function setWork(string $work): void
    {
        $this->work = $work;
    }

    public function getStudy(): string
    {
        return $this->study;
    }

    public function setStudy(string $study): void
    {
        $this->study = $study;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }
}
