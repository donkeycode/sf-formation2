<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Bien;
use App\Entity\BienModification;
use Doctrine\Common\Inflector\Inflector;

class BienListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Bien) {
            return;
        }

        $entityManager = $args->getEntityManager();

        $bm = new BienModification();
        $bm->setBien($entity);

        $cols = $entityManager->getClassMetadata(Bien::class)->getColumnNames();

        foreach ($cols as $col) {
            if (in_array($col, ['id'])) {
                continue;
            }

            $set = 'set'.Inflector::classify($col);
            $get = 'get'.Inflector::classify($col);

            $bm->$set($entity->$get());
        }

        $entityManager->persist($bm);
    }
}
