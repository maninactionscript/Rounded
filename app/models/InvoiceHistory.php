<?php
    class InvoiceHistory extends Eloquent {
        protected $table = 'invoice_histories';
        public $timestamps = false;
        public $user_id = 0;
        public $created_date = '';
        public $invoice_id = 0;
        public $event = '';

        public function setHistory($user_id, $event, $invoice_id)
        {
            $this->user_id = $user_id;
            $this->invoice_id = $invoice_id;
            $this->event = $event;
            $this->created_date = date('Y-m-d');
            $this->save();
        } 
    }
