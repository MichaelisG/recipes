<?php

namespace App\Tests\App\Tests\Unit;

use App\Service\FooService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AlphaTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());
    }

    public function testContainer(): void
    {
        $params = static::getContainer()->get('parameter_bag');
        
        $title = $params->get('app.title');
        $this->assertEquals($title, 'Titre de mon application');

        $desc = $params->get('app.description');
        $this->assertEquals($desc, 'Description de mon application');
    }

    public function testFooService(): void
    {
        $params = static::getContainer()->get('parameter_bag');
        $fooService = new FooService($params);

        $this->assertStringContainsString('Titre', $fooService->getKey());
    }

    public function testFooServiceSetParameter(): void
    {
        $params = static::getContainer()->get('parameter_bag');
        $fooService = new FooService($params);

        /** testing regular comma separated values */
        $parameters = 'A,B,C,D';
        $array = $fooService->setParameter($parameters);
        $this->assertIsArray($array);
        $this->assertEquals(4, count($array));

        /** testing the empty string, expects an empty array */
        $parameters = '';
        $array = $fooService->setParameter($parameters);
        $this->assertIsArray($array);
        $this->assertEquals(0, count($array));
    }
}
