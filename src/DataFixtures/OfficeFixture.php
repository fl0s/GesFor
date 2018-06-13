<?php

namespace App\DataFixtures;

use App\Entity\Office;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OfficeFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getOfficeData() as [$name, $email, $phone]) {
            $office = new Office();
            $office->setName($name);
            $office->setEmail($email);
            $office->setPhone($phone);

            $manager->persist($office);

            $this->addReference($name, $office);
        }
        $manager->flush();
    }

    private function getOfficeData(): array
    {
        return [
            ['Antenne de Nantes', 'formation.nantes@example.com', '0102030405'],
            ['Antenne de Loire Divate', 'formation.ld@example.com', '0102030405'],
        ];
    }
}
