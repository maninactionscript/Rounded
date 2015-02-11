<?php

    use Illuminate\Auth\UserTrait;
    use Illuminate\Auth\UserInterface;
    use Illuminate\Auth\Reminders\RemindableTrait;
    use Illuminate\Auth\Reminders\RemindableInterface;

    class User extends Eloquent implements UserInterface, RemindableInterface {

        use UserTrait, RemindableTrait;

        /**
        * The database table used by the model.
        *
        * @var string
        */
        protected $table = 'users';

        /**
        * The attributes excluded from the model's JSON form.
        *
        * @var array
        */
        protected $hidden = array('password', 'remember_token');
        public function categories()
        {
            return $this->hasMany('Category');
        }

        public function expenses()
        {
            return $this->hasMany('Expense');
        }
        public function businessDetail()
        {
            return $this->hasOne('BusinessDetail');
        }
        public function accountSetting()
        {
            return $this->hasOne('AccountSetting');
        }
        public function reminder()
        {
            return $this->hasOne('Reminder');
        }
        public function banks()
        {
            return $this->hasMany('Bank');
        }
        public function clients()
        {
            return $this->hasMany('Client');
        }
        public function invoice_setting()
        {
            return $this->hasOne('InvoiceSetting');
        }
        public function goal()
        {
            return $this->hasOne('Goal');
        }
        public function totalIncome()
        {
            $query = Expense::where('user_id','=',$this->id)->where('type','=','income')->where('expense_area','=','workbook');
            $result = $query->select(DB::raw('SUM(amount) AS value'))->first();       
            if($result->value == null) return 0;
            return $result->value; 
        }

    }
