<?php

namespace app\Repositories\Track;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Track\TrackRepository;
use App\Track;
// use App\Validators\Track\TrackValidator;;

/**
 * Class TrackRepositoryEloquent
 * @package namespace App\Repositories\Track;
 */
class TrackRepositoryEloquent extends BaseRepository implements TrackRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Track::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAll($param)
    {
        $track = $this->makeModel()->with(['genres' => function ($query) {
                                            $query->select('id', 'name');
                                        },
                                    ]);

        if(empty($param)) {
            return $track->paginate(5)->toArray();
        } else {
            foreach ($param as $key => $value) {
                if($key !== 'page') {
                    if (is_string($value)) {
                        $track->where($key, 'LIKE', '%'.$value.'%');
                    } else {
                        $track->where($key, $value);
                    }
                }
            }

            return $track->paginate(5)->toArray();
        }
    }

    public function save($data)
    {
        $track = new $this->model();

        $track->title = $data['title'];
        $track->rating = (isset($data['rating'])) ? $data['rating'] : 0.0;

        $track->save();

        return $track->id;
    }

    public function syncGenre($track_id, $genre_ids)
    {
        return $this->makeModel()->find($track_id)->genres()->sync($genre_ids, false);
    }

    public function updateTrack($track_id, $data)
    {

        $track = $this->makeModel()->find($track_id);

        $track->title = $data['title'];
        $track->rating = (isset($data['rating'])) ? $data['rating'] : 0.0;

        $track->save();
    }
}
