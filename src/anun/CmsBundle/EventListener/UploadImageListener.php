<?php
/**
 * Created by PhpStorm.
 * User: tsetsee
 * Date: 9/11/17
 * Time: 4:25 AM
 */

namespace anun\CmsBundle\EventListener;


use anun\CmsBundle\Entity\ItemGallery;
use Vich\UploaderBundle\Event\Event;

class UploadImageListener
{
    public function onVichUploaderPostUpload(Event $event) {
        /**@var ItemGallery $object*/
        $object = $event->getObject();

        if($object instanceof ItemGallery) {
            $mapping = $event->getMapping();

            $size = getimagesize($mapping->getUploadDestination() . '/' . $mapping->getFileName($object));
            if ($size !== false) {
                $object
                    ->setWidth($size[0])
                    ->setHeight($size[1]);
            }
        }
    }
}