<?php

namespace App\Repository;

use App\Entity\Partie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Partie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partie[]    findAll()
 * @method Partie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Partie::class);
    }

    /**
     * @return Partie[] Returns an array of Partie objects
     */
    public function findAlivePerso($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT partie.id,nom,score,life,image FROM partie,avatar WHERE compte_id = :compte AND over = 0 AND avatar.id = partie.avatar_id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['compte' => $id]);
        return $stmt->fetchAll();
    }


    /**
     * @return []
     */
    public function findPersoById($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT partie.id,nom,score,life,image,over FROM partie,avatar WHERE partie.id = :partie AND partie.avatar_id = avatar.id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['partie'=>(int)$id]);
        return $stmt->fetch();
    }

    /**
     * @return string
     */
    public function findCompteByPersoId($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT compte.id,compte.pseudo FROM compte,partie WHERE partie.compte_id = compte.id AND partie.id = :partie';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['partie'=>(int)$id]);
        return $stmt->fetch();
    }

    public function changeLifeScorePerso($id, $life, $score){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'UPDATE partie SET life = :life, score = :score WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['life'=>$life,'score'=>$score,'id'=>$id]);
    }

    public function diePerso($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'UPDATE partie SET over = 1 WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
    }

    public function getHighScore($nb){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT
            score,nom,life,compte.pseudo
            FROM partie,compte WHERE
            partie.compte_id = compte.id
            ORDER BY score DESC';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $collecter = array();
        $t = 0;
        while($t++ < $nb && array_push($collecter, $stmt->fetch())){
        }
        return $collecter;
    }
}
