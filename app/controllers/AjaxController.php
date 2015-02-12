<?php

class AjaxController extends BaseController
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    public function quickSetup()
    {
        if (Request::ajax()) {
            $user = Auth::user();
            $setting = User::find($user->id)->businessDetail;
            if ($setting == NULL) {
                return 0;
            }
            return 1;
        }
    }

    private function saveSetting($data)
    {
        unset($data['_token']);
        unset($data['action']);
        $setting = BusinessDetail::where('user_id', '=', $data['user_id'])->get();
        if ($setting->count() > 0) {
            $res = new stdClass();
            $res->status = 0;
            $res->msg = '<label>Setting already existed !</label>';
            return Response::json($res);
        }
        $setting = new BusinessDetail();
        foreach ($data as $key => $value) {
            $setting->$key = $value;
        }
        $name = explode(' ', $setting->name);
        $setting->last_name = $name[1];
        $setting->first_name = $name[0];
        $setting->save();
        $res = new stdClass();
        $res->status = 1;
        $res->name = $setting->first_name;
        $res->fullname = $setting->name;
        $res->msg = '<label>Your setting has been saved !</label>';
        return Response::json($res);
    }

    public function saveBusinessDetail($data)
    {
        unset($data['_token']);
        unset($data['action']);
        if (isset($data['name'])) {
            $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        }
        $setting = $this->saveSettings($data);
        $name = explode(' ', $setting->name);
        $res = new stdClass();
        $res->status = 1;
        $res->name = $name[0];
        $res->fullname = $setting->name;
        $res->msg = '<label>Your setting has been saved !</label>';
        return Response::json($res);
    }

    public function saveInvoicing($data)
    {
        unset($data['_token']);
        unset($data['action']);
        $setting = InvoiceSetting::where('user_id', '=', $data['user_id'])->first();

        $setting = $setting == NULL ? new InvoiceSetting() : $setting;

        $publicpath = public_path();

        if ($data['logo'] != '') {
            $ext = explode('.', $data['logo']);
            $ext = end($ext);
            $filename = uniqid('logo_') . '.' . $ext;
            $logoPath = $publicpath . '/media/invoicing/' . $data['user_id'];
            if (!file_exists($logoPath)) {
                mkdir($logoPath, 0777);
            }
            @copy($publicpath . '/' . $data['logo'], $logoPath . '/' . $filename);
            @unlink($publicpath . '/' . $data['logo']);
            $data['logo'] = '/media/invoicing/' . $data['user_id'] . '/' . $filename;
        }
        if ($setting->logo != '' && file_exists($publicpath . $setting->logo)) {
            @unlink($publicpath . $setting->logo);
        }
        foreach ($data as $key => $value) {
            $setting->$key = $value;
        }
        $setting->footer = str_replace("\n", "<br />", $setting->footer);
        $setting->save();
        $res = new stdClass();
        $res->msg = '<label>Your setting has been saved !</label>';
        return Response::json($res);
    }

    public function saveGstSettings($data)
    {
        return $this->saveBusinessDetail($data);
    }

    public function saveReminders($data)
    {
        unset($data['_token']);
        unset($data['action']);
        $setting = Reminder::where('user_id', '=', $data['user_id'])->first();
        if ($setting == null) {
            $setting = new Reminder();
        }
        foreach ($data as $key => $value) {
            $setting->$key = $value;
        }
        $setting->save();
        $res = new stdClass();
        $res->msg = '<label>Your setting has been saved !</label>';
        return Response::json($res);
    }

    public function saveEmailTemplates($data)
    {
        unset($data['_token']);
        unset($data['action']);
        $setting = EmailTemplate::where('user_id', '=', $data['user_id'])->first();

        if ($setting == null) {
            $setting = new EmailTemplate();
        }
        foreach ($data as $key => $value) {
            $setting->$key = $value;
        }
        //echo "<pre>";var_dump($setting);die();
        $setting->save();
        $res = new stdClass();
        $res->msg = '<label>Your setting has been saved !</label>';
        return Response::json($res);
    }

    private function saveSettings($data)
    {
        $setting = BusinessDetail::where('user_id', '=', $data['user_id'])->first();
        if ($setting == null) {
            $setting = new BusinessDetail();
        }
        foreach ($data as $key => $value) {
            $setting->$key = $value;
        }
        $setting->save();
        return $setting;
    }

    private function saveChangeLoginDetail($data)
    {
        $user = User::find($data['user_id']);
        if ($user == null)
            return 'false';
        $newPassword = Hash::make($data['password']);
        $user->password = $newPassword;
        $user->email = $data['email'];
        $user->save();
        return 'true';
    }

    private function savePay($data)
    {
        $user = User::find($data['user_id']);
        $setting = $user->accountSetting;
        if ($setting == null)
            return 'false';
        $setting->credit_card = $data['credit_card'];
        $setting->sercurity_number = $data['sercurity_number'];
        $setting->expiry_date = $data['expiry_date'];
        $setting->status = 'paid';
        $setting->payment_date = date('Y-m-d');
        $setting->expires_date = date('Y-m-d', strtotime("+1 month"));
        $setting->save();
        return 'true';
    }

    private function saveGoal($data)
    {
        $goal = Goal::where('user_id', '=', $data['user_id'])->first();
        $goal = $goal == null ? new Goal() : $goal;
        $goal->user_id = $data['user_id'];
        $goal->month = $data['month'];
        $goal->quarter = $data['quarter'];
        $goal->financial_year = $data['financial_year'];
        $goal->save();
        $res = new stdClass();
        $res->msg = '<label>Your setting has been saved !</label>';
        return Response::json($res);
    }

    private function saveBankAccount($data)
    {
        unset($data['_token']);
        unset($data['action']);
        $id = $data['account_id'];
        $bank = ($id == 0 || $id == '0') ? new Bank() : Bank::find($id);
        $bank->account_name = $data['account_name'];
        $bank->user_id = $data['user_id'];
        $bank->save();
        $bank = Bank::find($bank->id);
        $data['bank'] = $bank;
        $addNew = ($id == 0 || $id == '0') ? true : false;
        $data['addNew'] = $addNew;
        return View::make('include.response.bank')->with($data);
    }

    private function saveAddWorkbook($data)
    {
        $ids = $data['id'];
        foreach ($ids as $id) {
            $expense = Expense::find($id);
            $newExpense = $expense->replicate();
            $newExpense->expense_area = 'workbook';
            $newExpense->parent_id = $expense->id;
            $newExpense->bank_id = 0;
            $newExpense->created_at = $expense->created_at;
            $newExpense->updated_at = $expense->updated_at;
            $newExpense->save();
        }
        $msg = count($ids) > 1 ?
            count($ids) . ' items have been added to workbook.' :
            count($ids) . ' item has been added to workbook.';
        return $msg;
    }

    private function saveClient($data)
    {
        unset($data['action']);
        unset($data['_token']);
        $data['sign'] = str_replace('"', '\'', $data['sign']);
        $addNew = $data['id'] == '0' ? true : false;
        $client = $addNew ? new Client() : Client::find($data['id']);
        foreach ($data as $key => $val) {
            $client->$key = $val;
        }
        $client->save();
        $data = array('client' => $client, 'addNew' => $addNew);
        $view = 'include.response.client';
        return View::make($view)->with($data);
    }

    private function duplicateInvoice($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice == null)
            return false;
        $prices = $invoice->prices;
        $dupInvoice = $invoice->replicate();


        $dupInvoice->save();
        if ($invoice->invoice != '' && file_exists(public_path($invoice->invoice))) {
            $newInvoice = '/media/invoices/' . $invoice->user_id . '/invoice_' . $dupInvoice->id . '_' . str_replace('-', '_', $dupInvoice->invoice_number) . '.pdf';
            copy(public_path($invoice->invoice), public_path($newInvoice));
            $dupInvoice->invoice = $newInvoice;
            $dupInvoice->save();
        }
        foreach ($prices as $p) {
            //echo "<pre>";var_dump($p);die();
            $pr = new Price();
            $pr->invoice_id = $dupInvoice->id;
            $pr->desc = $p->desc;
            $pr->quantity = $p->quantity;
            $pr->price = $p->price;
            $pr->inc_gst = $p->inc_gst;
            $pr->amount = $p->amount;
            $pr->save();
        }
        return true;
    }

    private function createPdf($id)
    {
        $user = Auth::user();
        $invoice = Invoice::find($id);
        if ($invoice == null)
            return false;
        $invoiceSetting = InvoiceSetting::where('user_id', '=', $user->id)->first();
        $pdfStore = public_path('/media/invoices/' . $user->id);
        $pdfPath = '/media/invoices/' . $invoice->user_id . '/invoice_' . $invoice->id . '_' . str_replace('-', '_', $invoice->invoice_number) . '.pdf';
        if (!file_exists($pdfStore))
            mkdir($pdfStore, 0777);

        $data['invoice'] = $invoice;
        $data['invoiceSetting'] = $invoiceSetting;
        //return View::make('include.invoiceDetail', $data);
        $pdf = PDF::loadView('include.invoiceDetail', $data);
        if (is_file(public_path($pdfPath))) {
            @unlink(public_path($pdfPath));
        }
        $pdf->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(public_path($pdfPath));
        $invoice->invoice = $pdfPath;
        $invoice->save();
        return URL::to($pdfPath);
    }

    private function saveSingleInvoice($data)
    {
        unset($data['action']);
        unset($data['_token']);
        $price = $data['price'];
        unset($data['price']);
        $method = $data['__save'];
        unset($data['__save']);
        $client = Client::find($data['client_id']);

        if (!isset($data['client_name'])) {
            $data['client_name'] = $client->business_name;
            $data['client_legal'] = $client->contact_name;
            $data['client_address'] = $client->address;
        }
        $order = $data['invoice_number'];
        $data['invoice_number'] = $client->invoice_prefix . '-' . $data['invoice_number'];

        $invoice = Invoice::find($data['id']);
        if ($invoice == null) {
            $invoice = new Invoice();
            $invoice->created_date = $invoice->updated_date = date('Y-m-d');
            $addNew = true;
        } else {
            $invoice->updated_date = date('Y-m-d');
            $addNew = false;
        }
        foreach ($data as $k => $v) {
            $invoice->{$k} = $v;
        }
        $invoice->paid = 0;
        $invoice->order = $order;
        $invoice->save();
        if ($invoice->id != null && $invoice->prices->count() > 0) {
            $query = Price::where('invoice_id', '=', $invoice->id)->delete();
        }

        foreach ($price as $p) {
            $pr = new Price();
            foreach ($p as $k => $v) {
                $pr->{$k} = $v;
            }
            $pr->invoice_id = $invoice->id;
            $pr->save();
        }
        if ($method == 'save_send') {
            //$pdf = $this->createPdf($invoice->id);
        }
        //$event = $addNew ? 'Created' : 'Invoice modified';
        //$his = new InvoiceHistory();
        //$his->setHistory($user->id, $event, $invoice->id);
        //}

        if ($method === 'duplicate') {
            $duplicate = $this->duplicateInvoice($invoice->id);
        }
        $res = new stdClass();
        $res->id = $invoice->id;
        $res->client = $invoice->client_id;
        $res->invoice = isset($pdf) ? $pdf : '';
        $res->method = $method;
        return Response::json($res);
    }

    private function saveInvoicePayment($data)
    {
        $income = new Expense();
        $income->amount = $data['amount'];
        $income->description = $data['note'];
        $income->created_at = $income->updated_at = $data['created_date'];
        $income->invoice_id = $data['invoice_id'];
        $income->type = 'income';
        $income->expense_area = 'workbook';
        $income->inc_gst = $data['inc_gst'];
        $income->gst = $income->inc_gst == '1' ? $data['gst'] : 0;
        $income->user_id = Auth::user()->id;
        $income->save();
        return Response::json($data);
    }

    private function sendInvoice($data)
    {

        $user = Auth::user();
        $invoice = Invoice::find($data['id']);

        $data['email_bcc'] = $user->email;
        $data['invoice_number'] = $invoice->invoice_number;
        if ($data['attach_invoice'] == '1') {
            $pdf = $this->createPdf($invoice->id);
            $data['invoice'] = str_replace(URL::to('/'), '', $pdf);
        }
        Mail::send('emails.default', $data, function ($message) use ($data) {
            $message->from('rounded.noreply@gmail.com', 'Rounded System');

            $message->subject($data['subject']);

            $message->to($data['email_to']);
            if ($data['bbc_me'] == '1') {
                $message->cc($data['email_bcc']);
            }
            if ($data['attach_invoice'] == '1') {
                $message->attach(public_path($data['invoice']), array('as' => $data['invoice_number']));
            }

        });
        $invoice->sent = 1;
        $invoice->save();
        return Response::json(array('status' => '200'));
    }

    public function invoiceAction()
    {
        $input = Input::all();
        switch ($input['action']) {
            case 'pdf' :
                $invoice = Invoice::find($input['id']);
                if ($invoice->invoice == '' || $invoice->invoice == null) {
                    $data['invoice'] = $this->createPdf($invoice->id);
                } else {
                    $data['invoice'] = URL::to($invoice->invoice);
                }
                $data['status'] = 1;
                break;
            case 'duplicate' :
                $r = $this->duplicateInvoice($input['id']);
                $data = [];
                break;
            case 'sendInvoice' :
                $r = $this->sendInvoice($input);
                $data = [];
                break;
            default :
                break;
        }
        return Response::json($data);
    }

    public function page()
    {
        if (Request::ajax()) {
            $input = Input::all();
            $func = 'load' . ucfirst($input['page']);

            if (method_exists($this, $func)) {
                return $this->$func($input);
            }
            return View::make('pages.404');
        }
    }

    private function loadexpenseReport($input)
    {

        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $financialYear = array();
        $thisYear = $this->financialYear(date('Y-m-d H:i:s'));
        $firstTime = Expense::where('user_id', '=', $user->id)->min('updated_at');
        if ($firstTime == NULL)
            $firstYear = $thisYear;
        else
            $firstYear = $this->financialYear($firstTime);

        $a = (int)$firstYear['end'];
        $b = (int)$thisYear['end'];
        $j = 0;
        for ($i = $a; $i <= $b; $i++) {
            $financialYear[$j]['start'] = $i - 1;
            $financialYear[$j]['end'] = $i;
            $j++;
        }
        $date[0] = $thisYear['start'] . '-07';
        $date[1] = $thisYear['end'] . '-06';
        $financialYear = array_reverse($financialYear);

        $category = Category::where('user_id', '=',0)
            ->orWhere('user_id', '=', $user->id)
            ->orderBy('id', 'asc')
            ->get();
        $data['category'] = $category;
        $data['financialYear'] = $financialYear;
        $data['user'] = $user;

        return View::make($view)->with($data);

    }


    private function loadDashBoard($input)
    {
        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $quarter = array(
            array('start' => '07', 'end' => '09'),
            array('start' => '10', 'end' => '12'),
            array('start' => '01', 'end' => '03'),
            array('start' => '04', 'end' => '06')
        );
        $month = date('m');
        foreach ($quarter as $i => $q) {
            if ($month >= $q['start'] && $month <= $q['end']) {
                $thisQuarter = $quarter[$i];
            }
        }
        $year = date('Y-');
        $query['quarter_income'] = Expense::where('user_id', '=', $user->id)->where('expense_area', '=', 'workbook');
        $query['quarter_income']->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $thisQuarter['start']);
        $query['quarter_income']->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $thisQuarter['end']);
        $data['quarter_income'] = $query['quarter_income']->where('type', '=', 'income')->select(DB::raw('SUM(amount*business_use/100) as value'))->get();
        $data['quarter_income'] = $data['quarter_income'][0]->value;

        $query['expense'] = Expense::where('user_id', '=', $user->id)->where('expense_area', '=', 'workbook');
        $query['expense']->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $thisQuarter['start']);
        $query['expense']->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $thisQuarter['end']);
        $data['expense'] = $query['expense']->where('type', '=', 'purchase')->select(DB::raw('SUM(amount*business_use/100) as value'))->get();
        $data['expense'] = $data['expense'][0]->value;

        $thisYear = date('Y');
        $thisMonth = date('m');
        if ($thisMonth < '07')
            $financialYear = array(
                'start' => date('Y', strtotime("-1 year")) . '-07',
                'end' => $thisYear . '-06',
            );
        else
            $financialYear = array(
                'start' => $thisYear . '-07',
                'end' => date('Y', strtotime("+1 year")) . '-06',
            );
        $query['final_income'] = Expense::where('user_id', '=', $user->id)->where('expense_area', '=', 'workbook');
        $query['final_income']->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $financialYear['start']);
        $query['final_income']->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $financialYear['end']);
        $data['final_income'] = $query['final_income']->where('type', '=', 'income')->select(DB::raw('SUM(amount*business_use/100) as value'))->get();
        $data['final_income'] = $data['final_income'][0]->value;

        $query['month_income'] = Expense::where('user_id', '=', $user->id)->where('expense_area', '=', 'workbook');
        $query['month_income']->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $year . $thisMonth);
        $data['month_income'] = $query['month_income']->where('type', '=', 'income')->select(DB::raw('SUM(amount*business_use/100) as value'))->get();
        $data['month_income'] = $data['month_income'][0]->value;

        $chart['date'] = 'this_financial_year';
        $chart['type'] = 'all';
        $a = $this->loadChart($chart);
        $data['chartData'] = $a->getContent();
        $data['user'] = $user;
        $data['goal'] = $user->goal == NULL ? new Goal() : $user->goal;

        $invoicesOut = Invoice::where('user_id', '=', $user->id)
            ->where('sent', '=', 1)->where('due_date', '>=', date('Y-m-d'))->get();
        $invoicesOve = Invoice::where('user_id', '=', $user->id)
            ->where('sent', '=', 1)->where('due_date', '<', date('Y-m-d'))->get();

        $data['outstanding'] = 0;
        foreach ($invoicesOut as $invoice) {
            $data['outstanding'] += $invoice->total - $invoice->getPaid();
        }
        $data['overdue'] = 0;
        foreach ($invoicesOve as $invoice) {
            $data['overdue'] += $invoice->total < $invoice->getPaid() ? 0 : $invoice->total - $invoice->getPaid();
        }
        return View::make($view)->with($data);
    }

    private function loadWorkbook($input)
    {
        $user = Auth::user();
        $view = $input['mode'] . '.' . $input['page'];
        $expense = Expense::where('user_id', '=', $user->id)->where('expense_area', '=', 'workbook');
       //  echo $view;die;
        /*$quarter = array(
        array('start' => '07', 'end' => '09'),
        array('start' => '10', 'end' => '12'),
        array('start' => '01', 'end' => '03'),
        array('start' => '04', 'end' => '06')
        );
        $month = date('m');
        foreach ($quarter as $i => $q) {
        if ($month >= $q['start'] && $month <= $q['end']) {
        $thisQuarter = $quarter[$i];
        }
        }
        $year = date('Y-');
        $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $thisQuarter['start']);
        $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $thisQuarter['end']);*/
        $data['expense'] = $expense->orderBy('updated_at', 'desc')->get();
        $data['user'] = $user;
        return View::make($view)->with($data);
    }

    private function loadBanking($input)
    {
        $user = Auth::user();
        $view = $input['mode'] . '.' . $input['page'];
        $banks = Bank::where('user_id', '=', $user->id)
            ->orderBy('id', 'asc')
            ->get();
        $data['banks'] = $banks;
        $data['user'] = $user;
        return View::make($view)->with($data);
    }

    private function loadClient($input)
    {
        $user = Auth::user();
        $view = $input['mode'] . '.' . $input['page'];
        $userIncome = $user->totalIncome();

        /* $query = 'SELECT c.* ,SUM(e.amount+e.gst) AS paid, '.
        ' (SELECT SUM(iv.total) FROM bsr_invoices AS iv WHERE iv.client_id = c.id AND iv.due_date < "'.date('Y-m-d').'" AND iv.sent=1) AS over_due,'.
        ' (SELECT SUM(iv.total) FROM bsr_invoices AS iv WHERE iv.client_id = c.id AND iv.due_date >= "'.date('Y-m-d').'" AND iv.sent=1) AS outstanding'.
        ' FROM bsr_clients AS c'.
        ' LEFT JOIN bsr_invoices AS i ON i.client_id = c.id'.
        ' LEFT JOIN bsr_expenses AS e ON e.invoice_id = i.id'.
        ' WHERE c.user_id = '.$user->id.
        ' GROUP BY i.client_id' ;
        $clients = DB::select(DB::raw($query));
        echo "<pre>";var_dump($clients);die(); */
        $clients = Client::where('user_id', '=', $user->id)->get();
        if ($clients->count() > 0) {
            for ($i = 0; $i < $clients->count(); $i++) {
                $invoicesOut = Invoice::where('client_id', '=', $clients[$i]->id)
                    ->where('sent', '=', 1)->where('due_date', '>=', date('Y-m-d'))->get();
                $invoicesOve = Invoice::where('client_id', '=', $clients[$i]->id)
                    ->where('sent', '=', 1)->where('due_date', '<', date('Y-m-d'))->get();
                $totalInvoice = 0;
                $totalPaid = 0;
                foreach ($invoicesOut as $invoice) {
                    $clients[$i]->outstanding += $invoice->total - $invoice->getPaid();
                }
                //$clients[$i]->outstanding = $totalInvoice-$totalPaid;
                $totalInvoice = 0;
                $totalPaid = 0;
                foreach ($invoicesOve as $invoice) {
                    $clients[$i]->overdue += $invoice->total < $invoice->getPaid() ? 0 : $invoice->total - $invoice->getPaid();
                }
                $clientIncome = $clients[$i]->totalIncome();
                $clients[$i]->income = $userIncome == 0 ? 0 : $clientIncome / $userIncome * 100;
            }
        }
        $data['clients'] = $clients;
        $data['user'] = $user;
        return View::make($view)->with($data);
    }

    private function loadGstSettings($input)
    {
        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $setting = BusinessDetail::where('user_id', '=', $user->id)->first();
        $data = array('setting' => $setting, 'user' => $user);
        return View::make($view)->with($data);
    }

    private function loadInvoicing($input)
    {
        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $setting = InvoiceSetting::where('user_id', '=', $user->id)->first();
        //echo "<pre>";var_dump($setting);die();
        $data = array('setting' => $setting, 'user' => $user);
        return View::make($view)->with($data);
    }

    private function loadReminders($input)
    {
        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $setting = Reminder::where('user_id', '=', $user->id)->first();
        $data = array('setting' => $setting, 'user' => $user);
        return View::make($view)->with($data);
    }

    private function loadBusinessDetail($input)
    {
        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $setting = BusinessDetail::where('user_id', '=', $user->id)->first();
        $data = array('setting' => $setting, 'user' => $user);
        return View::make($view)->with($data);
    }

    private function loadAccountSettings($input)
    {
        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $setting = AccountSetting::where('user_id', '=', $user->id)->first();
        $now = strtotime("now");
        $diff = strtotime($setting->expires_date . ' 23:59:59') - $now;
        $dayleft = floor($diff / 86400);
        $data = array('setting' => $setting, 'user' => $user, 'dayleft' => $dayleft);
        //echo "<pre>";var_dump($view);die();
        return View::make($view)->with($data);
    }

    private function loadEmailTemplates($input)
    {
        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $setting = EmailTemplate::where('user_id', '=', $user->id)->first();
        $setting = $setting == NULL ? new EmailTemplate() : $setting;
        $invoice = Invoice::where('user_id', '=', $user->id)->first();
        $client = Client::where('user_id', '=', $user->id)->first();
        $userSetting = BusinessDetail::where('user_id', '=', $user->id)->first();
        if ($invoice == null)
            $dueDays = '[INVOICE_DUE_DAYS]';
        else {
            $dueDays = ceil((strtotime($invoice->due_date . ' 00:0:00') - strtotime("now")) / 86400);
        }
        $mark = array('<span contenteditable="false">invoice number</b>' => 'RDN-001',
            '<span contenteditable="false">your full name</span>' => 'Jonh Smith',
            '<span contenteditable="false">your business name</span>' => 'Rounded',
            '<span contenteditable="false">invoice due date</span>' => date('M jS,Y', strtotime('+7 days')),
            '<span contenteditable="false">invoice due days</span>' => 7,
            '<span contenteditable="false">payment amount</span>' => '$7000',
            '<span contenteditable="false">client name</span>' => 'Rounded');

        $preview = new stdClass();
        $preview->invoice_subject = $setting->invoice_subject;
        $preview->invoice_content = $setting->invoice_content;
        $preview->reminder_subject = $setting->reminder_subject;
        $preview->reminder_content = $setting->reminder_content;
        // echo preg_replace('/\<img[a-z0-9]*>$/','[image]',$preview->invoice_content) ;die;
        // echo "<pre>";var_dump(str_replace('<span contenteditable="false">invoice number</span>', 'RDN-001', '<span contenteditable="false">invoice number</span>'));die();
        foreach ($mark as $key => $value) {
            $preview->invoice_subject = str_replace($key, $value, $preview->invoice_subject);
            $preview->invoice_content = str_replace($key, $value, $preview->invoice_content);
            $preview->reminder_subject = str_replace($key, $value, $preview->reminder_subject);
            $preview->reminder_content = str_replace($key, $value, $preview->reminder_content);
        }
        //echo "<pre>";var_dump($preview);die();
        $data = array('setting' => $setting, 'preview' => $preview, 'user' => $user);
        return View::make($view)->with($data);
    }

    private function loadInvoices($input)
    {
        $view = $input['mode'] . '.' . $input['page'];
        $user = Auth::user();
        $invoices = Invoice::where('user_id', '=', $user->id)->get();
        $clients = Client::where('user_id', '=', $user->id)->get();
        $data = array('invoices' => $invoices, 'clients' => $clients, 'user' => $user);
        return View::make($view)->with($data);
    }

    public function invoices()
    {
        $user = Auth::user();
        $input = Input::all();
        $invoices = null;
        switch ($input['type']) {
            case 'current' :
                $results = Invoice::where('user_id', '=', $user->id)->get();
                $invoices = [];
                foreach ($results as $invoice) {
                    if (($invoice->getPaid() < $invoice->total) || $invoice->sent == '0') {
                        $invoices[] = $invoice;
                    }
                }
                break;
            case 'paid' :
                $results = Invoice::where('user_id', '=', $user->id)->where('sent', '=', 1)->get();
                $invoices = [];
                foreach ($results as $invoice) {
                    if ($invoice->getPaid() >= $invoice->total) {
                        $invoices[] = $invoice;
                    }
                }
                break;
            case 'custom' :
                $q = Invoice::where('user_id', '=', $user->id);
                if (isset($input['from_date']) && $input['from_date'] != '') {
                    $q->where('updated_date', '>=', $input['from_date']);
                }
                if (isset($input['to_date']) && $input['from_date'] != '') {
                    $q->where('updated_date', '<=', $input['to_date']);
                }

                if ($input['state'] == 'created') {
                    $q->where('sent', '=', 1);
                } else {
                    $q->where('sent', '=', 0);
                }
                if (isset($input['client']) && $input['client'] !== '') {
                    $q->where('client_id', '=', $input['client']);
                }

                $invoices = $q->get();
                break;
            default :
                break;
        }
        $data = array('invoices' => $invoices, 'user' => $user);
        $view = 'include.invoices';
        return View::make($view)->with($data);
    }

    public function loadInvoice()
    {
        $input = Input::all();
        $user = Auth::user();
        $invoiceSetting = InvoiceSetting::where('user_id', '=', $user->id)->first();
        $invoiceSetting = $invoiceSetting == NULL ? new InvoiceSetting() : $invoiceSetting;

        $client = Client::find($input['client']);
        //echo "<pre>";var_dump($input['client']);die();

        $invoice = Invoice::find($input['id']);

        if ($invoice == null) {
            $invoice = new Invoice();
        } else {
            $client = $invoice->client;
        }
        if ($client == null) {
            $client = $user->clients;
            $invoiceNumber = '';
        } else if ($invoice->id == null) {
            $lastInvoive = Invoice::where('client_id', '=', $input['client'])->orderBy('id', 'desc')->first();
            $invoiceNumber = $lastInvoive === null ? $client->invoice_prefix . '-' . '001' : $client->invoice_prefix . '-' . sprintf('%03s', ($lastInvoive->order + 1));
        } else {
            $invoiceNumber = $invoice->invoice_number;
        }
        $businessDetal = $user->businessDetail == NULL ? new BusinessDetail() : $user->businessDetail;
        $data = array('invoiceSetting' => $invoiceSetting,
            'user' => $user,
            'businessDetal' => $businessDetal,
            'client' => $client,
            'invoiceNumber' => $invoiceNumber,
            'invoice' => $invoice);

        $view = !isset($client->id) ? 'pages.invoice' : 'pages.invoiceWithClient';
        if (isset($input['page']) && $input['page'] == 'detail') {
            $view = 'pages.invoiceDetails';
        }
        return View::make($view)->with($data);
    }

    private function loadReport($input)
    {
        $user = Auth::user();
        $view = $input['mode'] . '.' . $input['page'];
        $thisYear = $this->financialYear(date('Y-m-d H:i:s'));
        $firstTime = Expense::where('user_id', '=', $user->id)->min('updated_at');
        if ($firstTime == NULL)
            $firstYear = $thisYear;
        else
            $firstYear = $this->financialYear($firstTime);
        //echo "<pre>";var_dump($firstYear);die();

        $a = (int)$firstYear['end'];
        $b = (int)$thisYear['end'];
        //echo "<pre>";var_dump($a);die();
        $j = 0;
        for ($i = $a; $i <= $b; $i++) {
            $financialYear[$j]['start'] = $i - 1;
            $financialYear[$j]['end'] = $i;
            $j++;
        }
        $date[0] = $thisYear['start'] . '-07';
        $date[1] = $thisYear['end'] . '-06';
        $varibles = array(
            'totalSales' => array('type' => 'income', 'inc_gst' => false, 'field' => 'amount*business_use/100'),
            'totalSalesIncGST' => array('type' => 'income', 'inc_gst' => '1', 'field' => 'amount'),
            'totalSalesNoGST' => array('type' => 'income', 'inc_gst' => '0', 'field' => 'amount'),
            'totalSalesGST' => array('type' => 'income', 'inc_gst' => false, 'field' => 'gst'),
            'totalPurchases' => array('type' => 'purchase', 'inc_gst' => false, 'field' => 'amount'),
            'totalPurchasesIncGST' => array('type' => 'purchase', 'inc_gst' => '1', 'field' => 'amount'),
            'totalPurchasesNoGST' => array('type' => 'purchase', 'inc_gst' => '0', 'field' => 'amount'),
            'totalPurchasesGST' => array('type' => 'purchase', 'inc_gst' => false, 'field' => 'gst'),
        );
        foreach ($varibles as $key => $value) {
            $query[$key] = DB::table('expenses')->where('user_id', '=', $user->id)->where('expense_area', '=', 'workbook');
            $query[$key]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $date[0]);
            $query[$key]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $date[1]);
            $query[$key]->where('type', '=', $value['type']);
            if ($value['inc_gst'] !== false)
                $query[$key]->where('inc_gst', '=', $value['inc_gst']);
            $result = $query[$key]->select(DB::raw('SUM(' . $value['field'] . '*business_use/100) as value'))->get();
            $report[$key] = $result[0]->value;
        }
        if ($report['totalSalesGST'] >= $report['totalPurchasesGST']) {
            $report['taxOffice'] = $report['totalSalesGST'] - $report['totalPurchasesGST'];
            $report['taxTitle'] = 'You owe the tax office:';
        } else {
            $report['taxOffice'] = $report['totalPurchasesGST'] - $report['totalSalesGST'];
            $report['taxTitle'] = 'Tax office owe from you :';
        }
        $financialYear = array_reverse($financialYear);
        $data = array(
            'report' => $report,
            'financialYear' => $financialYear,
            'user' => $user
        );
        return View::make($view)->with($data);
    }

    public function generateReport()
    {
        $user = Auth::user();
        $input = Input::all();
        $year = explode('-', $input['year']);
        $period = $input['period'];
        if ($period == '') {
            $date[0] = $year[0] . '-07';
            $date[1] = $year[1] . '-06';
        } else {
            if ($period == '07-09' || $period == '10-12') {
                $year = $year[0];
            }
            if ($period == '01-03' || $period == '04-06') {
                $year = $year[1];
            }
            $period = explode('-', $period);
            $date[0] = $year . '-' . $period[0];
            $date[1] = $year . '-' . $period[1];
        }
        $varibles = array(
            'totalSales' => array('type' => 'income', 'inc_gst' => false, 'field' => 'amount'),
            'totalSalesIncGST' => array('type' => 'income', 'inc_gst' => '1', 'field' => 'amount'),
            'totalSalesNoGST' => array('type' => 'income', 'inc_gst' => '0', 'field' => 'amount'),
            'totalSalesGST' => array('type' => 'income', 'inc_gst' => false, 'field' => 'gst'),
            'capPurchases' => array('type' => 'purchase', 'inc_gst' => false, 'field' => 'amount', 'expense_type' => 2),
            'noncapPurchases' => array('type' => 'purchase', 'inc_gst' => false, 'field' => 'amount', 'expense_type' => 1),
            'totalPurchases' => array('type' => 'purchase', 'inc_gst' => false, 'field' => 'amount'),
            'totalPurchasesIncGST' => array('type' => 'purchase', 'inc_gst' => '1', 'field' => 'amount'),
            'totalPurchasesNoGST' => array('type' => 'purchase', 'inc_gst' => '0', 'field' => 'amount'),
            'totalPurchasesGST' => array('type' => 'purchase', 'inc_gst' => false, 'field' => 'gst'),
        );
        foreach ($varibles as $key => $value) {
            $query[$key] = DB::table('expenses')->where('user_id', '=', $user->id)->where('expense_area', '=', 'workbook');
            $query[$key]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $date[0]);
            $query[$key]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $date[1]);
            $query[$key]->where('type', '=', $value['type']);
            if ($value['inc_gst'] !== false)
                $query[$key]->where('inc_gst', '=', $value['inc_gst']);
            if (isset($value['expense_type']))
                $query[$key]->where('expense_type', '=', $value['expense_type']);
            $result = $query[$key]->select(DB::raw('SUM(' . $value['field'] . '*business_use/100) as value'))->get();
            $report[$key] = $result[0]->value;
        }
        if ($report['totalSalesGST'] >= $report['totalPurchasesGST']) {
            $report['taxOffice'] = $report['totalSalesGST'] - $report['totalPurchasesGST'];
            $report['taxTitle'] = 'You owe the tax office:';
        } else {
            $report['taxOffice'] = $report['totalPurchasesGST'] - $report['totalSalesGST'];
            $report['taxTitle'] = 'Tax office owe from you :';
        }
        $data = array('report' => $report, 'user' => $user);
        return View::make('include.response.generatebas')->with($data);
    }



    public function expenseReport()
    {

        $user = Auth::user();
        $input = Input::all();


        $quarter = array(
            array('start' => '07', 'end' => '09'),
            array('start' => '10', 'end' => '12'),
            array('start' => '01', 'end' => '03'),
            array('start' => '04', 'end' => '06')
        );

        $category = $input['category'];
        $expenseData = array();
        $timeReport = '';
        if ($category == 'all') {

            $categoryArr = Category::where('user_id', '=', '0')
                ->orWhere('user_id', '=', $user->id)
                ->orderBy('id', 'asc')
                ->get();
			
			
			$uncategorized = new stdClass();
			$uncategorized->id = 0;
			$uncategorized->title = 'Uncategorized';
			$categoryArr[0] = $uncategorized;
			
            if (!empty($categoryArr)) {
                foreach ($categoryArr as $key => $categoryItem) {
					if($key=== 0){
						$expenseData[0]['expense'] = DB::table('expenses')
                        ->where('category_id', '=', '')
						->orWhere('category_id', '=', null);
						
					} else {
						$expenseData[$categoryItem->id]['expense'] = DB::table('expenses')
                        ->where('category_id', '=', $categoryItem->id);
						
					}
                    $expenseInside =   $expenseData[$categoryItem->id]['expense'] ;
                    // start switch case
                    if (isset($input['date']) && $input['date'] != '' && $input['date'] != 'all') {
                        $date = $input['date'];
                        switch ($date) {
                            case 'custom' :
                                $fromDate = date('Y-m-d',strtotime($input['from_date']));
                                $toDate = date('Y-m-d',strtotime($input['to_date']));
                                ($toDate == '1970-01-01')? $toDate = date('Y-m-d',time()) : $toDate = $toDate;
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '>=', $fromDate);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '<=', $toDate);
                                $timeReport =   date('d M, Y',strtotime($fromDate)).' to '.date('d M, Y',strtotime($toDate));
                                break;
                            case 'this_month' :
                                $month = date('Y-m');
                                $monthS = date('m');

                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $month);
                                $timeReport =  date('d M, Y',strtotime($month)) .' to '. date('d M, Y',strtotime($month.'-'.totalDayOfMonth($monthS)));
                                break;
                            case 'last_month' :
                                $month = date('Y-m', strtotime('-1 month'));
                                $monthS = date('m', strtotime('-1 month'));

                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $month);
                                $timeReport = date('d M, Y',strtotime($month)).' to '. date('d M, Y',strtotime($month.'-'.totalDayOfMonth($monthS)));
                                break;
                            case 'this_quarter' :
                                $month = date('m');
                                foreach ($quarter as $i => $q) {
                                    if ($month >= $q['start'] && $month <= $q['end']) {
                                        $thisQuarter = $quarter[$i];
                                    }
                                }
                                $year = date('Y-');
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $thisQuarter['start']);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $thisQuarter['end']);
                                $timeReport = date('d M, Y',strtotime($year . $thisQuarter['start'])) . ' to '.date('d M, Y',strtotime($year . $thisQuarter['end'].'-31' ));
                                break;
                            case 'last_quarter' :
                                $month = date('m');
                                foreach ($quarter as $i => $q) {
                                    if ($month >= $q['start'] && $month <= $q['end']) {
                                        $thisQuarter = $quarter[$i];
                                        break;
                                    }
                                }
                                if ($i == 0)
                                    $i = 3;
                                else
                                    $i = $i - 1;
                                $lastQuater = $quarter[$i];
                                $year = date('Y')-1;
                                $year = $year.'-';
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $lastQuater['start']);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $lastQuater['end']);

                                $timeReport = date('d M, Y',strtotime($year . $lastQuater['start'] )). ' to '.date('d M, Y',strtotime($year . $lastQuater['end'].'-31')) ;

                                break;
                            case 'this_financial_year' :
                                $thisYear = date('Y');
                                $thisMonth = date('m');
                                if ($thisMonth < '07')
                                    $financialYear = array(
                                        'start' => date('Y', strtotime("-1 year")) . '-07',
                                        'end' => $thisYear . '-06',
                                    );
                                else
                                    $financialYear = array(
                                        'start' => $thisYear . '-07',
                                        'end' => date('Y', strtotime("+1 year")) . '-06',
                                    );
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $financialYear['start']);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $financialYear['end']);
                                $timeReport =  date('d M, Y',strtotime($financialYear['start'])). ' to '.date('d M, Y',strtotime($financialYear['end'].'-30')) ;
                                break;
                            case 'last_financial_year' :
                                $thisYear = date('Y');
                                $thisMonth = date('m');
                                if ($thisMonth < '07')
                                    $financialYear = array(
                                        'start' => date('Y', strtotime("-2 years")) . '-07',
                                        'end' => date('Y', strtotime("-1 year")) . '-06',
                                    );
                                else
                                    $financialYear = array(
                                        'start' => date('Y', strtotime("-1 year")) . '-07',
                                        'end' => date('Y', strtotime("-0 years")) . '-06',
                                    );
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $financialYear['start']);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $financialYear['end']);
                                $timeReport = date('d M, Y',strtotime($financialYear['start'])). ' to '.date('d M, Y',strtotime($financialYear['end'].'-30')) ;
                                break;
                            case 'this_year' :
                                $thisYear = date('Y');
                              //  $lastYear = date('Y',strtotime("-1 year")).'-01-30' ;
                                $expenseInside->where(DB::raw('YEAR(updated_at)'), '=', $thisYear);
                                $timeReport = date('d M, Y',strtotime($thisYear.'-01-01')) . ' to '.date('d M, Y',strtotime($thisYear.'-12-31')) ;
                                break;
                            case 'last_year' :
                                $lastYear = date('Y', strtotime("-1 year"));
                                $expenseInside->where(DB::raw('YEAR(updated_at)'), '=', $lastYear);
                                $timeReport = date('d M, Y',strtotime($lastYear.'-01-01')).' to '.date('d M, Y',strtotime($lastYear.'-12-31')) ;
                                break;
                            default :
                                break;
                        }
                    }

//                    $expenseData[$categoryItem->id]['expense'] = $expenseData[$categoryItem->id]['expense']->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $from)
//                        ->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $to)
                    $expenseData[$categoryItem->id]['expense'] = $expenseInside->orderBy('updated_at', 'desc')->get();
                    $expenseData[$categoryItem->id]['title'] = $categoryItem->title;

                }
            }

        } else {
			
			if($category == ''){
				$uncategorized = new stdClass();
				$uncategorized->id = 0;
				$uncategorized->title = 'Uncategorized';
				$categoryArr[0] = $uncategorized;
			} else {
				$categoryArr = Category::where('id','=',$category)->get() ;
			}
            if (!empty($categoryArr)) {
                foreach ($categoryArr as $key => $categoryItem) {
					if($key=== 0){
						$expenseData[$categoryItem->id]['expense'] = DB::table('expenses')
                        ->where('category_id', '=', '')
						->orWhere('category_id', '=', null);
						
					} else {
						$expenseData[$categoryItem->id]['expense'] = DB::table('expenses')
                        ->where('category_id', '=', $categoryItem->id);
						
					}
                    $expenseInside =  $expenseData[$categoryItem->id]['expense'];
                    // start switch case
                    if (isset($input['date']) && $input['date'] != '' && $input['date'] != 'all') {
                        $date = $input['date'];
                        switch ($date) {
                            case 'custom' :
                                $fromDate = date('Y-m-d',strtotime($input['from_date']));
                                $toDate = date('Y-m-d',strtotime($input['to_date']));
                                ($toDate == '1970-01-01')? $toDate = date('Y-m-d',time()) : $toDate = $toDate;
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '>=', $fromDate);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '<=', $toDate);
                                $timeReport =   date('d M, Y',strtotime($fromDate)).' to '.date('d M, Y',strtotime($toDate));
                                break;
                            case 'this_month' :
                                $month = date('Y-m');
                                $monthS = date('m');

                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $month);
                                $timeReport =  date('d M, Y',strtotime($month)) .' to '. date('d M, Y',strtotime($month.'-'.totalDayOfMonth($monthS)));
                                break;
                            case 'last_month' :
                                $month = date('Y-m', strtotime('-1 month'));
                                $monthS = date('m', strtotime('-1 month'));

                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $month);
                                $timeReport = date('d M, Y',strtotime($month)).' to '. date('d M, Y',strtotime($month.'-'.totalDayOfMonth($monthS)));
                                break;
                            case 'this_quarter' :
                                $month = date('m');
                                foreach ($quarter as $i => $q) {
                                    if ($month >= $q['start'] && $month <= $q['end']) {
                                        $thisQuarter = $quarter[$i];
                                    }
                                }
                                $year = date('Y-');
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $thisQuarter['start']);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $thisQuarter['end']);
                                $timeReport = date('d M, Y',strtotime($year . $thisQuarter['start'])) . ' to '.date('d M, Y',strtotime($year . $thisQuarter['end'].'-31' ));
                                break;
                            case 'last_quarter' :
                                $month = date('m');
                                foreach ($quarter as $i => $q) {
                                    if ($month >= $q['start'] && $month <= $q['end']) {
                                        $thisQuarter = $quarter[$i];
                                        break;
                                    }
                                }
                                if ($i == 0)
                                    $i = 3;
                                else
                                    $i = $i - 1;
                                $lastQuater = $quarter[$i];
                                $year = date('Y')-1;
                                $year = $year.'-';
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $lastQuater['start']);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $lastQuater['end']);

                                $timeReport = date('d M, Y',strtotime($year . $lastQuater['start'] )). ' to '.date('d M, Y',strtotime($year . $lastQuater['end'].'-31')) ;

                                break;
                            case 'this_financial_year' :
                                $thisYear = date('Y');
                                $thisMonth = date('m');
                                if ($thisMonth < '07')
                                    $financialYear = array(
                                        'start' => date('Y', strtotime("-1 year")) . '-07',
                                        'end' => $thisYear . '-06',
                                    );
                                else
                                    $financialYear = array(
                                        'start' => $thisYear . '-07',
                                        'end' => date('Y', strtotime("+1 year")) . '-06',
                                    );
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $financialYear['start']);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $financialYear['end']);
                                $timeReport =  date('d M, Y',strtotime($financialYear['start'])). ' to '.date('d M, Y',strtotime($financialYear['end'].'-30')) ;
                                break;
                            case 'last_financial_year' :
                                $thisYear = date('Y');
                                $thisMonth = date('m');
                                if ($thisMonth < '07')
                                    $financialYear = array(
                                        'start' => date('Y', strtotime("-2 years")) . '-07',
                                        'end' => date('Y', strtotime("-1 year")) . '-06',
                                    );
                                else
                                    $financialYear = array(
                                        'start' => date('Y', strtotime("-1 year")) . '-07',
                                        'end' => date('Y', strtotime("-0 years")) . '-06',
                                    );
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $financialYear['start']);
                                $expenseInside->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $financialYear['end']);
                                $timeReport = date('d M, Y',strtotime($financialYear['start'])). ' to '.date('d M, Y',strtotime($financialYear['end'].'-30')) ;
                                break;
                            case 'this_year' :
                                $thisYear = date('Y');
                                //  $lastYear = date('Y',strtotime("-1 year")).'-01-30' ;
                                $expenseInside->where(DB::raw('YEAR(updated_at)'), '=', $thisYear);
                                $timeReport = date('d M, Y',strtotime($thisYear.'-01-01')) . ' to '.date('d M, Y',strtotime($thisYear.'-12-31')) ;
                                break;
                            case 'last_year' :
                                $lastYear = date('Y', strtotime("-1 year"));
                                $expenseInside->where(DB::raw('YEAR(updated_at)'), '=', $lastYear);
                                $timeReport = date('d M, Y',strtotime($lastYear.'-01-01')).' to '.date('d M, Y',strtotime($lastYear.'-12-31')) ;
                                break;
                            default :
                                break;
                        }
                    }
                    $expenseData[$categoryItem->id]['expense']  =   $expenseInside->orderBy('updated_at', 'desc')->get();
                    $expenseData[$categoryItem->id]['title'] = $categoryItem->title;
                }
            }
        }

   //     $timeReport =  date('M d, y',strtotime($from)).' - '.date('M d, y',strtotime($to));

        $data = array(
            'expense' => $expenseData,
            'user' => $user,
            'timeReport' => $timeReport
        );
        return View::make('include.response.expenseReport')->with($data);

    }


    public function expense()
    {
        $user = Auth::user();
        $input = Input::all();
        $expense = Expense::where('user_id', '=', $user->id);

        $quarter = array(
            array('start' => '07', 'end' => '09'),
            array('start' => '10', 'end' => '12'),
            array('start' => '01', 'end' => '03'),
            array('start' => '04', 'end' => '06')
        );
        if (isset($input['type']) && $input['type'] != '' && $input['type'] != 'all') {
            $type = $input['type'];
            $expense->where('type', '=', $type);
        }
        if (isset($input['desc']) && $input['desc'] != '') {
            $desc = $input['desc'];
            $expense->where('description', 'like', '%' . $desc . '%');
        }
        if (isset($input['bank_id'])) {
            $expense->where('bank_id', '=', $input['bank_id']);
        }
        $expense->where('expense_area', '=', $input['area']);
        if (isset($input['date']) && $input['date'] != '' && $input['date'] != 'all') {
            $date = $input['date'];
            switch ($date) {
                case 'custom' :
                    $fromDate = $input['from_date'];
                    $toDate = $input['to_date'];
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '>=', $fromDate);
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '<=', $toDate);
                    break;
                case 'this_month' :
                    $month = date('Y-m');
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $month);
                    break;
                case 'last_month' :
                    $month = date('Y-m', strtotime('-1 month'));
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $month);
                    break;
                case 'this_quarter' :
                    $month = date('m');
                    foreach ($quarter as $i => $q) {
                        if ($month >= $q['start'] && $month <= $q['end']) {
                            $thisQuarter = $quarter[$i];
                        }
                    }
                    $year = date('Y-');
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $thisQuarter['start']);
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $thisQuarter['end']);
                    break;
                case 'last_quarter' :
                    $month = date('m');
                    foreach ($quarter as $i => $q) {
                        if ($month >= $q['start'] && $month <= $q['end']) {
                            $thisQuarter = $quarter[$i];
                            break;
                        }
                    }
                    if ($i == 0)
                        $i = 3;
                    else
                        $i = $i - 1;
                    $lastQuater = $quarter[$i];
                    $year = date('Y-');
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $year . $lastQuater['start']);
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $year . $lastQuater['end']);
                    break;
                case 'this_financial_year' :
                    $thisYear = date('Y');
                    $thisMonth = date('m');
                    if ($thisMonth < '07')
                        $financialYear = array(
                            'start' => date('Y', strtotime("-1 year")) . '-07',
                            'end' => $thisYear . '-06',
                        );
                    else
                        $financialYear = array(
                            'start' => $thisYear . '-07',
                            'end' => date('Y', strtotime("+1 year")) . '-06',
                        );
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $financialYear['start']);
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $financialYear['end']);
                    break;
                case 'last_financial_year' :
                    $thisYear = date('Y');
                    $thisMonth = date('m');
                    if ($thisMonth < '07')
                        $financialYear = array(
                            'start' => date('Y', strtotime("-2 years")) . '-07',
                            'end' => date('Y', strtotime("-1 year")) . '-06',
                        );
                    else
                        $financialYear = array(
                            'start' => date('Y', strtotime("-1 year")) . '-07',
                            'end' => date('Y', strtotime("-0 years")) . '-06',
                        );
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '>=', $financialYear['start']);
                    $expense->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '<=', $financialYear['end']);
                    break;
                case 'this_year' :
                    $thisYear = date('Y');
                    $expense->where(DB::raw('YEAR(updated_at)'), '=', $thisYear);
                    break;
                case 'last_year' :
                    $lastYear = date('Y', strtotime("-1 year"));
                    $expense->where(DB::raw('YEAR(updated_at)'), '=', $lastYear);
                    break;
                default :
                    break;
            }
        }
        $expense->orderBy('updated_at', 'desc');
        $expense->orderBy('id', 'desc');
        $data['expense'] = $expense->get();
        $data['type'] = $input['type'];
        $data['area'] = $input['area'];
        return View::make('include.expense')->with($data);
    }

    private function loadIncome($input)
    {
        $user = Auth::user();
        $view = $input['mode'] . '.ajax.' . $input['page'];
        $data = array();
        if ($input['quarter'] != '') {
            $quarter = explode('-', $input['quarter']);
            $sq = sprintf('%02d', $quarter[0]);
            $eq = sprintf('%02d', $quarter[1]);
            $data['expense'] = Expense::where('user_id', '=', $user->id)
                ->where('type', '=', $input['page'])
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $data['expense'] = Expense::where('user_id', '=', $user->id)
                ->where('type', '=', $input['page'])
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        return View::make($view)->with($data);
    }

    private function loadPurchase($input)
    {
        $user = Auth::user();
        $view = $input['mode'] . '.ajax.' . $input['page'];
        $data = array();
        if ($input['quarter'] != '') {
            $quarter = explode('-', $input['quarter']);
            $sq = sprintf('%02d', $quarter[0]);
            $eq = sprintf('%02d', $quarter[1]);
            $data['expense'] = Expense::where('user_id', '=', $user->id)
                ->where('type', '=', $input['page'])
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['receipt'] = Expense::where('user_id', '=', $user->id)
                ->where('type', '=', 'receipt')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $data['expense'] = Expense::where('user_id', '=', $user->id)
                ->where('type', '=', $input['page'])
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['receipt'] = Expense::where('user_id', '=', $user->id)
                ->where('type', '=', 'receipt')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->orderBy('updated_at', 'desc')
                ->get();
        }
        return View::make($view)->with($data);
    }

    private function loadGeneratebas($input)
    {
        $user = Auth::user();
        $view = $input['mode'] . '.ajax.' . $input['page'];

        if ($input['quarter'] != '') {
            $quarter = explode('-', $input['quarter']);
            $sq = sprintf('%02d', $quarter[0]);
            $eq = sprintf('%02d', $quarter[1]);
            $totalSales = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'income')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->sum('amount');
            $totalSalesIncGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'income')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->where('inc_gst', '=', 1)
                ->sum('amount');
            $totalSalesNoGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'income')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->where('inc_gst', '=', 0)
                ->sum('amount');
            $totalSalesGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'income')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->where('inc_gst', '=', 1)
                ->sum('gst');

            $totalPurchases = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'purchase')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->sum('amount');
            $totalPurchasesIncGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'purchase')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->where('inc_gst', '=', 1)
                ->sum('amount');
            $totalPurchasesNoGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'purchase')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->where('inc_gst', '=', 0)
                ->sum('amount');
            $totalPurchasesGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'purchase')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where(DB::raw('MONTH(updated_at)'), '>=', $sq)
                ->where(DB::raw('MONTH(updated_at)'), '<=', $eq)
                ->where('inc_gst', '=', 1)
                ->sum('gst');
        } else {
            $totalSales = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'income')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->sum('amount');
            $totalSalesIncGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'income')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where('inc_gst', '=', 1)
                ->sum('amount');
            $totalSalesNoGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'income')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where('inc_gst', '=', 0)
                ->sum('amount');
            $totalSalesGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'income')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where('inc_gst', '=', 1)
                ->sum('gst');

            $totalPurchases = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'purchase')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->sum('amount');
            $totalPurchasesIncGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'purchase')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where('inc_gst', '=', 1)
                ->sum('amount');
            $totalPurchasesNoGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'purchase')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where('inc_gst', '=', 0)
                ->sum('amount');
            $totalPurchasesGST = DB::table('expenses')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'purchase')
                ->where(DB::raw('YEAR(updated_at)'), '=', $input['year'])
                ->where('inc_gst', '=', 1)
                ->sum('gst');
        }

        if ($totalSalesGST >= $totalPurchasesGST) {
            $taxOffice = $totalSalesGST - $totalPurchasesGST;
            $taxTitle = 'You owe the tax office:';
        } else {
            $taxOffice = $totalPurchasesGST - $totalSalesGST;
            $taxTitle = 'Tax office owe from you :';
        }


        $data = array('totalSales' => $totalSales,
            'totalSalesIncGST' => $totalSalesIncGST,
            'totalSalesNoGST' => $totalSalesNoGST,
            'totalSalesGST' => $totalSalesGST,
            'totalPurchases' => $totalPurchases,
            'totalPurchasesIncGST' => $totalPurchasesIncGST,
            'totalPurchasesNoGST' => $totalPurchasesNoGST,
            'totalPurchasesGST' => $totalPurchasesGST,
            'taxOffice' => $taxOffice,
            'taxTitle' => $taxTitle
        );
        return View::make($view)->with($data);
    }

    public function form()
    {
        if (Request::ajax()) {
            $input = Input::all();
            $id = isset($input['id']) ? $input['id'] : 0;
            $user = Auth::user();
            switch ($input['form']) {
                case 'client' :
                    $client = Client::find($id);
                    if (!$client)
                        $client = new Client();
                    $data['client'] = $client;
                    break;
                case 'sendInvoice' :
                case 'sendReminder' :
                case 'sendThankYou' :
                    $invoice = Invoice::find($id);
                    $client = Client::find($invoice->client_id);
                    $mailTmpl = EmailTemplate::where('user_id', '=', $invoice->user_id)->first();
                    if ($mailTmpl == null) {
                        $mailTmpl = new EmailTemplate();
                    }
                    $userSetting = BusinessDetail::where('user_id', '=', $invoice->user_id)->first();
                    if ($invoice == null)
                        $dueDays = '[INVOICE_DUE_DAYS]';
                    else {
                        $dueDays = ceil((strtotime($invoice->due_date . ' 00:0:00') - strtotime("now")) / 86400);
                    }

                    $mark = array('<span contenteditable="false">invoice number</span>' => $invoice == null ? '[INVOICE_NUMBER]' : $invoice->invoice_number,
                        '<span contenteditable="false">your full name</span>' => $userSetting->first_name . ' ' . $userSetting->last_name == '' ? '[YOUR_FULL_NAME]' : $userSetting->first_name . ' ' . $userSetting->last_name,
                        '<span contenteditable="false">your business name</span>' => $userSetting->business_name == '' ? '[YOUR_BUSINESS_NAME]' : $userSetting->business_name,
                        '<span contenteditable="false">invoice due date</span>' => $invoice == null ? '[INVOICE_DUE_DATE]' : date('M jS,Y', strtotime($invoice->due_date)),
                        '<span contenteditable="false">invoice due days</span>' => $dueDays,
                        '<span contenteditable="false">payment amount</span>' => $invoice == null ? '$[PAYMENT_AMOUNT]' : '$' . $invoice->total,
                        '<span contenteditable="false">client name</span>' => $client == null ? '[CLIENT_NAME]' : $client->business_name);
                    $preview = new stdClass();
                    $preview->invoice_subject = str_replace("<br>", "\n", $mailTmpl->invoice_subject);
                    $preview->invoice_content = str_replace("<br>", "\n", $mailTmpl->invoice_content);
                    $preview->reminder_subject = str_replace("<br>", "\n", $mailTmpl->reminder_subject);
                    $preview->reminder_content = str_replace("<br>", "\n", $mailTmpl->reminder_content);;
                    foreach ($mark as $key => $value) {
                        $preview->invoice_subject = str_replace($key, $value, $preview->invoice_subject);
                        $preview->invoice_content = str_replace($key, $value, $preview->invoice_content);
                        $preview->reminder_subject = str_replace($key, $value, $preview->reminder_subject);
                        $preview->reminder_content = str_replace($key, $value, $preview->reminder_content);
                    }
                    $data['invoice'] = $invoice;
                    $data['client'] = $client;
                    $data['mailTmpl'] = $mailTmpl;
                    $data['preview'] = $preview;
                    break;
                case 'goal' :
                    $goal = Goal::where('user_id', '=', $user->id)->first();
                    if ($goal == null) {
                        $goal = new Goal();
                    }
                    $data['goal'] = $goal;
                    break;
                default :
                    $categories = Category::where('user_id', '=', '0')
                        ->orWhere('user_id', '=', $user->id)
                        ->orderBy('id', 'desc')
                        ->get();
                    $expense = Expense::find($id);
                    if (!$expense)
                        $expense = new Expense();
                    elseif ($input['form'] != 'receipt' && $input['form'] != 'merge')
                        $input['form'] = $expense->type;
                    $lastImport = NULL;
                    $bank = NULL;
                    $bankID = 0;
                    if ($input['form'] == 'import' || isset($input['bank_id'])) {
                        $bankID = $input['bank_id'];
                        $bank = Bank::find($bankID);
                        $lastImport = $bank->lastImport;
                    }
                    $invoices = Invoice::where('user_id', '=', $user->id)
                        ->where('sent', '=', 1)->get();
                    $busDetail = BusinessDetail::where('user_id', '=', $user->id)->first();
                    $data = array('categories' => $categories,
                        'expense' => $expense,
                        'lastImport' => $lastImport,
                        'bankID' => $bankID,
                        'bank' => $bank,
                        'invoices' => $invoices,
                        'busDetail' => $busDetail,
                    );
                    break;
            }

            $view = 'include.modal.' . $input['form'];
            return View::make($view)->with($data);
        }
    }

    public function save()
    {
        if (Request::ajax()) {
            $input = Input::all();
            $user = Auth::user();
            $input['user_id'] = $user->id;
            $func = 'save' . ucfirst($input['action']);
            return $this->$func($input);
        }
    }

    public function delete()
    {
        if (Request::ajax()) {
            $input = Input::all();
            $user = Auth::user();
            $input['user_id'] = $user->id;
            $func = 'delete' . ucfirst($input['action']);
            return $this->$func($input);
        }
    }

    public function clear()
    {
        if (Request::ajax()) {
            $input = Input::all();
            $publicPath = public_path();
            switch ($input['type']) {
                case 'file' :
                    unlink($publicPath . '/' . $input['file']);
                    break;
                default :
                    break;
            }
            return 1;
        }
    }

    public function import()
    {
        if (Request::ajax()) {
            $publicPath = public_path();
            $input = Input::all();
            $user = Auth::user();
            $data = readQIF($publicPath . '/' . $input['file']);
            $imported = array();
            $countTransactions = 0;
            foreach ($data as $i => $da) {
                if ($i == 0) {
                    $minDate = $maxDate = $da['date'];
                } else {
                    $minDate = $da['date'] < $minDate ? $da['date'] : $minDate;
                    $maxDate = $da['date'] > $maxDate ? $da['date'] : $maxDate;
                }
                $type = isset($da['type']) ? $da['type'] : false;
                if ($type) {
                    if ($input[$type] == '1') {
                        $expense = new Expense();
                        $expense->created_at = $expense->updated_at = $da['date'];
                        $expense->amount = (float)$da['amount'];
                        $expense->description = $da['description'];
                        $expense->type = $da['type'];
                        if ($input['inc_gst'] == '1') {
                            $expense->gst = $expense->amount / 11;
                            $expense->inc_gst = 1;
                        }
                        $expense->bank_id = $input['bank_id'];
                        $expense->expense_area = 'banking';
                        $expense->user_id = $user->id;
                        $expense->save();
                        $countTransactions++;
                    }
                }
            }
            unlink($publicPath . '/' . $input['file']);
            $import = new Import();
            $import->transactions = $countTransactions;
            $import->imported_from = $minDate;
            $import->imported_to = $maxDate;
            $import->bank_id = $input['bank_id'];
            $import->save();
            $response = new stdClass();
            $response->transactions = $countTransactions;
            $response->info = 'Last transactions imported from ' . date('j F, Y', strtotime($import->imported_from)) . ' to ' . date('j F, Y', strtotime($import->imported_to));
            return Response::json($response);
        }
    }

    public function upload()
    {
        if (Request::ajax()) {
            $file = Input::file('file');
            if ($file->getError() > 0) {
                $return->error = $file->getError();
                return json_encode($return);
            }
            $type = Input::get('type');
            $ext = $file->getClientOriginalExtension();
            if ($type == 'tmp') {
                $sid = Session::getId();
                $filename = 'tmp_' . $sid . str_replace('.', '_', microtime(true)) . '.' . $ext;
                $path = 'tmp/' . $filename;
            }
            $file->move(public_path('tmp'), $filename);

            $return = new stdClass();
            $return->error = 0;
            $return->filename = $filename;
            $return->path = $path;
            $return->extension = strtolower($file->getClientOriginalExtension());
            return json_encode($return);
        }
    }

    private function saveExpense($data)
    {
        unset($data['_token']);
        unset($data['action']);
        $p_attachment = '';
        if (isset($data['p_attachment'])) {
            $p_attachment = $data['p_attachment'];
            unset($data['p_attachment']);
        }
        $recurringExpense = array('recurring_expense' => '', 'frequency' => '', 'until' => '', 'until_date' => '');
        foreach ($recurringExpense as $key => $value) {
            if (isset($data[$key]))
                $recurringExpense[$key] = $data[$key];
            unset($data[$key]);
        }
        $addNew = $data['id'] == '0' ? true : false;
        $expense = Expense::find($data['id']);
        if (!$expense) {
            $expense = new Expense();
        }

        foreach ($data as $key => $value) {
            $expense->$key = $value;
        }
        $expense->expense_area = 'workbook';

        $expense->save();

        if (isset($data['attachment']) && $data['attachment'] != '') {
            $publicpath = public_path();
            $ext = explode('.', $data['attachment']);
            $ext = end($ext);
            $filename = 'purchase_' . $expense->id . '.' . $ext;
            $userPath = $publicpath . '/media/receipt/' . $data['user_id'];
            if (!file_exists($userPath)) {
                mkdir($userPath, 0777);
            }
            $purchasePath = $userPath . '/purchases';
            if (!file_exists($purchasePath)) {
                mkdir($purchasePath, 0777);
            }

            copy($publicpath . '/' . $data['attachment'], $purchasePath . '/' . $filename);
            unlink($publicpath . '/' . $data['attachment']);
            $expense->attachment = 'media/receipt/' . $data['user_id'] . '/purchases/' . $filename;
            $expense->save();
        } else {
            $expense->attachment = $p_attachment != '' ? $p_attachment : '';
            $expense->save();
        }
        if (!$addNew) {
            $recurring = $expense->recurring;
            if ($recurring != null) {
                $recurring->delete();
                $recurring->removeJob();
            }
            if ($expense->recur_id != 0 && $recurringExpense['recurring_expense'] == '1') {
                $orgExpense = Expense::find($expense->recur_id);
                $orgRecurring = $orgExpense->recurring;
                if ($orgRecurring != null) {
                    $orgRecurring->delete();
                    $orgRecurring->removeJob();
                }
                $query = Expense::where('user_id', '=', $data['user_id'])
                    ->where('recur_id', '=', $expense->recur_id)
                    ->update(array('recur_id' => 0));
            }
        }
        if ($recurringExpense['recurring_expense'] == '1') {
            $recurring = new Recurring();
            $recurring->expense_id = $expense->id;
            $recurring->expense_date = $expense->updated_at;
            $recurring->frequency = $recurringExpense['frequency'];
            $recurring->until = $recurringExpense['until'];
            $recurring->until_date = $recurringExpense['until_date'];
            $a = $recurring->save();
            $recurring->addJob();
        }
        $expense = Expense::find($expense->id);
        $data = array('expense' => $expense, 'addNew' => $addNew);
        $view = 'include.response.expense';
        return View::make($view)->with($data);
    }

    private function deleteInvoice($data)
    {
        $invoice = Invoice::find($data['id']);
        if ($invoice != null) {
            if (file_exists(public_path() . $invoice->invoice) && is_file(public_path() . $invoice->invoice))
                @unlink(public_path('/') . $invoice->invoice);
            $invoice->hasMany('Price')->delete();
            $invoice->delete();
            $expenses = Expense::where('invoice_id', '=', $data['id'])->get();
            if ($expenses != null) {
                foreach ($expenses as $expense) {
                    $expense->delete();
                }
            }
        }
        return 'true';
    }

    private function deleteExpense($data)
    {
        if (!is_array($data['id']))
            $data['id'] = array($data['id']);
        $publicPath = public_path();
        foreach ($data['id'] as $id) {
            $expense = Expense::find($id);

            if ($expense) {
                if (isset($expense->attachment) && $expense->attachment != '' && is_file($publicPath . '/' . $expense->attachment)) {
                    unlink($publicPath . '/' . $expense->attachment);
                }
                $recurring = $expense->recurring;
                if ($recurring != null) {
                    $recurring->delete();
                    $recurring->removeJob();
                }
                $invoice = Invoice::find($expense->invoice_id);
                if ($invoice != null) {
                    $invoice->paid = 0;
                    $invoice->save();
                }
                $expense->delete();
            }
        }
        return 'true';
    }

    private function deleteGst($data)
    {
        $ids = $data['id'];
        foreach ($data['id'] as $id) {
            $expense = Expense::find($id);
            $expense->gst = 0;
            $expense->inc_gst = 0;
            $expense->save();
        }
        return 'true';
    }

    private function deleteReceipt($data)
    {
        $publicPath = public_path();
        $expense = Expense::find($data['id']);
        if ($expense) {
            if (is_file($publicPath . '/' . $expense->attachment)) {
                unlink($publicPath . '/' . $expense->attachment);
            }
            $expense->attachment = NULL;
            $expense->save();
        }
        return 'true';
    }

    private function deleteBankAccount($data)
    {
        $id = $data['id'];
        $bank = Bank::find($id);
        $query = Expense::where('bank_id', '=', $id)->where('expense_area', 'banking')->delete();
        $query = Import::where('bank_id', '=', $id)->delete();
        $bank->delete();
        return 'true';
    }

    private function deleteClient($data)
    {
        $client = Client::find($data['id']);
        if ($client) {
            $client->delete();
        }
        return 'true';
    }

    public function deleteAll()
    {
        $input = Input::all();
        $type = $input['type'];
        Expense::where('type', '=', $type)->delete();
        return 'true';
    }

    private function saveChangeCategory($data)
    {
        $categoryID = $data['categorise_select_id'];
        $ids = $data['id'];
        foreach ($ids as $id) {
            $expense = Expense::find($id);
            $expense->category_id = $categoryID;
            $expense->save();
        }
        $category = Category::find($categoryID);
        $response['id'] = $category->id;
        $response['title'] = $category->title;
        return Response::json($response);
    }

    private function saveCategory($data)
    {
        $title = $data['category_title'];
        $userID = $data['user_id'];
        $category = new Category();
        $category->title = $title;
        $category->user_id = $userID;
        $category->save();

        $option = '<option selected="selected" value="' . $category->id . '">' . $category->title . '</option>';
        return $option;
    }

    private function saveMerge($data)
    {
        $mergedID = $data['merged_id'];
        $deleteID = $data['delete_id'];
        $mergedExpense = Expense::find($mergedID);
        $deleteExpense = Expense::find($deleteID);
        $mergedExpense->description = $data['description'] !== '' ? $data['description'] : ($mergedExpense->description ? $mergedExpense->description : $deleteExpense->description);
        $mergedExpense->attachment = $mergedExpense->attachment ? $mergedExpense->attachment : $deleteExpense->attachment;
        $mergedExpense->save();
        $deleteExpense->delete();
        $data = array('expense' => $mergedExpense, 'addNew' => false);
        $view = 'include.response.expense';
        return View::make($view)->with($data);
    }

    private function financialYear($date)
    {
        $thisYear = date('Y', strtotime($date));

        $thisMonth = date('m', strtotime($date));

        if ($thisMonth < '07')
            $financialYear = array(
                'start' => date('Y', strtotime("-1 year", strtotime($date))),
                'end' => $thisYear,
            );
        else
            $financialYear = array(
                'start' => $thisYear,
                'end' => date('Y', strtotime("+1 year", strtotime($date))),
            );
        return $financialYear;
    }

    public function loadChart($input)
    {
        $user = Auth::user();
        //$input = Input::all();
        $quarter = array(
            array('start' => '07', 'end' => '09'),
            array('start' => '10', 'end' => '12'),
            array('start' => '01', 'end' => '03'),
            array('start' => '04', 'end' => '06')
        );

        if (isset($input['date']) && $input['date'] != '') {
            $date = $input['date'];
            switch ($date) {
                case 'custom' :
                    $fromDate = $input['from_date'];
                    $toDate = $input['to_date'];
                    $diff = strtotime($toDate) - strtotime($fromDate);
                    $days = $diff / 86400;
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    for ($i = 0; $i <= $days; $i++) {
                        $d = $i > 1 ? '+' . $i . ' days' : '+' . $i . ' day';
                        $labels[] = date('j M, y', strtotime($d, strtotime($fromDate)));
                        $wd = date('Y-m-d', strtotime($d, strtotime($fromDate)));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '=', $wd);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '=', $wd);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                case 'this_month' :
                    $prevMonth = date('Y-m-', strtotime('+1 month'));
                    $toDate = date('Y-m-d', strtotime('-1 day', strtotime($prevMonth . '01')));
                    $fromDate = date('Y-m-01');
                    $diff = strtotime($toDate) - strtotime($fromDate);
                    $days = $diff / 86400;
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    for ($i = 0; $i <= $days; $i++) {
                        $d = $i > 1 ? '+' . $i . ' days' : '+' . $i . ' day';
                        $labels[] = date('j M, y', strtotime($d, strtotime($fromDate)));
                        $wd = date('Y-m-d', strtotime($d, strtotime($fromDate)));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '=', $wd);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '=', $wd);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                case 'last_month' :
                    $prevMonth = date('Y-m-', strtotime('now'));
                    $toDate = date('Y-m-d', strtotime('-1 day', strtotime($prevMonth . '01')));
                    $fromDate = date('Y-m-01', strtotime('-1 month'));
                    $diff = strtotime($toDate) - strtotime($fromDate);
                    $days = $diff / 86400;
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    for ($i = 0; $i <= $days; $i++) {
                        $d = $i > 1 ? '+' . $i . ' days' : '+' . $i . ' day';
                        $labels[] = date('j M, y', strtotime($d, strtotime($fromDate)));
                        $wd = date('Y-m-d', strtotime($d, strtotime($fromDate)));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '=', $wd);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m-%d")'), '=', $wd);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                    break;
                case 'this_quarter' :
                    $month = date('m');
                    foreach ($quarter as $i => $q) {
                        if ($month >= $q['start'] && $month <= $q['end']) {
                            $thisQuarter = $quarter[$i];
                        }
                    }
                    $months = (int)$thisQuarter['end'] - (int)$thisQuarter['start'];
                    $month = date('Y-' . $thisQuarter['start'] . '-d');
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    for ($i = 0; $i <= $months; $i++) {
                        $d = $i > 1 ? '+' . $i . ' months' : '+' . $i . ' month';
                        $labels[] = date('M y', strtotime($d, strtotime($month)));
                        $wm = date('Y-m', strtotime($d, strtotime($month)));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wm);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wm);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                case 'last_quarter' :
                    $month = date('m');
                    foreach ($quarter as $i => $q) {
                        if ($month >= $q['start'] && $month <= $q['end']) {
                            $thisQuarter = $quarter[$i];
                            break;
                        }
                    }
                    if ($i == 0)
                        $i = 3;
                    else
                        $i = $i - 1;
                    $lastQuater = $quarter[$i];
                    $months = (int)$lastQuater['end'] - (int)$lastQuater['start'];
                    $month = date('Y-' . $lastQuater['start'] . '-d');
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    for ($i = 0; $i <= $months; $i++) {
                        $d = $i > 1 ? '+' . $i . ' months' : '+' . $i . ' month';
                        $labels[] = date('M y', strtotime($d, strtotime($month)));
                        $wm = date('Y-m', strtotime($d, strtotime($month)));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wm);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wm);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                case 'this_financial_year' :
                case 'all' :
                    $thisYear = date('Y');
                    $thisMonth = date('m');
                    if ($thisMonth < '07')
                        $financialYear = array(
                            'start' => date('Y', strtotime("-1 year")) . '-07',
                            'end' => $thisYear . '-06',
                        );
                    else
                        $financialYear = array(
                            'start' => $thisYear . '-07',
                            'end' => date('Y', strtotime("+1 year")) . '-06',
                        );
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    $max = 0;
                    for ($i = 0; $i < 12; $i++) {
                        $d = $i > 1 ? '+' . $i . ' months' : '+' . $i . ' month';
                        $labels[] = date('M y', strtotime($d, strtotime($financialYear['start'])));
                        $wy = date('Y-m', strtotime($d, strtotime($financialYear['start'])));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wy);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wy);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        // set Max value
                        $tmpMax = $expense['data'][$i] > $income['data'][$i] ? $expense['data'][$i] : $income['data'][$i];
                        $max = $max > $tmpMax ? $max : $tmpMax;

                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                case 'last_financial_year' :
                    $thisYear = date('Y');
                    $thisMonth = date('m');
                    if ($thisMonth < '07')
                        $financialYear = array(
                            'start' => date('Y', strtotime("-2 years")) . '-07',
                            'end' => date('Y', strtotime("-1 year")) . '-06',
                        );
                    else
                        $financialYear = array(
                            'start' => date('Y', strtotime("-1 year")) . '-07',
                            'end' => date('Y', strtotime("-0 years")) . '-06',
                        );
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    for ($i = 0; $i < 12; $i++) {
                        $d = $i > 1 ? '+' . $i . ' months' : '+' . $i . ' month';
                        $labels[] = date('M y', strtotime($d, strtotime($financialYear['start'])));

                        $wy = date('Y-m', strtotime($d, strtotime($financialYear['start'])));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wy);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wy);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                case 'this_year' :
                    $thisYear = date('Y-01-01');
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    for ($i = 0; $i < 12; $i++) {
                        $d = $i > 1 ? '+' . $i . ' months' : '+' . $i . ' month';
                        $labels[] = date('M y', strtotime($d, strtotime($thisYear)));
                        $wy = date('Y-m', strtotime($d, strtotime($thisYear)));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wy);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wy);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                case 'last_year' :
                    $lastYear = date('Y-01-01', strtotime("-1 year"));
                    $income['total'] = 0;
                    $expense['total'] = 0;
                    for ($i = 0; $i < 12; $i++) {
                        $d = $i > 1 ? '+' . $i . ' months' : '+' . $i . ' month';
                        $labels[] = date('M y', strtotime($d, strtotime($lastYear)));
                        $wy = date('Y-m', strtotime($d, strtotime($lastYear)));
                        $inc[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'income');
                        $exp[$i] = Expense::where('user_id', '=', $user->id)
                            ->where('expense_area', '=', 'workbook')
                            ->where('type', '=', 'purchase');
                        $inc[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wy);
                        $exp[$i]->where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $wy);
                        $incomeAmount = $inc[$i]->sum('amount');
                        $income['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'income') ? $incomeAmount : 0;
                        $income['total'] += $income['data'][$i];
                        $expenseAmount = $exp[$i]->sum('amount');
                        $expense['data'][$i] = ($input['type'] == 'all' || $input['type'] == 'purchase') ? $expenseAmount : 0;
                        $expense['total'] += $expense['data'][$i];
                    }
                    break;
                default :
                    break;
            }
        }
        $empty = 1;
        foreach ($income['data'] as $in) {
            if ($in > 0) {
                $empty = 0;
                break;
            }
        }
        foreach ($expense['data'] as $in) {
            if ($in > 0) {
                $empty = 0;
                break;
            }
        }
        $response = new stdClass();
        $response->labels = $labels;
        $response->income = $income;
        $response->expense = $expense;
        $response->empty = $empty;
        $response->max = $max;
        return Response::json($response);
    }

    public function getClient()
    {
        $input = Input::all();
        $client = Client::find($input['id']);
        $order = $client->getInvoiceOrder();
        $client->invoice_number = sprintf('%03s', $order);
        return Response::json($client->getAttributes());
    }


    //start modify
    private function loadCategory()
    {
        $user = Auth::user();
        $categories = DB::table('categories')
            ->where('user_id', '=', $user->id)
            ->get();

        $data = array(
            'categories' => $categories,
            'type' => 'Categories',
            'user' => $user
        );
        $input = Input::all();
        $view = $input['mode'] . '.' . $input['page'];

        return View::make($view)->with($data);
    }
    //end modify

    //modify action
    public function renameCategory()
    {
        //update category
        $input = Input::all();
        DB::table('categories')
            ->where('id', $input['id'])
            ->update(array('title' => $input['title']));
        return Response::json(array(
            'code' => 1
        ));
    }

    public function deleteCategory()
    {
        $input = Input::all();
        DB::table('categories')->where('id', '=', $input['id'])->delete();
        return Response::json(array(
            'code' => 1
        ));
    }
    //end modify action

    //add new cat
    public function addNewCategory()
    {
        $input = Input::all();
        $user = Auth::user();
        $id = DB::table('categories')->insertGetId(
            array('title' => $input['title'], 'user_id' => $user->id)
        );
        return Response::json(array(
            'code' => 1,
            'id' => $id
        ));
    }

    public function changeDate(){
        $input = Input::all();
        $user = Auth::user();

        $quarter = array(
            array('start' => '07', 'end' => '09'),
            array('start' => '10', 'end' => '12'),
            array('start' => '01', 'end' => '03'),
            array('start' => '04', 'end' => '06')
        );
        if (isset($input['date']) && $input['date'] != '' && $input['date'] != 'all') {
            $date = $input['date'];
            switch ($date) {
                case 'custom' :
                    $from = '';
                    $to = '';
                   // ($toDate == '1970-01-01')? $toDate = date('Y-m-d',time()) : $toDate = $toDate;

                 //   $timeReport =   date('d M, Y',strtotime($fromDate)).' to '.date('d M, Y',strtotime($toDate));
                    break;
                case 'this_month' :
                    $month = date('Y-m');
                    $monthS = date('m');
                   $from =    date('d M, Y',strtotime($month));
                    $to =  date('d M, Y',strtotime($month.'-'.totalDayOfMonth($monthS)));
                    $timeReport =  date('d M, Y',strtotime($month)) .' to '. date('d M, Y',strtotime($month.'-'.totalDayOfMonth($monthS)));
                    break;
                case 'last_month' :
                    $month = date('Y-m', strtotime('-1 month'));
                    $monthS = date('m', strtotime('-1 month'));
                    $from =   date('d M, Y',strtotime($month));
                    $to = date('d M, Y',strtotime($month.'-'.totalDayOfMonth($monthS)));
                    $timeReport = date('d M, Y',strtotime($month)).' to '. date('d M, Y',strtotime($month.'-'.totalDayOfMonth($monthS)));
                    break;
                case 'this_quarter' :
                    $month = date('m');
                    foreach ($quarter as $i => $q) {
                        if ($month >= $q['start'] && $month <= $q['end']) {
                            $thisQuarter = $quarter[$i];
                        }
                    }
                    $year = date('Y-');
                    $from  = date('d M, Y',strtotime($year . $thisQuarter['start']));
                    $to =   date('d M, Y',strtotime($year . $thisQuarter['end'].'-31' ));
                    $timeReport = date('d M, Y',strtotime($year . $thisQuarter['start'])) . ' to '.date('d M, Y',strtotime($year . $thisQuarter['end'].'-31' ));
                    break;
                case 'last_quarter' :
                    $month = date('m');
                    foreach ($quarter as $i => $q) {
                        if ($month >= $q['start'] && $month <= $q['end']) {
                            $thisQuarter = $quarter[$i];
                            break;
                        }
                    }
                    if ($i == 0)
                        $i = 3;
                    else
                        $i = $i - 1;
                    $lastQuater = $quarter[$i];
                    $year = date('Y')-1;
                    $year = $year.'-';
                    $from =  date('d M, Y',strtotime($year . $lastQuater['start'] ));
                    $to =   date('d M, Y',strtotime($year . $lastQuater['end'].'-31'));
//                    $timeReport = date('d M, Y',strtotime($year . $lastQuater['start'] )). ' to '.date('d M, Y',strtotime($year . $lastQuater['end'].'-31')) ;

                    break;
                case 'this_financial_year' :
                    $thisYear = date('Y');
                    $thisMonth = date('m');
                    if ($thisMonth < '07')
                        $financialYear = array(
                            'start' => date('Y', strtotime("-1 year")) . '-07',
                            'end' => $thisYear . '-06',
                        );
                    else
                        $financialYear = array(
                            'start' => $thisYear . '-07',
                            'end' => date('Y', strtotime("+1 year")) . '-06',
                        );
                    $from =     date('d M, Y',strtotime($financialYear['start']));
                    $to =   date('d M, Y',strtotime($financialYear['end'].'-30'));
                    $timeReport =  date('d M, Y',strtotime($financialYear['start'])). ' to '.date('d M, Y',strtotime($financialYear['end'].'-30')) ;
                    break;
                case 'last_financial_year' :
                    $thisYear = date('Y');
                    $thisMonth = date('m');
                    if ($thisMonth < '07')
                        $financialYear = array(
                            'start' => date('Y', strtotime("-2 years")) . '-07',
                            'end' => date('Y', strtotime("-1 year")) . '-06',
                        );
                    else
                        $financialYear = array(
                            'start' => date('Y', strtotime("-1 year")) . '-07',
                            'end' => date('Y', strtotime("-0 years")) . '-06',
                        );
                    $from =   date('d M, Y',strtotime($financialYear['start']));
                     $to = date('d M, Y',strtotime($financialYear['end'].'-30'));
                    $timeReport = date('d M, Y',strtotime($financialYear['start'])). ' to '.date('d M, Y',strtotime($financialYear['end'].'-30')) ;
                    break;
                case 'this_year' :
                    $thisYear = date('Y');
                    //  $lastYear = date('Y',strtotime("-1 year")).'-01-30' ;
                    $from =  date('d M, Y',strtotime($thisYear.'-01-01'));
                    $to =   date('d M, Y',strtotime($thisYear.'-12-31'));
                    $timeReport = date('d M, Y',strtotime($thisYear.'-01-01')) . ' to '.date('d M, Y',strtotime($thisYear.'-12-31')) ;
                    break;
                case 'last_year' :
                    $lastYear = date('Y', strtotime("-1 year"));
                    $from =    date('d M, Y',strtotime($lastYear.'-01-01'));
                    $to = date('d M, Y',strtotime($lastYear.'-12-31'));
                    $timeReport = date('d M, Y',strtotime($lastYear.'-01-01')).' to '.date('d M, Y',strtotime($lastYear.'-12-31')) ;

                    break;
                default :
                    break;
            }
        }

        return Response::json(array(
            'from' => $from,
            'to' => $to
        ));
    }

}
