<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'projects';
    protected $guarded = ['id'];
    protected $appends = ['status_name'];

    public function partner()
    {
        return $this->hasOne(Partner::class, 'id', 'partner_id');
    }


    public function getPriceAttribute($v)
    {
        return number_format($v);
    }

    public function getMoneyAttribute($v)
    {
        return number_format($v);
    }

    public function getStatusNameAttribute()
    {
        $v = $this->status;
        if ($v == 1) return '新規';
        if ($v == 2) return '進行中';
        if ($v == 3) return '保留中';
        if ($v == 4) return '終了';
    }
}
