<?php
namespace Dev\Example\Model;

class Example extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'dev_example_example';

	protected $_cacheTag = 'dev_example_example';

	protected $_eventPrefix = 'dev_example_example';

	protected function _construct()
	{
		$this->_init('Dev\Example\Model\ResourceModel\Example');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}