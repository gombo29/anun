<?php
/**
 * Created by PhpStorm.
 * User: tsetsee
 * Date: 9/11/17
 * Time: 5:06 AM
 */

namespace anun\CmsBundle\EventListener;


use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\PropertyAccess\PropertyAccess;

class OrderIndexer
{
    private $annotationReader;

    public function __construct(AnnotationReader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $object = $args->getObject();

        $objectManager = $args->getObjectManager();

        $reflClass = new \ReflectionClass($object);

        $orderIndexerAnnotation = $this->annotationReader->getClassAnnotation($reflClass, 'tsetsee\\Annotation\\OrderIndexer');

        if($orderIndexerAnnotation) {
            $reflObject = new \ReflectionObject($object);

            foreach($reflObject->getProperties() as $property) {
                $orderIndexerPropertyAnnotation = $this->annotationReader->getPropertyAnnotation($property, 'tsetsee\\Annotation\\OrderIndexerProperty');

                if($orderIndexerPropertyAnnotation) {
                    $accessor = PropertyAccess::createPropertyAccessor();

                    if(is_null($accessor->getValue($object, $property->getName()))) {
                        /**@var QueryBuilder $qb */
                        $qb = $objectManager->getRepository($objectManager->getClassMetadata(get_class($object))->getName())->createQueryBuilder('e');

                        $maxIndex = $qb->select('MAX(e.' . $property->getName() . ')')
                            ->getQuery()
                            ->getSingleScalarResult();

                        $accessor->setValue($object, $property->getName(), $maxIndex + 1);
                    }
                }
            }
        }
    }
}