<?php
    class Expense extends Eloquent {
        protected $table = 'expenses';
        public $timestamps = false;

        public function user()
        {
            return $this->belongsTo('User');
        }
        public function category()
        {
            return $this->belongsTo('Category');
        }
        public function recurring()
        {
            return $this->hasOne('Recurring');
        }
        public function inWorkbook()
        {
            return $this->hasMany('Expense','parent_id');
        }
    }
