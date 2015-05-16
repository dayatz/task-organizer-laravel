<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model {

	protected $table = 'board';

    public function cards() {
        return $this->hasMany('App\Card', 'board_id');
    }

    public function collaborators() {
        return $this->hasMany('App\BoardCollaborator', 'board_id');
    }
}
