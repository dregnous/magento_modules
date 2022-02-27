<?php
namespace Dev\Example\Model\ResourceModel\Example;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'example_data_collection';
	protected $_eventObject = 'example_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Dev\Example\Model\Example', 'Dev\Example\Model\ResourceModel\Example');
	}

}
