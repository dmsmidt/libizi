<?php

/**
 * @file
 * Contains \Triquanta\IziTravel\Tests\Request\CityChildrenByUuidTest.
 */

namespace Triquanta\IziTravel\Tests\Request;

use Triquanta\IziTravel\DataType\MtgObjectInterface;
use Triquanta\IziTravel\DataType\MultipleFormInterface;
use Triquanta\IziTravel\Request\CityChildrenByUuid;

/**
 * @coversDefaultClass \Triquanta\IziTravel\Request\CityChildrenByUuid
 */
class CityChildrenByUuidTest extends RequestBaseTestBase
{

    /**
     * The class under test.
     *
     * @var \Triquanta\IziTravel\Request\CityChildrenByUuid
     */
    protected $sut;

    public function setUp()
    {
        parent::setUp();

        $this->sut = CityChildrenByUuid::create($this->requestHandler);
    }

    /**
     * @covers ::create
     * @covers ::__construct
     */
    public function test__Construct()
    {
        $this->sut = CityChildrenByUuid::create($this->requestHandler);
    }

    /**
     * @covers ::execute
     * @covers ::setTypes
     */
    public function testExecute()
    {
        $this->requestHandler = $this->getMock('\Triquanta\IziTravel\Client\RequestHandlerInterface');

        $this->sut = CityChildrenByUuid::create($this->requestHandler);

        $languageCodesOptions = ['en', 'nl', 'uk'];
        $languageCodes = [$languageCodesOptions[array_rand($languageCodesOptions)]];
        $limit = mt_rand();
        $offset = mt_rand();
        $formOptions = [MultipleFormInterface::FORM_COMPACT, MultipleFormInterface::FORM_FULL];
        $form = $formOptions[array_rand($formOptions)];
        $typesOptions = [MtgObjectInterface::TYPE_MUSEUM, MtgObjectInterface::TYPE_TOUR, 'city', 'museum'];
        $types = [$typesOptions[array_rand($typesOptions)]];
        $uuidOptions = ['bcf57367-77f6-4e39-9da6-1b481826501f', '3f879f37-21b0-479d-bd74-aa26f72fa328'];
        $uuid = $uuidOptions[array_rand($uuidOptions)];
        $includesOptions = ['city', 'country'];
        $includes = [$includesOptions[array_rand($includesOptions)]];

        $expectedParameters = [
          'languages' => $languageCodes,
          'includes' => $includes,
          'form' => $form,
          'type' => $types,
          'limit' => $limit,
          'offset' => $offset,
        ];

        $this->requestHandler->expects($this->once())
          ->method('request')
          ->with($this->isType('string'), new \PHPUnit_Framework_Constraint_IsEqual($expectedParameters))
          ->willReturn(json_encode([]));

        $this->sut->setLanguageCodes($languageCodes)
          ->setUuid($uuid)
          ->setForm($form)
          ->setLimit($limit)
          ->setOffset($offset)
          ->setTypes($types)
          ->setIncludes($includes)
          ->execute();
    }

    /**
     * @covers ::execute
     *
     * @dataProvider providerTestExecute
     */
    public function testExecuteRealRequest($form, $instanceof)
    {
        $uuid = '3f879f37-21b0-479d-bd74-aa26f72fa328';
        $languageCodes = ['en'];
        $limit = mt_rand(1, 9);

        $mtgObjects = $this->sut->setUuid($uuid)
          ->setLanguageCodes($languageCodes)
          ->setLimit($limit)
          ->setForm($form)
          ->execute();

        $this->assertInternalType('array', $mtgObjects);
        // If the request does not return any data, we cannot test its
        // integrity.
        $this->assertNotEmpty($mtgObjects);
        $this->assertTrue(count($mtgObjects) <= $limit);
        foreach ($mtgObjects as $mtgObject) {
            $this->assertInstanceOf($instanceof, $mtgObject);
        }
    }

    /**
     * Provides data to self::testExecute
     */
    public function providerTestExecute() {
        return [
          [MultipleFormInterface::FORM_FULL, '\Triquanta\IziTravel\DataType\FullMtgObjectInterface'],
          [MultipleFormInterface::FORM_COMPACT, '\Triquanta\IziTravel\DataType\CompactMtgObjectInterface'],
        ];
    }

}
