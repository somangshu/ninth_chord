<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use App\Repositories\Track\TrackRepository;
use Validations\Exceptions\ValidationException;
use App\Repositories\Track\TrackRepository as Track;
use Validations\Services\Validators\TrackValidator as Validator;

class TrackController extends BaseController
{
    private $track;
    private $_validator;

    public function __construct(Track $track, Validator $validator)
    {
        $this->track = $track;
        $this->_validator = $validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->successMessage($this->track->getAll($request->all()), 'All track fetched', false, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->input('data');

        //valid json request
        if (empty($data)) {
            $this->logError('Not valid data', $data);

            return $this->errorMessage('Not valid data', [], 400);
        }

        //validation
        try {

            $validateData = $this->_validator->validate($data);
        } catch (ValidationException $e) {
            $this->logError('validation error- genre -'.$e->get_errors(), $data);

            return $this->errorMessage('Validation Error!', $e->get_errors(), 409);
        }

        //create
        \DB::beginTransaction();
        try {
            $genre = $this->track->save($data);

            $this->track->syncGenre($genre, $data['genres']);
        } catch (\Exception $e) {
            \DB::rollBack();

            $this->logError('Error in saving track', $data);

            return $this->errorMessage($e->getMessage(), [], 500);
        }
        \DB::commit();

        return $this->successMessage([], 'track successfully stored', false, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $track = $this->track->getTrack($id);
        } catch (\Exception $e) {
            $this->logError('not found', $id);

            return $this->errorMessage($e->getMessage(), [], 404);
        }

        return $this->successMessage($track, 'track fetched', false, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->input('data');

        //valid json request
        if (empty($data)) {
            $this->logError('Not valid data', $data);

            return $this->errorMessage('Not valid data', [], 400);
        }

        //validation
        try {

            $validateData = $this->_validator->validate($data);
        } catch (ValidationException $e) {
            $this->logError('validation error- genre -'.$e->get_errors(), $data);

            return $this->errorMessage('Validation Error!', $e->get_errors(), 409);
        }

        //update
        \DB::beginTransaction();
        try {
            $this->track->updateTrack($id, $data);

            $this->track->syncGenre($id, $data['genres']);
        } catch (\Exception $e) {
            \DB::rollBack();

            $this->logError('Error in updating track', $data);

            return $this->errorMessage($e->getMessage(), [], 500);
        }
        \DB::commit();

        return $this->successMessage([], 'track successfully updated', false, 201);
    }

}
