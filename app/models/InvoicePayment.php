<?php
    class InvoicePayment extends Eloquent {
        protected $table = 'invoice_payments';
        public $timestamps = false;

        public function invoice()
        {
            return $this->belongsTo('Invoice');
        }
    }
