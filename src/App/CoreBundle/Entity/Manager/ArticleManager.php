<?php

namespace App\CoreBundle\Entity\Manager;

use App\CoreBundle\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleManager
{
    public function __construct(ObjectManager $em) {
        $this->em = $em;
    }

    public function update(Article $article, Article $apiArticle)
    {
        $article->update($apiArticle);

        $this->em->flush();
    }

    public function save(Article $article)
    {
        $this->em->persist($article);
        $this->em->flush();
    }

    public function remove(Article $article)
    {
        $this->em->remove($article);
        $this->em->flush();
    }
}