<?php
    class Goal extends Eloquent {
        protected $table = 'goals';
        public $timestamps = false;
 
        public function user()
        {
            return $this->belongTo('User');
        }
    }
