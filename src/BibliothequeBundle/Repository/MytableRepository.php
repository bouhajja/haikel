<?php

namespace BibliothequeBundle\Repository;

/**
 * AvisRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MytableRepository extends \Doctrine\ORM\EntityRepository
{

    public function support()
    {
        $qb = $this->createQueryBuilder('c')->select('c.support as support')->distinct('c.support');

        return $qb->getQuery()->getResult();
    }

    public function code_face()
    {
        $qb = $this->createQueryBuilder('c')->select('c.codeFace as codeFace')->distinct('c.codeFace')->orderBy('c.codeFace','asc');
        return $qb->getQuery()->getResult();
    }

    public function emplacement()
    {
        $qb = $this->createQueryBuilder('c')->select('c.emplacement as emplacement')->distinct('c.emplacement')->orderBy('c.emplacement','asc');
        return $qb->getQuery()->getResult();
    }

    public function regie()
    {
        $qb = $this->createQueryBuilder('c')->select('c.regie as regie')->distinct('c.regie')->orderBy('c.regie','asc');
        return $qb->getQuery()->getResult();
    }

    public function search($request)
    {



        $qb = $this->createQueryBuilder('c');
        if($request->get('code')!='')
        {
            $qb->where('c.codeFace IN (:code)')->setParameter('code',$request->get('code'));
        }

        if($request->get('emplacement')!='')
        {
            $qb->andWhere('c.emplacement IN (:emplacement)')->setParameter('emplacement',$request->get('emplacement'));
        }

        if($request->get('region')!='')
        {
            $qb->andWhere('c.regie IN (:region)')->setParameter('region',$request->get('region'));
        }

        if($request->get('support')!='')
        {
            $qb->andWhere('c.support IN (:support)')->setParameter('support',$request->get('support'));
        }




            $qb->orderBy('c.idface','desc');

        return $qb->getQuery()->getResult();



    }
}
