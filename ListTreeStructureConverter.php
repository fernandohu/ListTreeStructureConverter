<?php

/**
 * Use this class to convert data from Adjacency List to FileTree structure.
 *
 * @author Fernando Hidemi Uchiyama
 */
class ListTreeStructureConverter
{

    /**
     * @var array[]
     */
    private $data = array();

    /**
     * @var array[]
     */
    private $hierarchy = array();

    /**
     * Sets the data to be arranged as a tree.
     *
     * The $data parameter is an array of array.
     *
     * Each element of the main array represents a single record. Each element of the array inside represents an
     * attribute. Records can vary on the number of attributes. The index of the main array is the ID of the record.
     *
     * For example:
     *
     * array(
     *     1 => array('name' => 'Fulano', 'age' => 10),
     *     2 => array('name' => 'Ciclano', 'age' => 11, 'sex' => 'M'),
     * )
     *
     * In the example above we have two records. The first record has two attributes and the second has three
     * attributes. The 1 and 2 are the IDs of the respective record.
     *
     * @param array Array of records
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array[]
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the hierarchy data. Only the IDs of the records are required.
     *
     * The $hierarchy parameter is an array of array.
     *
     * Each element of the main array is an array of IDs representing the children for the ID specified by the
     * index of the main array.
     *
     * For example:
     *
     * array(
     *     1 => array(2, 3),
     *     2 => array(),
     *     3 => array(),
     * )
     *
     * In the example above we are saying that record ID 1 has two children: 2 and 3. Records 2 and 3 have no children.
     *
     * @param array[] Array of array of children ids
     * @throws InvalidArgumentException
     */
    public function setHierarchy($hierarchy)
    {
        if (!is_array($hierarchy)) {
            throw new InvalidArgumentException('Hierarchy must be an array.');
        }

        $this->hierarchy = $hierarchy;
    }

    /**
     * @return array[]
     */
    public function getHierarchy()
    {
        return $this->hierarchy;
    }

    /**
     * Converts to File Tree Structure starting from id provided by $itemId.
     *
     * @param int Id to start from
     * @return array Returns the converted data as an array of multiple array structure.
     */
    public function convert($itemId)
    {
        $return = array();
        $return['data'] = $this->data[$itemId];
        $return['children'] = array();

        foreach ($this->hierarchy[$itemId] as $child) {
            $return['children'] = array_merge($return['children'], array($this->convert($child)));
        }

        return $return;
    }
}