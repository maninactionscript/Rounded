<?php
  class Client extends Eloquent {
    protected $table = 'clients';
    public $timestamps = false;

    public function user()
    {
      return $this->belongsTo('User');
    }
    public function totalIncome(){
      $invoices = Invoice::where('client_id','=',$this->id)->where('sent','=',1)->get();
      $total = 0;
      if($invoices->count() > 0){
        foreach($invoices as $invoice){
          $total+=$invoice->getPaid();
        }
      }
      return $total;
    }
    public function getInvoiceOrder()
    {
      $lastInv = Invoice::where('client_id', '=', $this->id)->orderBy('id', 'desc')->first();
      $order = $lastInv == null ? 1 : ($lastInv->order + 1);
      return $order;
    }
  }
