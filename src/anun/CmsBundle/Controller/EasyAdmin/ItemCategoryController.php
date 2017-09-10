<?php
/**
 * Created by PhpStorm.
 * User: tsetsee
 * Date: 9/9/17
 * Time: 3:33 AM
 */

namespace anun\CmsBundle\Controller\EasyAdmin;


use Doctrine\ORM\EntityRepository;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use JavierEguiluz\Bundle\EasyAdminBundle\Form\Util\LegacyFormHelper;

class ItemCategoryController extends BaseAdminController
{
    /**
     * @inheritdoc
     */
    protected function createEntityFormBuilder($entity, $view)
    {
        $formOptions = $this->executeDynamicMethod('get<EntityName>EntityFormOptions', array($entity, $view));
        return $this->get('form.factory')->createNamedBuilder(mb_strtolower($this->entity['name']), LegacyFormHelper::getType('easyadmin'), $entity, $formOptions);
    }
}