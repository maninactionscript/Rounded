<?php
    class AccountSetting extends Eloquent {
        protected $table = 'account_settings';
        public $timestamps = false;

        public function user()
        {
            return $this->belongsTo('User');
        }
    }
