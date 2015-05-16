<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardCollaborator extends Model {
    protected $table = 'board_collaborator';

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function board() {
        return $this->belongsTo('App\Board', 'board_id');
    }
}
