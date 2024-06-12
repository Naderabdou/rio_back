<?php

        namespace App\Repositories\Sql;
        use App\Models\MultimediaCategory;
        use App\Repositories\Contract\MultimediaCategoryRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class MultimediaCategoryRepository extends BaseRepository implements MultimediaCategoryRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new MultimediaCategory();

            }

        }
        