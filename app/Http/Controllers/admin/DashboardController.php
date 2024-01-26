<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Housekeeper;
use App\Models\Service;
use App\Models\Shipping;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Count_house = Housekeeper::all()->count();
        $Count_user = User::where('role_id',3)->get()->count();
        $Count_service = Service::all()->count();
        $Count_book = Book::all()->count();
        $Count_blog = Blog::all()->count();
        $book = Book::join('tbl_booking_details', 'tbl_booking_details.book_id', '=', 'tbl_booking.book_id')
        ->join('tbl_service', 'tbl_service.service_id', '=', 'tbl_booking.service_id')
        ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_booking.shipping_id')
        ->join('users', 'users.user_id', '=', 'tbl_shipping.user_id')->orderBy('tbl_booking.created_at','ASC')->get();
        $All_user = User::where('role_id',3)->get();
        // >whereMonth('created_at', $now)
        $count_appointmemt = Book::selectRaw('count(tbl_booking.shipping_id) as count_booking, shipping_id,sum(tbl_booking.book_total) as total')
        ->groupBy('shipping_id')->orderBy('count_booking','DESC')->get();
        $getName = Shipping::join('users', 'users.user_id', '=', 'tbl_shipping.user_id')->get();

        $count_service = Book::selectRaw('count(tbl_booking.service_id) as count_service, service_id')
        ->groupBy('service_id')->orderBy('count_service','DESC')->get();
        $service = Service::orderBy('service_views','DESC')->take(10)->get();
        $blog = Blog::orderBy('blog_views','DESC')->take(10)->get();




        $sum_book = Book::selectRaw('count(id) as total_booking,sum(book_total) as total')->where('book_status','!=',1)->first();
        return view("admin.index")->with(compact('Count_house','Count_user','Count_service','Count_book','book','All_user','count_appointmemt','getName','Count_blog','count_service','service','sum_book','blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thongke_donlich(){

    }
    public function filter_by_date(Request $request){
        $data =$request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('date',[$from_date,$to_date])->orderBy('date','ASC')->get();
        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'date' => $value->date,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'appointment' => $value->total_appointment,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data =$request->all();
        $dashboard_value = $data['dashboard_value'];


        $dauthangnay = Carbon::now()->startOfMonth()->format('Y-m-d');
        $dauthang_truoc = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $cuoithang_truoc = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        $sub7days = Carbon::now()->subDays(7)->format('Y-m-d');
        $sub365days = Carbon::now()->subDays(100)->format('Y-m-d');

        $now = Carbon::now()->format('Y-m-d');

        switch ($dashboard_value) {
            case '7ngay':
                $get = Statistic::whereBetween('date',[$sub7days,$now])->orderBy('date','ASC')->get();
                break;
                case 'thangtruoc':
                    $get = Statistic::whereBetween('date',[$dauthang_truoc,$now])->orderBy('date','ASC')->get();
                    break;
                case 'thangnay':
                    $get = Statistic::whereBetween('date',[$dauthangnay,$now])->orderBy('date','ASC')->get();
                    break;
                case '365ngay':
                    $get = Statistic::whereBetween('date',[$sub365days,$now])->orderBy('date','ASC')->get();
                    break;

            default:
                    $get = Statistic::all()->orderBy('date','ASC');
                break;
        }
        if($get){
            foreach ($get as $key => $value) {

                    $chart_data[] = array(
                        'date' => $value->date,
                        'sales' => $value->sales,
                        'profit' => $value->profit,
                        'appointment' => $value->total_appointment,
                    );
                
            }
            echo $data = json_encode($chart_data);
        }




        // $get = Statistic::whereBetween('date',[$from_date,$to_date])->orderBy('date','ASC')->get();

    }
    public function dashboard_days(Request $request){
        $subdays = Carbon::now()->subDays(60)->format('Y-m-d');

        $now = Carbon::now()->format('Y-m-d');

        $get = Statistic::whereBetween('date',[$subdays,$now])->orderBy('date','ASC')->get();
        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'date' => $value->date,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'appointment' => $value->total_appointment,
            );
        }
        echo $data = json_encode($chart_data);

    }


    public function total_book(Request $request){
        $data = $request->all();
        $dashboard_type = $request->type;
        $dauthangnay = Carbon::now()->startOfMonth()->format('Y-m-d');
        $dauthang_truoc = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $cuoithang_truoc = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $sub365days = Carbon::now()->subDays(365)->format('Y-m-d');

        $now = Carbon::now()->format('Y-m-d');

        $day[0] ='';
        $day[1] = 0;
        switch ($dashboard_type) {
            case 'day':
                $get = Statistic::where('date',$now)->get();
                $day[0] ='Hôm nay';

                break;
                case 'month':
                    $get = Statistic::whereBetween('date',[$dauthangnay,$now])->orderBy('date','ASC')->get();
                $day[0] ='Tháng này';

                    break;
                case 'year':
                    $get = Statistic::whereBetween('date',[$sub365days,$now])->orderBy('date','ASC')->get();
                    $day[0] ='Năm này';

                    break;

            default:
                    $get = Statistic::all()->orderBy('date','ASC');
                $day[0] ='Tất cả';

                break;
        }


        foreach ($get as $key => $value) {
            $day[1] += $value->total_appointment;
        }

        echo(json_encode($day));
    }

    public function total_sales(Request $request){
        $data = $request->all();
        $dashboard_type = $request->type;
        $dauthangnay = Carbon::now()->startOfMonth()->format('Y-m-d');
        $dauthang_truoc = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $cuoithang_truoc = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $sub365days = Carbon::now()->subDays(365)->format('Y-m-d');

        $now = Carbon::now()->format('Y-m-d');

        $day[0] ='';
        $day[1] = 0;
        switch ($dashboard_type) {
            case 'day':
                $get = Statistic::where('date',$now)->get();
                $day[0] ='Hôm nay';

                break;
                case 'month':
                    $get = Statistic::whereBetween('date',[$dauthangnay,$now])->orderBy('date','ASC')->get();
                $day[0] ='Tháng này';

                    break;
                case 'year':
                    $get = Statistic::whereBetween('date',[$sub365days,$now])->orderBy('date','ASC')->get();
                    $day[0] ='Năm này';

                    break;

            default:
                    $get = Statistic::all()->orderBy('date','ASC');
                $day[0] ='Tất cả';

                break;
        }


        foreach ($get as $key => $value) {
            $day[1] += $value->sales;
        }

        echo(json_encode($day));

    }

    public function total_profit(Request $request){
        $data = $request->all();
        $dashboard_type = $request->type;
        $dauthangnay = Carbon::now()->startOfMonth()->format('Y-m-d');
        $dauthang_truoc = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $cuoithang_truoc = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $sub365days = Carbon::now()->subDays(365)->format('Y-m-d');

        $now = Carbon::now()->format('Y-m-d');

        $day[0] ='';
        $day[1] = 0;
        switch ($dashboard_type) {
            case 'day':
                $get = Statistic::where('date',$now)->get();
                $day[0] ='Hôm nay';

                break;
                case 'month':
                    $get = Statistic::whereBetween('date',[$dauthangnay,$now])->orderBy('date','ASC')->get();
                $day[0] ='Tháng này';

                    break;
                case 'year':
                    $get = Statistic::whereBetween('date',[$sub365days,$now])->orderBy('date','ASC')->get();
                    $day[0] ='Năm này';

                    break;

            default:
                    $get = Statistic::all()->orderBy('date','ASC');
                $day[0] ='Tất cả';

                break;
        }
        // dd($get);

        foreach ($get as $key => $value) {
            $day[1] += (int) $value->profit;
        }

        echo(json_encode($day));

    }

    public function total_quickview(Request $request){

            $get = Statistic::all();

            $day['type'] ='Tất cả';
            $day['profit'] =0;
            $day['book'] =0;
            $day['sales'] =0;
        // dd($get);


        foreach ($get as $key => $value) {
            $day['profit'] += (int) $value->profit;
            $day['sales'] += (int) $value->sales;
            $day['book'] += (int) $value->total_appointment;


        }

        // dd($day);
        echo(json_encode($day));

    }

}
