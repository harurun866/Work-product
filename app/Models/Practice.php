<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'duration',   // 'time' ではなく 'duration' ですね（controllerに合わせる場合）
        'instrument',
        'genre',
        'content',
        'reflection',
        'next_goal',
        'memo',
    ];

    /**
     * ページネーションで取得（指定件数）
     *
     * @param int $limit_count
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('date', 'desc')->paginate($limit_count);
    }
}
