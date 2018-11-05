<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/10/8
 * Time: 22:01
 */

namespace AppBundle\Repository;


use AppBundle\Entity\ChMaterials;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class ChMaterialsRepository extends EntityRepository
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
                SELECT m
                FROM AppBundle:ChMaterials m
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
        $paginator->setMaxPerPage(ChMaterials::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }



    /**
     * @param string $rawQuery The search query as input by the user
     * @param int    $limit    The maximum number of results returned
     *
     * @return array
     */
    public function findBySearchQuery($rawQuery, $limit = ChMaterials::NUM_ITEMS)
    {
        $query = $this->sanitizeSearchQuery($rawQuery);
        $searchTerms = $this->extractSearchTerms($query);


        if (0 === count($searchTerms)) {
            return [];
        }

        $queryBuilder = $this->createQueryBuilder('c');

        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('c.breed LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%')
            ;
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
            return 2 <= mb_strlen($term);
        });
    }
}