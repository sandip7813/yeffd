<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    public function dp_pictures(){
        return $this->hasOne('App\Pictures', 'application_id')
                    ->where('application_type', '1')
                    ->where('is_dp', '1')
                    ->where('status', '1');
    }

    public function pictures(){
        return $this->hasMany('App\Pictures', 'application_id')
                    ->where('application_type', '1')
                    ->where('status', '1');
    }

    public function all_pictures(){
        return $this->hasMany('App\Pictures', 'application_id')
                    ->where('application_type', '1');
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($event) { // before delete() method call this
            $event->all_pictures()->delete();
        });
    }
}
