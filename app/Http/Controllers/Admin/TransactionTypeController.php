<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTransactionTypeRequest;
use App\Http\Requests\UpdateTransactionTypeRequest;
use App\Repositories\TransactionTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TransactionTypeController extends AppBaseController
{
    /** @var  TransactionTypeRepository */
    private $transactionTypeRepository;

    public function __construct(TransactionTypeRepository $transactionTypeRepo)
    {
        $this->transactionTypeRepository = $transactionTypeRepo;
    }

    /**
     * Display a listing of the TransactionType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->transactionTypeRepository->pushCriteria(new RequestCriteria($request));
        $transactionTypes = $this->transactionTypeRepository->all();

        return view('admin.transaction_types.index')
            ->with('transactionTypes', $transactionTypes);
    }

    /**
     * Show the form for creating a new TransactionType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.transaction_types.create');
    }

    /**
     * Store a newly created TransactionType in storage.
     *
     * @param CreateTransactionTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateTransactionTypeRequest $request)
    {
        $input = $request->all();

        $transactionType = $this->transactionTypeRepository->create($input);

        Flash::success('Transaction Type saved successfully.');

        return redirect(route('admin.transactionTypes.index'));
    }

    /**
     * Display the specified TransactionType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transactionType = $this->transactionTypeRepository->findWithoutFail($id);

        if (empty($transactionType)) {
            Flash::error('Transaction Type not found');

            return redirect(route('admin.transactionTypes.index'));
        }

        return view('admin.transaction_types.show')->with('transactionType', $transactionType);
    }

    /**
     * Show the form for editing the specified TransactionType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transactionType = $this->transactionTypeRepository->findWithoutFail($id);

        if (empty($transactionType)) {
            Flash::error('Transaction Type not found');

            return redirect(route('admin.transactionTypes.index'));
        }

        return view('admin.transaction_types.edit')->with('transactionType', $transactionType);
    }

    /**
     * Update the specified TransactionType in storage.
     *
     * @param  int              $id
     * @param UpdateTransactionTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransactionTypeRequest $request)
    {
        $transactionType = $this->transactionTypeRepository->findWithoutFail($id);

        if (empty($transactionType)) {
            Flash::error('Transaction Type not found');

            return redirect(route('admin.transactionTypes.index'));
        }

        $transactionType = $this->transactionTypeRepository->update($request->all(), $id);

        Flash::success('Transaction Type updated successfully.');

        return redirect(route('admin.transactionTypes.index'));
    }

    /**
     * Remove the specified TransactionType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transactionType = $this->transactionTypeRepository->findWithoutFail($id);

        if (empty($transactionType)) {
            Flash::error('Transaction Type not found');

            return redirect(route('admin.transactionTypes.index'));
        }

        $this->transactionTypeRepository->delete($id);

        Flash::success('Transaction Type deleted successfully.');

        return redirect(route('admin.transactionTypes.index'));
    }
}
