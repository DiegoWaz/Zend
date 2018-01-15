<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;

final class MeetupRepository extends EntityRepository
{

    public function add($meetup) : void
    {
        $this->getEntityManager()->persist($meetup);
        $this->getEntityManager()->flush($meetup);
    }

    public function createMeetup(string $name, string $description, string $organisateur, string $entreprise, string $startDate, string $endDate, int $participant)
    {
        return new Meetup($name, $description, $organisateur, $entreprise, $startDate, $endDate, $participant);
    }

    public function delete(string $id): void
    {
        $this->getEntityManager()->remove($this->find($id));
        $this->getEntityManager()->flush();
    }
}
