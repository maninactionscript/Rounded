<?php
    class EmailTemplate extends Eloquent {
        protected $table = 'email_templates';
        public $timestamps = false;
        public static $makeup = array(
        
        
        
        );
        public function user()
        {
            return $this->belongsTo('User');
        }
    }
