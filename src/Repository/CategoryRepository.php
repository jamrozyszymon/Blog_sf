<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\DBAL\ParameterType;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Category::class);
    }

    public function add(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Find category with at least 1 post.
     */
    public function findCategoryName()
    {
        $qb = $this->createQueryBuilder('c')
            ->join('c.posts', 'p')
            ->getQuery()
            ->execute();

        return $qb;
    }

    // * @param $page pagination
    // * @param string $searchCategory Phrase from searching.
    /**
     * Find category by searching
     */
    // public function findCategory($page, string $searchCategory): PaginationInterface
    // {
    //     $searchCategoryExplode = explode(" ",$searchCategory);

    //     $qb = $this->createQueryBuilder('c');

    //         foreach($searchCategoryExplode as $key => $value) {
    //             $qb->andWhere('c.name LIKE :val'.$key)
    //             ->setParameter('val'.$key, '%'.$value.'%');
    //         }

    //     $qb->orderBy('c.name', 'ASC')
    //         ->getQuery();

    //     $pagination = $this->paginator->paginate($qb, $page, 12);
    //     return $pagination;
    // }

    /**
     * Find category by searching
     */
    public function findBySearch(string $searchCategory)
    {
        $searchCategoryExplode = explode(" ", $searchCategory);
        $conn = $this->getEntityManager()->getConnection();

        foreach ($searchCategoryExplode as $key => $value) {

            $sql = "
                SELECT psub.created, psub.sum_post,
                        u.name user_name,
                        c.id, c.name, c.description
                        FROM
                            (SELECT sub.sum_post, users_id, p.categories_id, created, RANK() OVER(PARTITION BY categories_id ORDER BY created DESC) post_date FROM post p
                            JOIN 
                                (SELECT RANK() OVER(ORDER BY COUNT(categories_id) DESC),categories_id, COUNT(*) sum_post FROM post GROUP BY categories_id) sub
                            ON sub.categories_id=p.categories_id) psub 
                    LEFT JOIN user u 
                    ON psub.users_id=u.id
                    LEFT JOIN category c
                    ON psub.categories_id=c.id
                    WHERE psub.post_date=1 AND c.name LIKE :val";


            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':val', '%' . $value . '%', ParameterType::STRING);
        }

        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }

    public function findAllWithLastPost()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT psub.created, psub.sum_post,
                u.name user_name,
                c.id, c.name, c.description
                FROM
                    (SELECT sub.sum_post, users_id, p.categories_id, created, RANK() OVER(PARTITION BY categories_id ORDER BY created DESC) post_date FROM post p
                    JOIN 
                        (SELECT RANK() OVER(ORDER BY COUNT(categories_id) DESC),categories_id, COUNT(*) sum_post FROM post GROUP BY categories_id) sub
                    ON sub.categories_id=p.categories_id) psub 
            LEFT JOIN user u 
            ON psub.users_id=u.id
            LEFT JOIN category c
            ON psub.categories_id=c.id
            WHERE psub.post_date=1';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
    }


    //    /**
    //     * @return Category[] Returns an array of Category objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Category
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
