<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackBundle\Entity\Promotion;
use BackBundle\Entity\Candidat;

class PromotionController extends Controller
{

    /**
     * @Route("/promotions", name="promotions")
     */
    public function promotionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $promotions = $em->getRepository('BackBundle:Promotion')->findAll();
        return $this->render('FrontBundle:Default:promotion.html.twig', array(
            'promotions' => $promotions,
        ));
    }

    /**
     * @Route("/promotions/{id}", name="promotion_annee")
     */
    public function promotionAnneeAction(Promotion $promotion)
    {
        $em = $this->getDoctrine()->getManager();
        $candidatsValideAndPromoEnCours = $em ->getRepository('BackBundle:Candidat')->findBy(['decision'=>1, 'promotion'=>$promotion]);

        return $this->render('FrontBundle:Default:promotion_annee.html.twig', [
            'candidats' => $candidatsValideAndPromoEnCours,
            'promotion'=> $promotion,
        ]);
        }
}
