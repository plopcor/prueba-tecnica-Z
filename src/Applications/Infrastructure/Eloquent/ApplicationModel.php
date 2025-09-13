<?php

namespace Src\Applications\Infrastructure\Eloquent;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ApplicationModel extends Model
{
    protected $table = 'applications';
    public $incrementing = true;
    protected $primaryKey = 'id';

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'url',
        'is_active'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
