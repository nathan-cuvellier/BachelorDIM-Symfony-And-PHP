<?php


namespace App\Repository;


use App\Entity\Game;
use App\Entity\Player;
use DateTime;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreRepository extends EntityRepository
{

    public function getPopularGamesOfWeek()
    {
        $from = (new DateTime())->modify('-6 days');

        $qb = $this->createQueryBuilder('s');
        $qb->select('g.name, g.id');
        $qb->join('s.game', 'g');
        $qb->groupBy('g.id');
        $qb->orderBy('count(g.name)', 'DESC');


        $qb->where('s.created_at >= :from');
        $qb->setParameter('from', $from);
        $qb->setMaxResults(10);

        return $qb->getQuery()->getResult();
    }

}
