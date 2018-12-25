<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/7/29
 * Time: 11:48
 */

namespace AppBundle\Repository;


use AppBundle\Entity\ChMedicine;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class ChMedicineRepository extends EntityRepository
{

    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function findLatest($page = 1)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT m,e
                FROM AppBundle:ChMedicine m
                JOIN m.meEnterprise e
                WHERE m.createTime <= :now
                ORDER BY m.createTime DESC
            ')
            ->setParameter('now', new \DateTime())
        ;

        return $this->createPaginator($query, $page);
    }

    private function createPaginator(Query $query, $page)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(ChMedicine::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }



    /**
     * @param string $rawQuery The search query as input by the user
     * @param string $searchType The search type as select by the user
     * @param int    $limit    The maximum number of results returned
     *
     * @return array
     */
    public function findBySearchQuery($rawQuery,$searchType, $limit = 30)//ChMedicine::NUM_ITEMS)
    {
        $query = $this->sanitizeSearchQuery($rawQuery);
        $searchTerms = $this->extractSearchTerms($query);


        if (0 === count($searchTerms)) {
            return [];
        }
        //$em= $this->getEntityManager();
        $queryBuilder = $this->createQueryBuilder('c');
        //$queryBuilder = $em->createQueryBuilder();
        switch($searchType)
        {
            case 0:
                foreach ($searchTerms as $key => $term) {
                $queryBuilder
                    //->leftJoin('AppBundle\Entity\MeEnterprise e')
                    ->leftJoin('c.meEnterprise','e')
                    ->orWhere('e.name LIKE :t_'.$key)
                    ->setParameter('t_'.$key, '%'.$term.'%');
                }
                break;
            case 1:
                foreach ($searchTerms as $key => $term) {
                $queryBuilder
                    ->orWhere('c.breed LIKE :t_'.$key)
                    ->setParameter('t_'.$key, '%'.$term.'%');
                }
                break;
            case 2:
                foreach ($searchTerms as $key => $term) {
                    $queryBuilder
                        ->leftJoin('c.linkChMedicineChMaterials','l')
                        ->leftJoin('l.chMaterials','m')
                        ->orWhere('m.name LIKE :t_'.$key)
                        ->setParameter('t_'.$key, '%'.$term.'%');
                }
                break;
        }
        return $queryBuilder
            ->orderBy('c.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


    /**
     * Removes all non-alphanumeric characters except whitespaces.
     *
     * @param string $query
     *
     * @return string
     */
    private function sanitizeSearchQuery($query)
    {
        return $query;
        //return preg_replace('/[^[:alnum:] ]/', '', trim(preg_replace('/[[:space:]]+/', ' ', $query)));
    }


    /**
     * Splits the search query into terms and removes the ones which are irrelevant.
     *
     * @param string $searchQuery
     *
     * @return array
     */
    private function extractSearchTerms($searchQuery)
    {
        $terms = array_unique(explode(' ', mb_strtolower($searchQuery)));
        /*return $terms;*/
        return array_filter($terms, function ($term) {
            return 1 <= mb_strlen($term);
        });
    }
}