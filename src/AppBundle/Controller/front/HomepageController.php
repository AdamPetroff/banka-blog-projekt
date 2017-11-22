<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 15. 12. 2016
 * Time: 16:30
 */

namespace AppBundle\Controller\front;


use AppBundle\Entity\Article;
use AppBundle\Service\ArticleManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends Controller
{
    /**
     * @var TwigEngine
     */
    private $twig;
    /**
     * @var ArticleManager
     */
    private $articleManager;

    public function __construct(TwigEngine $twig, ArticleManager $articleManager)
    {
        $this->twig = $twig;
        $this->articleManager = $articleManager;
    }

    /**
     * @return Response
     */
    public function defaultAction()
    {
        $article = new Article();
        $article->setApproved(true);
        $article->setCreatedAt(new \DateTime());
        $article->setDisplay(true);
        $article->setPerex('Adam Mdfijf ASSFdf asfjsdnfj sdnfjsdhfu dgsed hufd usdhfui sdhfu sdfuishdf usfui sdhfu.');
        $article->setText('sdfisuhd gfuihsd fughsudfhg uishfdg iusdfhgu wheifughwsdfhfusdf oisdfhg wufdhgu wdfhg jwdhf uidfgihfgi udfh gihqeruighdf ghidfhgiu sdfhgu dfuig ');
        $article->setMainImgUrl('http://obrazky.4ever.sk/data/download/zvieratka/zajaciky/zajacik,-mrkva-256782.jpg');
        $article->setName('Clnocek');
        $article->setUrl('kokoa');
        return $this->twig->renderResponse('front/homepage/index.html.twig', [
//            'articles' => $this->articleManager->getPresentable()
            'articles' => [$article]
        ]);
    }
}