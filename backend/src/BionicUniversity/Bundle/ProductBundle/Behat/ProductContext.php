<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 07.12.14
 * Time: 23:01
 */

namespace BionicUniversity\Bundle\ProductBundle\Behat;


use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use BionicUniversity\Bundle\ProductBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Features\DefaultContext;

class ProductContext extends DefaultContext
{

    /**
     * @param TableNode $table
     *
     * @Given /^There are products:$/
     */
    public function thereAreProducts(TableNode $table)
    {
        $data = $table->getHash();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $table = $em->getClassMetadata('BionicUniversityProductBundle:Product')->getTableName();
        $em->getConnection()
            ->prepare('ALTER TABLE ' . $table . ' AUTO_INCREMENT=1;')
            ->execute();
        foreach ($data as $productData) {
            $product = new Product();

            $product->setId($productData['id'])
                ->setName($productData['name'])
                ->setDescription($productData['name'])
                ->setPrice($productData['price']);
            $em->persist($product);
        }
        $em->flush();
    }
}