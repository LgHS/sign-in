<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePaymentTypeRequest;
use App\Http\Requests\UpdatePaymentTypeRequest;
use App\Repositories\PaymentTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PaymentTypeController extends AppBaseController
{
    /** @var  PaymentTypeRepository */
    private $paymentTypeRepository;

    public function __construct(PaymentTypeRepository $paymentTypeRepo)
    {
        $this->paymentTypeRepository = $paymentTypeRepo;
    }

    /**
     * Display a listing of the PaymentType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->paymentTypeRepository->pushCriteria(new RequestCriteria($request));
        $paymentTypes = $this->paymentTypeRepository->all();

        return view('admin.payment_types.index')
            ->with('paymentTypes', $paymentTypes);
    }

    /**
     * Show the form for creating a new PaymentType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.payment_types.create');
    }

    /**
     * Store a newly created PaymentType in storage.
     *
     * @param CreatePaymentTypeRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentTypeRequest $request)
    {
        $input = $request->all();

        $paymentType = $this->paymentTypeRepository->create($input);

        Flash::success('Payment Type saved successfully.');

        return redirect(route('admin.paymentTypes.index'));
    }

    /**
     * Display the specified PaymentType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paymentType = $this->paymentTypeRepository->findWithoutFail($id);

        if (empty($paymentType)) {
            Flash::error('Payment Type not found');

            return redirect(route('admin.paymentTypes.index'));
        }

        return view('admin.payment_types.show')->with('paymentType', $paymentType);
    }

    /**
     * Show the form for editing the specified PaymentType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paymentType = $this->paymentTypeRepository->findWithoutFail($id);

        if (empty($paymentType)) {
            Flash::error('Payment Type not found');

            return redirect(route('admin.paymentTypes.index'));
        }

        return view('admin.payment_types.edit')->with('paymentType', $paymentType);
    }

    /**
     * Update the specified PaymentType in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentTypeRequest $request)
    {
        $paymentType = $this->paymentTypeRepository->findWithoutFail($id);

        if (empty($paymentType)) {
            Flash::error('Payment Type not found');

            return redirect(route('admin.paymentTypes.index'));
        }

        $paymentType = $this->paymentTypeRepository->update($request->all(), $id);

        Flash::success('Payment Type updated successfully.');

        return redirect(route('admin.paymentTypes.index'));
    }

    /**
     * Remove the specified PaymentType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $paymentType = $this->paymentTypeRepository->findWithoutFail($id);

        if (empty($paymentType)) {
            Flash::error('Payment Type not found');

            return redirect(route('admin.paymentTypes.index'));
        }

        $this->paymentTypeRepository->delete($id);

        Flash::success('Payment Type deleted successfully.');

        return redirect(route('admin.paymentTypes.index'));
    }
}
