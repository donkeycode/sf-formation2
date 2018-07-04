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
        $bm->setProprietaire($entity->getProprietaire());

        $copy = function($cols, $excludes) use ($bm, $entity) {
            foreach ($cols as $col) {
                if (in_array($col, $excludes)) {
                    continue;
                }

                $set = 'set'.Inflector::classify($col);
                $get = 'get'.Inflector::classify($col);

                $bm->$set($entity->$get());
            }
        };

        $copy($entityManager->getClassMetadata(Bien::class)->getAssociationNames(), ['leads']);
        $copy($entityManager->getClassMetadata(Bien::class)->getColumnNames(), ['id']);

        $entityManager->persist($bm);
    }
}
