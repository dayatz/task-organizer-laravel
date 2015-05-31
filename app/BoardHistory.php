<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardHistory extends Model {
    protected $table = 'board_history';

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function board() {
        return $this->belongsTo('App\Board', 'board_id');
    }
}
