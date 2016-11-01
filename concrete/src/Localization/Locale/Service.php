<?php
namespace Concrete\Core\Localization\Locale;

use Concrete\Core\Entity\Site\Locale;
use Doctrine\ORM\EntityManagerInterface;

class Service
{

    protected $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getByID($id)
    {
        return $this->entityManager->find('Concrete\Core\Entity\Site\Locale', $id);
    }

    public function setDefaultLocale(Locale $defaultLocale)
    {
        foreach($defaultLocale->getSite()->getLocales() as $locale) {
            $locale->setIsDefault(false);
            $this->entityManager->persist($locale);
        }
        $this->entityManager->flush();

        $defaultLocale->setIsDefault(true);
        $this->entityManager->persist($defaultLocale);
        $this->entityManager->flush();
    }

    public function delete(Locale $locale)
    {
        $tree = $locale->getSiteTree();
        if (is_object($tree)) {
            $locale->setSiteTree(null);
            $this->entityManager->remove($tree);
            $this->entityManager->flush();
        }
        $this->entityManager->remove($locale);
        $this->entityManager->flush();
    }

}