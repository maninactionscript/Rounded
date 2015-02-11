<?php

    class RecurringController extends BaseController {

        public function excute($recurring_id)
        {
            $recurring = Recurring::find($recurring_id); 
            $date = date('Y-m-d');
            $ultiDate = date('Y-m-d', strtotime($recurring->until_date));    
            if($recurring->until == 'date' && $date > $ultiDate){
                $recurring->delete();
                $recurring->removeJob();
                return null;
            }

            $expense = Expense::find($recurring->expense_id);
            $newExpense = $expense->replicate();
            $newExpense->updated_at = date('Y-m-d'); 
            $newExpense->recur_id = $recurring->expense_id; 
            $newExpense->save();
            return null;      
        }

    }
