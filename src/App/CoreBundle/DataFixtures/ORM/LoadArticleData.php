<?php

namespace Smoovio\Bundle\PortalBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\CoreBundle\Entity\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

            for ($i = 1; $i < 30; $i++) {
                $art = new Article('Article ' . $i );
                $art->setLeading('Accroche article'.$i );
                $art->setSlug('article-' . $i );
                $art->setBody('description article ' . $i );
                $art->setCreatedBy('Fake User ' . $i);
                $manager->persist($art);
            }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}