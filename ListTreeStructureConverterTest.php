<?php

include "ListTreeStructureConverter.php";

/**
 * Use this class to convert data from Adjacency List to ListTree structure.
 *
 * @author Fernando Hidemi Uchiyama
 */
class ListTreeStructureConverterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ListTreeStructureConverter
     */
    private $converter = null;

    public function setUp()
    {
        $this->converter = new ListTreeStructureConverter();
    }

    public function testConvertMustReturnExpectedResult()
    {
        $id1 = 3456;
        $id2 = 5678;
        $id3 = 6887;
        $id4 = 4456;

        $data = array(
            $id1 => array('name' => 'Barack Obama'),
            $id2 => array('name' => 'Johnny Deep'),
            $id3 => array('name' => 'Shinzo Abe'),
            $id4 => array('name' => 'Valteri Bottas', 'position' => 'F1 Racer'),
        );
        $this->converter->setData($data);

        $hierarchy = array(
            $id1 => array($id2, $id3),
            $id2 => array(),
            $id3 => array($id4),
            $id4 => array(),
        );
        $this->converter->setHierarchy($hierarchy);

        $result = $this->converter->convert($id1);
        $expected = array(
            'data' => array(
                'name' => 'Barack Obama',
            ),
            'children' => array(
                array(
                    'data' => array(
                        'name' => 'Johnny Deep',

                    ),
                    'children' => array(

                    ),
                ),
                array(
                    'data' => array(
                        'name' => 'Shinzo Abe',
                    ),
                    'children' => array(
                        array(
                            'data' => array(
                                'name' => 'Valteri Bottas',
                                'position' => 'F1 Racer',
                            ),
                            'children' => array(
                            ),
                        ),
                    ),
                )
            )
        );

        $this->assertEquals($expected, $result);

    }

    public function testSetHierarchyAndGetHierarchy()
    {
        $id1 = 1;
        $id2 = 2;
        $param = array(
            $id1 => array('caption' => '1'),
            $id2 => array('caption' => '2'),
        );
        $this->converter->setHierarchy($param);
        $result = $this->converter->getHierarchy();
        $this->assertSame($param, $result);
    }

    public function testSetHierarchyMustThrowExceptionIfInvalidParameterIsPassed()
    {
        $this->setExpectedException('InvalidArgumentException');

        $param = new DateTime();
        $this->converter->setHierarchy($param);
    }

    public function testSetDataAndGetData()
    {
        $id1 = 1;
        $id2 = 2;

        $data = array(
            $id1 => array('name' => 'Fulano', 'age' => 10),
            $id2 => array('name' => 'Ciclano', 'age' => 11, 'sex' => 'M'),
        );

        $this->converter->setData($data);
        $result = $this->converter->getData();

        $this->assertSame($data, $result);

        $this->converter->setData(array());
        $result = $this->converter->getData();
        $this->assertCount(0, $result);
    }
}