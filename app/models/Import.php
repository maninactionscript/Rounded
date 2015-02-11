<?php
    class Import extends Eloquent {
        protected $table = 'imports';
        public $timestamps = true;
 
        public function bank()
        {
            return $this->belongTo('Bank');
        }
    }
