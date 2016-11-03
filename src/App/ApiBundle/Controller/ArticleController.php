<?php

namespace App\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation as Doc;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use App\CoreBundle\Entity\Article;

/**
 *  @Route("/articles") 
 */
class ArticleController extends FOSRestController
{

    /**
     * @Rest\Get(
     *    path = "/{id}",
     *    name="app_api_article",
     *    requirements={"id"="\d+"}
     * )
     *
     * @Doc\ApiDoc(
     *     section="Articles",
     *     resource=true,
     *     description="Get one article.",
     *     requirements={
     *          {
     *              "name"="id",
     *              "dataType"="integer",
     *              "requirement"="\d+",
     *              "description"="The article unique identifier."
     *          }
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *      }
     * )
     */
    public function getArticleAction(Article $article)
    {

        return $article;
    }

    /**
     * @Rest\Post("/", name="app_api_new_article")
     *
     * @ParamConverter("article", converter="fos_rest.request_body")
     *
     * @Rest\View(statusCode=201)
     *
     * @Doc\ApiDoc(
     *      section="Articles",
     *      description="Creates a new article.",
     *      statusCodes={
     *          201="Returned if article has been successfully created",
     *          400="Returned if errors",
     *          500="Returned if server error"
     *      }
     * )
     */
    public function postArticleAction(Article $article, ConstraintViolationListInterface $violations)
    {
        if (count($violations)) {
            return $this->view($violations, 400);
        }

        $this->get('app_core.article_manager')->save($article);

        return $this->view(null, 201,
                [
                'Location' => $this->generateUrl('app_api_article', [ 'id' => $article->getId()]),
        ]);
    }
    
    /**
     * @Rest\Delete(
     *     path = "/{id}",
     *     name = "app_api_delete_article",
     *     requirements = {"id"="\d+"}
     * )
     * 
     * @Rest\View(statusCode=204)
     *
     * @Doc\ApiDoc(
     *      section="Articles",
     *      description="Delete an existing article.",
     *      statusCodes={
     *          201="Returned if article has been successfully deleted",
     *          400="Returned if article does not exist",
     *          500="Returned if server error"
     *      },
     *      requirements={
     *          {
     *              "name"="id",
     *              "dataType"="integer",
     *              "requirement"="\d+",
     *              "description"="The article unique identifier."
     *          }
     *      },
     * )
     */
    public function deleteArticleAction(Article $article)
    {
        $this->get('app_core.article_manager')->remove($article);

        return $this->view('', Response::HTTP_NO_CONTENT);
    }
}