<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TransactionOrderByCriteriaCriteria
 * @package namespace App\Criteria;
 */
class OrderByCriteria implements CriteriaInterface
{

	/**
	 * @var
	 */
	private $orderByCriteria;
	/**
	 * @var
	 */
	private $sortByCriteria;

	public function __construct($orderByCriteria, $sortByCriteria = "ASC") {
		$this->orderByCriteria = $orderByCriteria;
		$this->sortByCriteria = $sortByCriteria;
	}

	/**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
    	return $model->orderBy($this->orderByCriteria, $this->sortByCriteria);
    }
}
