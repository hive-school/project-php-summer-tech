<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 10.12.14
 * Time: 22:41
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Tests;


abstract class EntityTestCase extends \PHPUnit_Framework_TestCase
{
    protected $object;

    /**
     * @return array
     */
    abstract protected function getFixtureClassData();

    abstract protected function createTestedObject();

    public function setUp(){
        $this->object = $this->createTestedObject();
    }

    public function testSetters()
    {
        $reflection = new \ReflectionClass($this->object);
        $properties = $reflection->getProperties();
        foreach ($properties as $propertyName) {
            $propertyName = $propertyName->name;
            $setter = $this->generateSetterName($propertyName);
            if (method_exists($this->object, $setter)) {
                $this->object->$setter($this->getFixtureClassData()[$propertyName]);
                $property = $reflection->getProperty($propertyName);
                $property->setAccessible(true);
                $property->getValue($this->object);
                $this->assertSame($this->getFixtureClassData()[$propertyName], $property->getValue($this->object), $propertyName);
            }
        }
    }

    public function testGetter()
    {
        $reflection = new \ReflectionClass($this->object);
        $properties = $reflection->getProperties();
        foreach ($properties as $propertyName) {
            $propertyName = $propertyName->name;
            $getter = $this->generateGetterName($propertyName);
            if (method_exists($this->object, $getter)) {
                $property = $reflection->getProperty($propertyName);
                $property->setAccessible(true);
                $property->setValue($this->object, $this->getFixtureClassData()[$propertyName]);
                $this->assertSame($this->getFixtureClassData()[$propertyName], $this->object->$getter(), $propertyName);
            }
        }
    }

    private function generateSetterName($property)
    {
        return 'set' . ucfirst($property);
    }

    private function generateGetterName($property)
    {
        return 'get' . ucfirst($property);
    }
} 