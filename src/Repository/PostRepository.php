<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use DateTime;


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

    /**
     * Return all posts (with posts of soft delete users)
     * @param Category $id Id of category.
     */
    public function findAllPostById($id)
    {
        $em = $this->getEntityManager();
        $em->getFilters()->disable('softdeleteable');
        $query = $em->createQuery("SELECT p FROM App\Entity\Post p WHERE p.categories= :categories_id");
        $query->setParameter('categories_id', $id);

        return $query->getResult();
    }

}
