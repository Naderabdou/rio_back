<?php

        namespace App\Repositories\Sql;
        use App\Models\CounterZekr;
        use App\Repositories\Contract\CounterZekrRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class CounterZekrRepository extends BaseRepository implements CounterZekrRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new CounterZekr();

            }

        }
        