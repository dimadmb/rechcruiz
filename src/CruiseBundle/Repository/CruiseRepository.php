<?php

namespace CruiseBundle\Repository;

/**
 * CruiseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CruiseRepository extends \Doctrine\ORM\EntityRepository
{

	public function getPrices($id) {
		$str = "SELECT c, s, pr, cab, room,   type, deck, place, tariff
			FROM CruiseBundle:Cruise c 
			JOIN c.ship s
			LEFT JOIN s.cabin cab
			LEFT JOIN cab.prices pr
			LEFT JOIN cab.rooms room
			LEFT JOIN pr.place place
			LEFT JOIN pr.tariff tariff
			LEFT JOIN cab.type type
			LEFT JOIN cab.deck deck
			WHERE c.id = ?1
			AND pr.cruise = c.id
			

			
			ORDER BY deck.id , room.number*1 , tariff.id , pr.price";
   		$q = $this->_em->createQuery($str);
   		$q->setParameter(1, $id);
   		return $q->getOneOrNullResult();
	}
	
	public function getProgramCruise($id)
	{
		$str = "SELECT c, pi, pl 
			FROM CruiseBundle:Cruise c 
			LEFT JOIN c.programs pi
			LEFT JOIN pi.place pl
			WHERE c.id = ?1
			ORDER BY  pi.dateStart";
   		$q = $this->_em->createQuery($str);
   		$q->setParameter(1, $id);
   		return $q->getOneOrNullResult();
	}

	public function findMinStartDate()
	{
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM CruiseBundle:Cruise c ORDER BY c.startDate ASC ')->setMaxResults(1)
            ->getOneOrNullResult();		
	}		
	public function findMaxStartDate()
	{
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM CruiseBundle:Cruise c ORDER BY c.endDate DESC ')->setMaxResults(1)
            ->getOneOrNullResult();		
	}
	
	public function findMinDays()
	{
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM CruiseBundle:Cruise c ORDER BY c.dayCount ASC ')->setMaxResults(1)
            ->getOneOrNullResult();		
	}		
	public function findMaxDays()
	{
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM CruiseBundle:Cruise c ORDER BY c.dayCount DESC ')->setMaxResults(1)
            ->getOneOrNullResult();		
	}		
}