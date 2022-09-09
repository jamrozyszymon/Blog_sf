<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use DateTime;
use Doctrine\DBAL\Query\QueryBuilder;

class PostRepository extends EntityRepository
{
    public function getByDates(DateTime $startDate, DateTime $endDate)
    {
        $query = $this->createQueryBuilder('p')
        ->addSelect('pl')
        ->leftJoin('p.postLike', 'pl')
        ->where('(p.created > :startDate AND p.created < :endDate)')
        ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
        ->setPArameter('endDate', $endDate->format('Y-m-d H:i:s'))
        ->getQuery();
        return $query->getResult();
    }

    public function findLastPost()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT psub.created, 
        u.name user_name
        FROM
        (SELECT users_id, categories_id, created, RANK() OVER(PARTITION BY categories_id ORDER BY created DESC) post_date FROM post) psub 
        JOIN user u 
        ON psub.users_id=u.id
        WHERE psub.post_date=1';
        

        $stmt = $conn->prepare($sql);
        $resultSet= $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
            
    }



}
