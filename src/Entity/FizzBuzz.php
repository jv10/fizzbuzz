<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\FizzBuzzRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FizzBuzzRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class FizzBuzz
{
    #[ORM\Id]
    #[ORM\Column(length: 6)]
    private ?string $id = null;

    #[ORM\Column]
    private ?int $ini = null;

    #[ORM\Column]
    private ?int $end = null;

    #[ORM\Column]
    private ?string $value = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $createAt = null;

    public static function create(int $ini, int $end): self
    {
        if ($ini > $end) {
            throw new \InvalidArgumentException();
        }

        return (new self())
            ->setId(self::calculeIdentifier($ini, $end))
            ->setIni($ini)
            ->setEnd($end)
            ->setValue(self::calculeFizzBuzz($ini, $end));
    }

    public function getId(): string
    {
        return $this->id;
    }

    private function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIni(): int
    {
        return $this->ini;
    }

    private function setIni(int $ini): self
    {
        $this->ini = $ini;

        return $this;
    }

    public function getEnd(): int
    {
        return $this->end;
    }

    private function setEnd(int $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    private function setCreateAt(\DateTime $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->setCreateAt(new \DateTime());
    }

    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    public function __toString()
    {
        return $this->getValue();
    }

    public static function calculeIdentifier(int $ini, int $end): string
    {
        return sprintf('%s::%s', $ini, $end);
    }

    private static function calculeFizzBuzz(int $ini, int $end)
    {
        $output = '';

        for ($i = $ini; $i <= $end; $i++) {
            if ($i % 3 === 0 && $i % 5 === 0) {
                $output .= 'FizzBuzz';
            } elseif ($i % 3 === 0) {
                $output .= 'Fizz';
            } elseif ($i % 5 === 0) {
                $output .= 'Buzz';
            } else {
                $output .= $i;
            }
            if ($i < $end) {
                $output .= ', ';
            }
        }

        return $output;
    }
}
