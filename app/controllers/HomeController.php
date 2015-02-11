<?php

    class HomeController extends BaseController {

        /*
        |--------------------------------------------------------------------------
        | Default Home Controller
        |--------------------------------------------------------------------------
        |
        | You may wish to use controllers instead of, or in addition to, Closure
        | based routes. That's great! Here is an example controller method to
        | get you started. To route to this controller, just add the route:
        |
        |	Route::get('/', 'HomeController@showWelcome');
        |
        */
        protected $layout = 'layouts.master';
        public function home()
        {
            return View::make('layouts.main');
        }
        public function test()
        {  
            Cron::add('example1', '* * * * *', function() {
                $file = fopen(public_path('tmp/text.txt'),'w');
             
                $string = date('Y-m-d H:i:s'); 
                fwrite($file,$string);
                return 'No';
            });
             $report = Cron::run();
              print_r ($report);
        }
        public function jrsql()
        {
           $dataold = DB::table('expenses_old')->where('user_id','=',11)->get();
           $data = DB::table('expenses')->where('user_id','=',11)->get(); 
           foreach($dataold as $old){
               $expense = new Expense();
               $expense->amount = $old->amount;    
               $expense->gst = $old->gst;    
               $expense->inc_gst = $old->inc_gst;    
               $expense->description = $old->description;    
               $expense->attachment = $old->attachment;    
               $expense->created_at = $old->created_at;    
               $expense->updated_at = $old->updated_at;    
               $expense->type = $old->type;    
               $expense->category_id = $old->category_id;    
               $expense->business_use = 100;    
               $expense->expense_type = $old->type == 'income'?NULL:1;    
               $expense->expense_area = 'workbook';    
               $expense->user_id = $old->user_id;    
               $expense->bank_id = 0;    
               $expense->parent_id = 0; 
               $expense->save();   
           }
            
        }

    }
