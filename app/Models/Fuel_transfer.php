<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel_transfer extends Model
{
    use HasFactory;

    public function next(){
        // get next user
        return Fuel_transfer::where('id', '>', $this->id)->orderBy('id','asc')->first();
    
    }
    public  function previous(){
        // get previous  user
        return Fuel_transfer::where('id', '<', $this->id)->orderBy('id','desc')->first();
    
    }
}
