<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/7/29
 * Time: 11:48
 */

namespace AppBundle\Repository;


use AppBundle\Entity\ChMedicine;
use Doctrine\ORM\EntityRepository;

class ChMedicineRepository extends EntityRepository
{
    /**
     * Removes all non-alphanumeric characters except whitespaces.
     *
     * @param string $query
     *
     * @return string
     */
    private function sanitizeSearchQuery($query)
    {
        return preg_replace('/[^[:alnum:] ]/', '', trim(preg_replace('/[[:space:]]+/', ' ', $query)));
    }




    /**
     * @param string $rawQuery The search query as input by the user
     * @param int    $limit    The maximum number of results returned
     *
     * @return array
     */
    public function findBySearchQuery($rawQuery, $limit = ChMedicine::NUM_ITEMS)
    {
        $query = $this->sanitizeSearchQuery($rawQuery);
        $searchTerms = $this->extractSearchTerms($query);


        if (0 === count($searchTerms)) {
            return [];
        }

        $queryBuilder = $this->createQueryBuilder('ch');

        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('ch.breed LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%')
            ;
        }

        return $queryBuilder
            ->orderBy('ch.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
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

        return array_filter($terms, function ($term) {
            return 2 <= mb_strlen($term);
        });
    }
}