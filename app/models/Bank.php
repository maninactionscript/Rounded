<?php
    class Bank extends Eloquent {
        protected $table = 'banks';
        public $timestamps = false;

        public function user()
        {
            return $this->belongsTo('User');
        } 
        public function expenses()
        {
            return $this->hasMany('Expense');
        }
        public function imports()
        {
            return $this->hasMany('Import');
        }
        public function lastImport()
        {
            return $this->hasOne('Import')->orderBy('id','desc');
        }
    }
