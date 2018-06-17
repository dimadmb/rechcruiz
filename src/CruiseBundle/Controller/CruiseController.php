<?php

namespace CruiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query\ResultSetMapping;



class CruiseController extends Controller
{




    /**
	 * @Template()	
     * @Route("/cruise", name="cruise")
     */
    public function indexAction(Request $request)
    {
		$cruises = $this->searchCruise();
		return ["months"=>$this->month($cruises)];
    }

    
	/**
	 * @Template("CruiseBundle:Cruise:cruises.html.twig")	
	 */
	public function searchInAction($search = [])
	{
		//dump($search);
		$cruises = $this->searchCruise($search);
		return ["months"=>$this->month($cruises)];
	}    
	
	
	/**
	 * @Template("CruiseBundle:Cruise:cruises.html.twig")	
	 */
	public function placeStartAction($place)
	{
		
		$cruises = $this->searchCruise(['placeStart'=>$place]);
		return ["months"=>$this->month($cruises)];
		
		return new Response("OK");
	}
	
	/**
	 * @Template("CruiseBundle:Cruise:index.html.twig")	
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
		$cruises = $this->searchCruise($request->query->all());
		//return ["cruises"=>$cruises];
		return ["months"=>$this->month($cruises)];
    }	
	

	public function shipAction($ship)
	{
		$cruises = $this->searchCruise(["ship"=>$ship]);
		//return ["cruises"=>$cruises];
        return $this->render('CruiseBundle:Cruise:cruises.html.twig', ["months"=>$this->month($cruises)]);				
	}
	
	
	/// группировка по месяцам
	public function month($cruises)
	{
		$month = "";
		$months = [];
		foreach($cruises as $cruise)
		{
			if(date("Y-m",$cruise->getStartDate()->getTimestamp()) != $month)
			{
				$month = date("Y-m",$cruise->getStartDate()->getTimestamp()); 
			}
			$months[$month][] = $cruise;
		}
		
		return $months;
	}

    /**
	 * @Template()	
     * @Route("/cruise/{id}", name="cruisedetail",        
	 *     requirements={
     *         "id": "\d+"
     *     })
     */
	public function cruiseDetailAction($id)
	{
		$cruiseRepository = $this->getDoctrine()->getRepository("CruiseBundle:Cruise");
		

		$cruise = $cruiseProgram = $cruiseRepository->getProgramCruise($id);
		if($cruise == null)
		{
			throw $this->createNotFoundException("Страница не найдена.");
		}			
		$cruiseShipPrice = $cruiseRepository->getPrices($id);


		$tariff_arr = array();
		$cabins = array();
		
		if($cruiseShipPrice != null)
		{
			
			
			$cabinsAll = $cruiseShipPrice->getShip()->getCabin();
			foreach($cabinsAll as $cabinsItem)
			{
				
				$rooms_in_cabin = array();
				foreach($cabinsItem->getRooms() as $room)
				{
					/*if(in_array($room->getNumber(),$active_rooms))
					{*/
						$rooms_in_cabin[] = $room->getNumber();
					/*}*/
				}

				foreach($cabinsItem->getPrices() as $prices)
				{

					$tariff_arr[$prices->getTariff()->getname()]=1;
					
					$price[$prices->getPlace()->getRpName()]['prices'][$prices->getTariff()->getname()][$prices->getMeals()->getName()] = $prices;
					//$price[$prices->getRpId()->getRpName()]['rooms'] = $rooms_in_cabin;//список кают
					// сюда добавить свободные каюты
					//$rooms => 
					
				}
				$cabins[$cabinsItem->getDeck()->getName()][] = array(
					'cabinName' =>$cabinsItem->getType()->getComment(),
					'cabin' => $cabinsItem,
					'rpPrices' => $price,
					'rooms' => $rooms_in_cabin
					// тут можно посчитать количество rowspan
					)
					;
				unset($price);	
			}	
		}
		else
		{
			return ['cruise' => $cruise, 'cabins' => null,'tariff_arr'=>null ];
		}		
		
		
		return [ 'cruise' => $cruise, 'cabins' => $cabins,'tariff_arr'=>$tariff_arr ];
	}



	public function searchCruise($parameters = array())
	{
		//dump($parameters);
		$em = $this->getDoctrine()->getManager();
		$rsm = new ResultSetMapping;
		$rsm->addEntityResult('CruiseBundle:Cruise', 'c');
		$rsm->addFieldResult('c', 'c_id', 'id');
		$rsm->addMetaResult('c', 'c_ship', 'ship');
		$rsm->addFieldResult('c', 'c_startdate', 'startDate');
		$rsm->addFieldResult('c', 'c_enddate', 'endDate');
		$rsm->addFieldResult('c', 'c_daycount', 'dayCount');
		$rsm->addFieldResult('c', 'c_name', 'name');
		$rsm->addMetaResult('c', 'c_code', 'code');
		$rsm->addJoinedEntityResult('CruiseBundle:Ship', 's','c', 'ship');
		$rsm->addFieldResult('s', 's_id', 'id');
		$rsm->addFieldResult('s', 's_name', 'name');
		$rsm->addFieldResult('s', 's_code', 'code');
		$rsm->addFieldResult('s', 's_m_id', 'shipId');
		$rsm->addJoinedEntityResult('CruiseBundle:Price', 'p','c', 'prices');
		$rsm->addFieldResult('p', 'p_id', 'id');
		$rsm->addFieldResult('p', 'p_price', 'price');




		$where = "";
		$join = "";
		
		
		// даты unix окончание - последняя дата начала // для моиска по месяцам
		if(isset($parameters['startdate']))
		{
			$where .= "
			AND c.startdate >= ".$parameters['startdate'];
		}		
		if(isset($parameters['enddate']))
		{
			$where .= "
			AND c.startdate <= ".$parameters['enddate'];
		}	

		// даты человеческие
		if(isset($parameters['startDate']))
		{
			$where .= "
			AND c.startDate >= '".($parameters['startDate'])."'";
		}		
		if(isset($parameters['endDate']))
		{
			$where .= "
			AND c.endDate <= '".($parameters['endDate'])."'";
		}
		if(isset($parameters['ship']) && ($parameters['ship'] > 0) )
		{
			$where .= "
			AND s.shipId = ".$parameters['ship'];
		}
		
		/*
		if(isset($parameters['specialoffer']) && isset($parameters['burningCruise']))
		{
			$where .= "
			AND ((code.specialOffer = 1) OR (code.burningCruise = 1)) ";	
		}
		else
		{
			if(isset($parameters['specialoffer']))
			{
				$where .= "
				AND code.specialOffer = 1";			
			}
			if(isset($parameters['burningCruise']))
			{
				$where .= "
				AND code.burningCruise = 1";			
			}		
		}
		*/
		if(isset($parameters['places']))
		{
			$join .= "
			LEFT JOIN program_item pi ON pi.cruise_id = c.id
			LEFT JOIN place cp ON pi.place_id = cp.id
			";
			$where .= "
			AND cp.id IN (".implode(',',$parameters['places']).")";	
			
		}
		
		if(isset($parameters['weekend']))
		{
			$join .= "
			LEFT JOIN cruise_category ON cruise_category.cruise_id = c.id 
			";
			$where .= "AND cruise_category.category_id = 11";
		}
		
		if(isset($parameters['likeName']))
		{

			$where .= "AND c.name LIKE '%".$parameters['likeName']."%'";
		}

		
		
		if(isset($parameters['days']))
		{
			list($mindays,$maxdays) = explode(',',$parameters['days']);
			$where .= "
			AND c.daycount >=".$mindays;
			$where .= "
			AND c.daycount <=".$maxdays;			
		}	

		if(isset($parameters['placeStart']) && ($parameters['placeStart'] != "all" ) )
		{
			$where .= "
			AND c.name LIKE '".$parameters['placeStart']."%'";
		}
		
		
		if(isset($parameters['placeStop']) && ($parameters['placeStop'] != "all" ) )
		{
			$where .= "
			AND c.name LIKE '%".$parameters['placeStop']."'";
		}
		
		$sql = "
		SELECT 
			c.id c_id , c.ship_id c_ship, c.startDate c_startdate, c.endDate c_enddate, c.dayCount c_daycount,  c.name c_name
			,
			s.id s_id, s.name s_name, s.code s_code, s.shipId s_m_id 
			,
			p.id p_id, p.price p_price

		FROM cruise c
		".$join."
		LEFT JOIN ship s ON c.ship_id = s.id
		LEFT JOIN 
		
			(
				SELECT p2.id , MIN(p2.price) price, p2.cruise_id
				FROM (SELECT * FROM price ORDER BY price) p2
				LEFT JOIN tariff ON tariff.id = p2.tariff_id
				WHERE tariff.name LIKE '%взрослый%'
				GROUP BY p2.cruise_id
			) p ON c.id = p.cruise_id
		
		
		
		WHERE c.endDate >= CURRENT_DATE()
		AND c.active = 1
		"
		.$where.
		"
		ORDER BY c.startDate
		";
		
		$query = $em->createNativeQuery($sql, $rsm);
		
		
		//$query->setParameter(1, 'romanb');
		
		$result = $query->getResult();
		return $result;
	}



	
}


