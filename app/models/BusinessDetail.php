<?php
    class BusinessDetail extends Eloquent {
        protected $table = 'business_details';
        public $timestamps = false;

        public function user()
        {
            return $this->belongsTo('User');
        }
    }
