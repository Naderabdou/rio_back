<?php

        namespace App\Repositories\Sql;
        use App\Models\ConnectivityTool;
        use App\Repositories\Contract\ConnectivityToolRepositoryInterface;
        use Illuminate\Database\Eloquent\Collection;

        class ConnectivityToolRepository extends BaseRepository implements ConnectivityToolRepositoryInterface
        {

            public function __construct()
            {

                return $this->model = new ConnectivityTool();

            }

        }
        