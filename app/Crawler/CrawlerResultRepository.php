<?php

namespace App\Crawler;

use App\Models\CrawlerResult;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CrawlerResultRepository
{
    public function paginate(int $perPage): LengthAwarePaginator
    {
        return CrawlerResult::query()
                            ->select(['id', 'screenshot', 'title', 'description',])
                            ->orderByDesc('id')
                            ->paginate($perPage);
    }
}
