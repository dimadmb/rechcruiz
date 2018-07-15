<?php

namespace BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
	 /**
	 * @Template()
     */
    public function indexAction()
    {
		return  $this->pageAction("");
	}

	/**
	 * @Template()
     */
    public function pageAction($url)
    {
		$repository = $this->getDoctrine()->getRepository('BaseBundle:Page');
		$page = $repository->findOneByFullUrl($url);
		if ($page == null) {
			throw $this->createNotFoundException("Страница $url не найдена.");
		}

		$html = $page->getBody();

        $html = htmlspecialchars_decode($html,ENT_QUOTES );
        $html = html_entity_decode($html);

		$template =  $this->container->get('twig')->createTemplate($html);
		$html = $template->render([]);
		
		$page->html = $html;
		
		return ['page' => $page ];
    }
	

	
}
