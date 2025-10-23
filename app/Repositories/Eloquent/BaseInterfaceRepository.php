<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseInterfaceRepositoryInterface;

class BaseInterfaceRepository extends BaseRepository implements BaseInterfaceRepositoryInterface
{
    // Handles data access (CRUD, DB queries)
    //Generic CRUD logic (shared by all repositories)
    //common reusable Eloquent logic
    // BaseRepository is an abstract class that holds all the common CRUD logic shared across all your repositories

    //Query Builder is good for complex joins, aggregates, or raw performance queries.
    //your base repo defines generic CRUD, and each specific repo (like ProductRepo) adds custom query logic using either Eloquent or Query Builder.
}
