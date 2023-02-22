<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Articles>
 *
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    public function save(Articles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Articles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Articles[] Returns an array of Articles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Articles
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function topTen(){
        try{
            $sql = "SELECT `title`, `story` FROM `articles` ORDER BY publish_date DESC LIMIT 5";

            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

            $query = $stmt->executeQuery();

            $return = $query->fetchAllAssociative();

            return $return;
        }
        catch(Exception $e){
            echo $e;
        }
    }

    public function newsTopics(){
        try{
            $sql = "SELECT `image`, `title`, `story` FROM `articles` WHERE id % 2 != 0 ORDER BY id DESC LIMIT 6";

            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

            $query = $stmt->executeQuery();

            $result = $query->fetchAllAssociative();

            return $result;
        }
        catch(Exception $e){
            echo $e;
        }
    }

    public function findStoryArticles(){
        try{
            $sql = "SELECT `id`, `category`,`title`, `story`, `image`, `author`, `publish_date` FROM `articles`";

            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

            $query = $stmt->executeQuery();

            $response = $query->fetchAllAssociative();

            return $response;
        }
        catch(Exception $e){
            echo $e;
        }
    }


    public function insertArticles($category, $title, $story, $image, $author, $publishDate){
        try{
            $sql = "INSERT INTO `articles` (`category`, `title`, `story`, `image`, `author`, `publish_date`) VALUES (?,?,?,?,?,?)";

            $stmt = $this->getEntityManager()->getConnection()->prepare($sql);

            $stmt->bindValue(1, $category);
            $stmt->bindValue(2, $title);
            $stmt->bindValue(3, $story);
            $stmt->bindValue(4, $image);
            $stmt->bindValue(5, $author);
            $stmt->bindValue(6, $publishDate);
            
            $query = $stmt->executeQuery();

            return true;
        }
        catch(Exception $e){
            echo $e;
        }
    }
}
