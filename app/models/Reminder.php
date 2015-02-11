<?php
    class Reminder extends Eloquent {
        protected $table = 'reminders';
        public $timestamps = false;

        public function user()
        {
            return $this->belongsTo('User');
        }
    }
