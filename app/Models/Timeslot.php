<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    use HasFactory;
    protected $fillable = ['day_id','start_time','end_time','total_order','display_order'];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function day(){
        return $this->belongsTo(Day::class,'day_id');
    }
}
