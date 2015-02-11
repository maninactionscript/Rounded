<?php


	class ResponseObject
	{
		public  $status;
		public  $result;
		public	$errorCode;
		public	$message;
		
		function __construct($status, $data, $errCode) 
		    { 
			    $this->status = $status;
			    $this->result = $data;
			    $this->errorCode = $errCode;		    		    
			    
			    if ($this->status === 0) {
			    	switch($errCode) {
			    		case 100:
			    			$this->message = "User name or Password incorrect!";
			    		break;
	
	                                case 101:
			    			$this->message = "email is exist";
			    		break;
	
	                                case 102:
			    			$this->message = "Fail to create User";
			    		break;
			    		
			    		case 103:
			    			$this->message = "Fail to create Category";
			    		break;
	                            
			    		case 104:
			    			$this->message = "Fail to create Expense";
			    		break;
	
	                                default:
			    			$this->message = "request fail";
			    		break;
			    	}
			    }
		    }
	}

    class MobileAPI extends BaseController {

/*
1234 -> $2y$10$rAurnyH08E/0bwir/PC9T.qdrgPeM3cX6DgxIHjHnHfOiY2ae9Vey
		$2y$10$2a4aVESln.uTIOUDQZ46DueSFX0ULFxjsfozVGdDRUGAbERuyA2.y
username: levTest
email: levTest@test.com
*/
	public function echoResponse($ar, $status, $errorCode) {

		$responseObject = new ResponseObject($status, $ar, $errorCode);
		echo(json_encode($responseObject));
	}
	
	public function api()
        { 
        
         $requestType = Input::get('requestType');
         
          ////////////////// API Registry
	if ($requestType === "Registry")  
	{	
	
            $userdata = array(
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'password' => Input::get('pass'),
                'password_confirmation' => Input::get('pass')       
            );

            $rules = array(                          
                'username' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4|confirmed',
                'password_confirmation' => 'required|min:4'
            );

            $validation = Validator::make($userdata, $rules);
            if($validation->fails()){   
                    $this->echoResponse(array(), 0, 100); 
                    return;           
            } 

            $userdata['password'] = Hash::make($userdata['password']);
            $userdata = (object) $userdata;

            $user = new User();
            foreach($userdata as $key => $value) {
                $user->$key = $value;
            }
            unset($user->password_confirmation);
            $user->save();
            if ( $user->id )
            {
		// register success
		// create folder in media/receipt/{id} and /{id}/purchases

		// get user info

            	$userInfo = User::where('email','=', $user->email) ->get();
		// get user categories
            	$categories = Category::where('user_id', '=', 0) ->get();

		
		$obj = array();
		$obj["userInfo"] = $userInfo;
		$obj["categories"] = $categories;
		$this->echoResponse($obj, 1, 0);
		
            }
            else {
                    $this->echoResponse(array(), 0, 102);

            }

		
	}
	
         
         
         
         /// API Login
         if($requestType === "LoginEmail") {


		   $userdata = array(
	                'email' => Input::get('email'),
	                'password' => Input::get('pass')
	                
	            );  
	
	            $rules = array(
	                'email'  => 'required|email',
	                'password'  => 'required'
	                
	            ); 
	            $validator = Validator::make($userdata, $rules); 
	            
	           if ($validator->passes())
//		if(strlen($email) > 0)
	            {
	            	// query user info
	            	$userInfo = User::where('email','=',$userdata["email"]) ->get();
									            
	            	// query categories of user
	            	$categories = Category::where('user_id', '=', $userInfo[0]["id"])-> orWhere('user_id', '=', 0) ->get();
	            	// unit to oject to send
	
	
	
			$array = array();
			$array["userInfo"] = $userInfo;
			$array["categories"] = $categories;		
	            	$this->echoResponse($array , 1, 0);		
	            } else {
	        	$this->echoResponse(array(), 0, 100);            
	            }
           }
            
	////////////////// API Get Categories
	if ($requestType === "GetCategory")  
	{
	 	$userId = Input::get('userId');
            	$result = DB::table('categories')->where('user_id', '=', $userId)-> orWhere('user_id', '=', 0) ->get();
	        if (count ($result) > 0) {	
	        	$this->echoResponse($result, 1, 0);
	        } else {
	            $this->echoResponse(array(), 1, 0);
	        }
	    
	}
	
	////////////////// API Insert Category
	if ($requestType === "InsertCategory")  
	{
		$cateData = array(
	                'title' => Input::get('title'),
	                'user_id' => Input::get('userId')
	            );  
	        $id = DB::table('categories')-> insertGetId($cateData);

	        if ($id > 0) {
	            $obj = array("id" =>$id, "title" => $cateData['title'] );
	            $array =  array($obj);
	            $this->echoResponse($array, 1, 0);
	        } else {
	            $this->echoResponse(array(), 1, 0);
	        }

	}
		

	////////////////// API Get Expenses by User
	if ($requestType === "GetExpenseByUser")  
	{
	 	$userId = Input::get('userId');
            	$expenses = DB::table('expenses')->where('user_id', '=', $userId) ->get();
	        	$this->echoResponse($expenses, 1, 0);
	        	return;            	
	        if (count($expenses) > 0) {
	
	        	$this->echoResponse($expenses, 1, 0);
	        } else {
	            $this->echoResponse(array(), 1, 0);
	        }
	}		
	
	
	////////////////// API Insert Expnse
	if ($requestType === "InsertExpense")  
	{    	
		$expneseData = array(
         	"amount"    	=>   Input::get('amount'),
	        "gst"       	=>   Input::get('gst'),  
	        "inc_gst"   	=>   Input::get('inc_gst'),
	        "description" 	=>   Input::get('description'),
	        "created_at"  	=>   Input::get('date'),
	        "updated_at"	=>   Input::get('date'),	
	        "type"      	=>   Input::get('type'),
	        "category_id" 	=>   Input::get('category_id'),
	        "user_id"   	=>   Input::get('user_id'),
	        "attachment"  	=>   Input::get('imageLink'),
	        );
	        $id = DB::table('expenses')-> insertGetId($expneseData);
	
	        if ($id > 0) {
	            $obj = array("id" =>$id );
	            $array =  array($obj);
	        	$this->echoResponse($array, 1, 0);
	        } else {
	            $this->echoResponse(array(), 0, 0);
	        }
	        
	}


	////////////////// API update Expnse
	if ($requestType === "EditExpense")  
	{    	
		$expenseId = Input::get('id');
		$expneseData = array(
		/*
	        'amount'		=> Input::get('amount'),
	        'gst'			=> Input::get('gst'),  
	        'inc_gst'		=> Input::get('inc_gst'),
	        'description'		=> Input::get('description'),
	        'created_at'		=> Input::get('date'),
	        'type'			=> Input::get('type'),
	        'category_id'		=> Input::get('category_id'),
	        'user_id'		=> Input::get('user_id'),
	        'attachment'		=> Input::get('imageLink')
*/
Input::get('amount'),
    Input::get('gst'),
    Input::get('inc_gst'),
    Input::get('description'),
    Input::get('date'),
    Input::get('type'),
    Input::get('category_id'),
    Input::get('user_id'),
    Input::get('imageLink'),
    Input::get('id')
	        );
	        

//	        $num = Expense::find($expenseId)->update($expneseData);
	        
//	        $num = DB::table('expenses')->where('id','=', $expenseId)-> update($expneseData);
	        $num = DB::update("UPDATE  bsr_expenses 
                    SET     amount      =   ?,
                            gst         =   ?,
                            inc_gst     =   ?,
                            description =   ?,
                            created_at  =   ?,                            
                            type        =   ?,
                            category_id =   ?,
                            user_id     =   ?,
                            attachment  =   ?                            
                    WHERE id = ?", $expneseData);
//		echo('id '. $num);
				
	        if ($num > 0) {
	            $obj = array("id" =>$expenseId );
	            $array =  array($obj);
	        	$this->echoResponse(array(), 1, 0);
	        } else {
	            $this->echoResponse(array(), 0, 0);
	        }
	        
	        
	}	
	
	////////////////// API update Expnse
	if ($requestType === "upload")  
	{
		$userId = Input::get('userId');

		if($userId == null) {
		
		echo("");
		return;
		}
		$fileName = "";
		if( $_FILES['file']['name'] != "" )
		{
			$file = Input::file('file');
			$destinationPath = "media/receipt/". $userId . "/purchases/";
			
			$date = new DateTime();
		    	$filename =  "userid_".$userId."_" .$date->format('Y_m_d_H_i_s') .".". $file->getClientOriginalExtension();;
		    
			$file->move($destinationPath, $filename);
			echo($destinationPath . $filename);
			return;
		    $target_path = "Images/"; 
		    $name = $_FILES["file"]["name"];
		    $date = new DateTime();
		    $fileName =   $date->format('Y_m_d_H_i_s'). "_" . $name;
		
		    //$target_path = $target_path . $fileName;//basename( $_FILES['file']['name']);
		     
		    $pathToMove = "../basr/public/media/receipt/" . $userId . "/purchases";
		    
		    // check if folder is exist, if not create them
		    if (!file_exists($pathToMove)) {
		    	mkdir("../basr/public/media/receipt/" . $userId, 0755);
		    	mkdir($pathToMove, 0755);
		    }
		    
		    $pathToMove = $pathToMove . "/" . $fileName;    
		    if(move_uploaded_file($_FILES['file']['tmp_name'], $pathToMove)) {
		
		        //$host = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		        //$index = strrpos($host, "/");
		        // print_r($path); die();   
		        //$path = substr($host,0, $index )."/" ;
		        //$fileName = $path . $target_path ;
		        
		        
		        $fileName = "media/receipt/". $userId ."/purchases/" . $fileName;
		    } else{
		        $fileName = "";
		    }        
		}
		echo $fileName;
	 
	}
	
	////////////////// API Get Expenses by User Fromt Date to Date
	if ($requestType === "GetExpenseByDate")  
	{
		$userId     = Input::get('userId');
		$fromDate   = Input::get('from').' 00:00:00';
		$toDate     = Input::get('to').' 00:00:00';  
		      
		$expenses = DB::table('expenses')->where('user_id', '=', $userId)->where('created_at', '>=', $fromDate)->where('created_at', '<=', $toDate)->get();
//$query = "SELECT * FROM bsr_expenses WHERE user_id = $userId AND created_at = '$fromDate'";
//		$expenses = DB::select($query);
		//->whereBetween('created_at', array($fromDate, $toDate)) ->get();
			
//			echo $query . " count: " . count($expenses);
	            $this->echoResponse($expenses, 1, 0);		
			
			return;
			
		if(count($expenses) > 0) {
	            $this->echoResponse($expenses, 1, 0);		
		
		} else {
	            $this->echoResponse(array(), 1, 0);		
		}
	}



	//end function index
	}
    }

    