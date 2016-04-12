<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use Validations\Services\Validators\GenreValidator as Validator;
use App\Repositories\Genre\GenreRepository as Genre;
use Validations\Exceptions\ValidationException;


class GenreController extends BaseController
{
    private $genre;
    private $_validator;

    public function __construct(Genre $genre, Validator $validator)
    {
        $this->genre = $genre;
        $this->_validator = $validator;
    }

    public function getView()
    {
        return view('dashboardpanel');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return $this->successMessage($this->genre->getAll($request->all()), 'All genre fetched', false, 200);
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
        try {
            $genre = $this->genre->save($data);
        } catch (\Exception $e) {
            $this->logError('Error in saving genre', $data);

            return $this->errorMessage($e->getMessage(), [], 500);
        }

        return $this->successMessage([], 'genre successfully stored', false, 201);
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
            $genre = $this->genre->getGenre($id);
        } catch (\Exception $e) {
            $this->logError('not found', $id);

            return $this->errorMessage($e->getMessage(), [], 404);
        }

        return $this->successMessage($genre, 'genre fetched', false, 200);

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
        try {
            $this->genre->updateGenre($data, $id);
        } catch (\Exception $e) {
            $this->logError('Error in updating genre', $data);

            return $this->errorMessage($e->getMessage(), [], 500);
        }

        return $this->successMessage([], 'genre successfully updated', false, 200);


    }
}
