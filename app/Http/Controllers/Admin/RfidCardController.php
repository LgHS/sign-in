<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateRfidCardRequest;
use App\Http\Requests\UpdateRfidCardRequest;
use App\Repositories\RfidCardRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Response;

class RfidCardController extends AppBaseController
{
    /** @var  RfidCardRepository */
    private $rfidCardRepository;

    public function __construct(RfidCardRepository $rfidCardRepo)
    {
        $this->rfidCardRepository = $rfidCardRepo;
    }

    /**
     * Display a listing of the RfidCard.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $rfidCards = $this->rfidCardRepository->all();

        return view('admin.rfid_cards.index')
            ->with('rfidCards', $rfidCards);
    }

    /**
     * Show the form for creating a new RfidCard.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.rfid_cards.create', $this->getAllRelations());
    }

    /**
     * Store a newly created RfidCard in storage.
     *
     * @param CreateRfidCardRequest $request
     *
     * @return Response
     */
    public function store(CreateRfidCardRequest $request)
    {
        $input = $request->all();

        $rfidCard = $this->rfidCardRepository->create($input);

        Flash::success('Rfid Card saved successfully.');

        return redirect(route('admin.rfidCards.index'));
    }

    /**
     * Display the specified RfidCard.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rfidCard = $this->rfidCardRepository->find($id);

        if (empty($rfidCard)) {
            Flash::error('Rfid Card not found');

            return redirect(route('admin.rfidCards.index'));
        }

        return view('admin.rfid_cards.show')->with('rfidCard', $rfidCard);
    }

    /**
     * Show the form for editing the specified RfidCard.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rfidCard = $this->rfidCardRepository->find($id);

        if (empty($rfidCard)) {
            Flash::error('Rfid Card not found');

            return redirect(route('admin.rfidCards.index'));
        }

        return view('admin.rfid_cards.edit', $this->getAllRelations())->with('rfidCard', $rfidCard);
    }

    /**
     * Update the specified RfidCard in storage.
     *
     * @param int $id
     * @param UpdateRfidCardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRfidCardRequest $request)
    {
        $rfidCard = $this->rfidCardRepository->find($id);

        if (empty($rfidCard)) {
            Flash::error('Rfid Card not found');

            return redirect(route('admin.rfidCards.index'));
        }

        $rfidCard = $this->rfidCardRepository->update($request->all(), $id);

        Flash::success('Rfid Card updated successfully.');

        return redirect(route('admin.rfidCards.index'));
    }

    /**
     * Remove the specified RfidCard from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rfidCard = $this->rfidCardRepository->find($id);

        if (empty($rfidCard)) {
            Flash::error('Rfid Card not found');

            return redirect(route('admin.rfidCards.index'));
        }

        $this->rfidCardRepository->delete($id);

        Flash::success('Rfid Card deleted successfully.');

        return redirect(route('admin.rfidCards.index'));
    }

    private function getAllRelations() {
        $relations = [];

        $members = [];
        foreach(User::all() as $user) {
            $members[$user->id] = $user->fullName;
        }

        $relations['members'] = $members;

        return $relations;
    }
}
