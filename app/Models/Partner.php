<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'partners'; // テーブル名
    protected $guarded = ['id'];
    protected $appends = ["organization_type_name"];

    public function getBasicContractFlagAttribute()
    {
        return $this->attributes['basic_contract_flag'] ? true : false;
    }

    public function getOrganizationTypeNameAttribute()
    {
        $type = $this->attributes['organization_type'];

        if ($type == 1) {
            return '個人';
        } else if ($type == 2) {
            return '法人';
        }
        return '不明';
    }
}
