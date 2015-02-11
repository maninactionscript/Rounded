<?php
    class Recurring extends Eloquent {
        protected $table = 'recurrings';
        public $timestamps = false;

        private function command()
        {
            $day = date('j', strtotime($this->expense_date));
            $month = date('n', strtotime($this->expense_date)); 
            switch($this->frequency) {
                case 'daily' :
                    $sch = '10 0 * * *';
                    break;
                case 'weekly' :
                    $sch = '10 0 */7 * *';
                    break;
                case 'two_weeks' :
                    $sch = '10 0 */14 * *';
                    break;
                case 'four_weeks' :
                    $sch = '10 0 */28 * *';
                    break;
                case 'monthly' :
                    $sch = '10 0 '.$day.' * *';
                    break;
                case 'two_months' :
                    $sch = '10 0 '.$day.' */2 *';
                    break;
                case 'six_months' :
                    $sch = '10 0 '.$day.' */6 *';
                    break;
                case 'yearly' :
                    $sch = '10 0 '.$day.' '.$month.' *';
                    break;
            }
            $exc = URL::to('cron/'.$this->id);
            $command =  $sch . " wget -O - " . $exc . " >/dev/null 2>&1\n";
            return $command; 
        }
        public function addJob()
        {

            $path = storage_path();
            $output = file_get_contents($path.'/cron.lock');
            $command = $this->command();
            $output .= $command;
            echo exec('crontab -r');
            file_put_contents($path.'/cron.lock', $output); 
            echo exec('crontab '.$path.'/cron.lock'); 
            return true;    
        }
        public function removeJob()
        {
            $path = storage_path();
            $output = file_get_contents($path.'/cron.lock');
            $command = $this->command();
            $output = str_replace($command,'',$output);
            echo exec('crontab -r');
            file_put_contents($path.'/cron.lock', $output); 
            echo exec('crontab '.$path.'/cron.lock'); 
            return true;   
        }
    }
