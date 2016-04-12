<?php

namespace App\Repositories\Genre;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Genre\GenreRepository;
use App\Genre;
// use App\Validators\Genre\GenreValidator;;

/**
 * Class GenreRepositoryEloquent
 * @package namespace App\Repositories\Genre;
 */
class GenreRepositoryEloquent extends BaseRepository implements GenreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Genre::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function save($data)
    {
        $genre = new $this->model();

        $genre->name = $data['name'];
        $genre->status = 1;

        $genre->save();

        return $genre->id;
    }

    public function getAll($param)
    {

        $genre = $this->makeModel()->select('id', 'name');

        if(empty($param)) {
            return $genre->get();
        } else {
            foreach ($param as $key => $value) {
                if (is_string($value)) {
                    $genre->where($key, 'LIKE', '%'.$value.'%');
                } else {
                    $genre->where($key, $value);
                }
            }

            return $genre->get();
        }
    }

    public function getGenre($id)
    {
        return $this->makeModel()->findOrFail($id);
    }

    public function updateGenre($data, $id)
    {
        $genre = $this->makeModel()->find($id);

        $genre->name = $data['name'];

        $genre->save();
    }
}
