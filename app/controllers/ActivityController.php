<?php

    class ActivityController extends BaseController {

        /*
        |--------------------------------------------------------------------------
        | Default Home Controller
        |--------------------------------------------------------------------------
        |
        | You may wish to use controllers instead of, or in addition to, Closure
        | based routes. That's great! Here is an example controller method to
        | get you started. To route to this controller, just add the route:
        |
        |    Route::get('/', 'HomeController@showWelcome');
        |
        */
        protected $layout = 'layouts.master';
        public function index()
        {  
            $years = array((int)date('Y'));
            for($i=0;$i<3;$i++){
                $years[] = $years[$i] - 1;
            }
            $quarter = array('7-9' => 'Q1: July - September',
                '10-12' => 'Q2: October - December',
                '1-3' => 'Q3: January - March',
                '4-6' => 'Q4: April - June');
            $data = array('years' => $years, 'quarter' => $quarter); 
            return View::make('activity.index')->with($data);
        }

    }
