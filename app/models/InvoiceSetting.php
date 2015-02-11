<?php
    class InvoiceSetting extends Eloquent {
        protected $table = 'invoice_settings';
        public $timestamps = false;

        public function user()
        {
            return $this->belongsTo('User');
        }
    }
