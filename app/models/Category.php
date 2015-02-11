<?php
    class Category extends Eloquent {
        protected $table = 'categories';
        public $timestamps = false;

        public function user()
        {
            return $this->belongsTo('User');
        }
        public function expenses()
        {
            return $this->hasMany('Expense');
        }
    }
