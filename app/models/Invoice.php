<?php
  class Invoice extends Eloquent {
    protected $table = 'invoices';
    public $timestamps = false;
    public function getDates() {
      return array();
    }
    public function user()
    {
      return $this->belongsTo('User');
    }
    public function client()
    {
      return $this->belongsTo('Client');
    }
    public function prices(){
      return $this->hasMany('Price','invoice_id');
    }
    public function getPaid(){
      $query = Expense::where('invoice_id','=',$this->id)->where('type','=','income');
      $paid = $query->select(DB::raw('SUM(amount) as value'))->get();
      if($paid[0]->value == null){
        return 0;
      }
      return $paid[0]->value;

    }
    public function getLastPaid(){
      $query = Expense::where('invoice_id','=',$this->id)->where('type','=','income');
      $result = $query->orderBy('updated_at','desc')->first();
      if($result == null) return false ;
      return $result->updated_at->toDateString(); 
    }
  }
?>
