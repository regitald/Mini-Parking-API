<?php

namespace App\Http\Controllers\Parking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralServices;
use App\Models\ParkingTransactionModel;
use Session;
use Carbon\Carbon;

class ParkingController extends Controller
{
    use GeneralServices;

	public function index(Request $request){
		$data['title'] = 'Parking Management';
        $data['data'] = ParkingTransactionModel::where('status',"ongoing")->orderBy('id','DESC')->get();
        $data['today_data'] = ParkingTransactionModel::whereDate('checkin_time', Carbon::today())->where('status',"completed")->count();
        $data['total_data'] = ParkingTransactionModel::where('status',"completed")->count();

		return view('admin.transaction.view',$data);
	}
    public function checkIn(Request $request){
        $rules = [
            'plate_number' => 'required|string'
        ];
        $validateData = $this->ValidateRequest($request->all(), $rules);

        if (!empty($validateData)) {
            return redirect()->back()->withErrors($validateData);
        }
        $checkData = ParkingTransactionModel::where('plate_number',$request->plate_number)->where('trx_code',$request->trx_code)->first();
        if(!empty($checkData)){
            return redirect()->back()->withErrors(['Failed! This car already inside, Please fill the form checkout if you want to checkout the car!']);  
        }

        $postData['plate_number'] = $request->plate_number;
        $postData['user_id'] = Session::get('Users.id');
        $postData['trx_code'] = $request->trx_code;
        $postData['checkin_time'] = date('Y-m-d H:i:s');
        $save = ParkingTransactionModel::create($postData);
        if(!$save){
            return redirect()->back()->withErrors(['Failed! Server Error!']);  
        } 
        return redirect('/admin/manage-parking')->with('success', "Car Successfully check-in");
	}
    public function checkout(Request $request){
        $rules = [
            'trx_code' => 'required|string'
        ];
        $validateData = $this->ValidateRequest($request->all(), $rules);

        if (!empty($validateData)) {
            return redirect()->back()->withErrors($validateData);
        }
        $checkData = ParkingTransactionModel::where('trx_code',$request->trx_code)->first();
        if(empty($checkData)){
            return redirect()->back()->withErrors(['Failed! Invalid Code']);  
        }
        // ====== start of calculation price total based on time
        $enddate = date('Y-m-d H:i:s');
        $startTime = Carbon::parse($checkData->checkin_time);
        $finishTime = Carbon::parse($enddate);  

        $totalDuration = $startTime->diffInMinutes($finishTime);
        $totalPrice = ($totalDuration / 60)*3000;
        // ====== end of calculation price total based on time
        
        $postData['price_total'] = $totalPrice;
        $postData['status'] = "completed";
        $postData['checkout_time'] = $enddate;
        $save = ParkingTransactionModel::where('trx_code',$request->trx_code)->update($postData);
        if(!$save){
            return redirect()->back()->withErrors(['Failed! Server Error!']);  
        } 
        return redirect('/admin/manage-parking')->with('success', "Car Successfully check-in");
	}

    public function report(Request $request){
		$data['title'] = 'Parking Management History';
        $query = ParkingTransactionModel::where('status',"!=","ongoing")->orderBy('id','DESC');

        //start code for filtering
        if(!empty($request->start_date) && empty($request->end_date)){
            $query->whereDate('checkin_time', date('Y-m-d H:i:s', strtotime($request->start_date)));
        }
        elseif(empty($request->start_date) && !empty($request->end_date)){
            $query->whereDate('checkout_time', date('Y-m-d H:i:s', strtotime($request->end_date)));
        }
        elseif(!empty($request->start_date) && !empty($request->end_date)){
            $query->whereDate('checkin_time','>=', $request->start_date)->whereDate('checkout_time','<=', $request->end_date);
        }

        //end code for filtering
        $data['data'] = $query->get();
		return view('admin.transaction.history.view',$data);
	}
}
