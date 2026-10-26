<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'thumbnail',
        'is_premium',
        'view_path',
    ];

    protected function casts(): array
    {
        return [
            'is_premium' => 'boolean',
        ];
    }

    public function cvs(): HasMany
    {
        return $this->hasMany(Cv::class);
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }
}
