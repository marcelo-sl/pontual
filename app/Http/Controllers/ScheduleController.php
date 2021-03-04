<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

use App\{Schedule, WorkingHour};

class ScheduleController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
          if ($request->input('schedule_date') === '' || $request->input('schedule_hour') === '') 
          {
            $error = [
              'msg_title' => 'Erro no servidor',
              'msg_error' => 'Erro ao realizar agendamento.'
            ];

            return redirect()->back()->with($error);
          }

          $provider_id = $request->input('provider_id');
          $concatDateTime = $request->input('schedule_date') . " " . $request->input('schedule_hour');
          $input['date_time'] = date("Y-m-d H:i:s", strtotime($concatDateTime));

          Validator::make($input, [
            'date_time' => [
              Rule::unique('schedules')->where(function ($query) use ($provider_id) {
                return $query->where('provider_id', $provider_id);
              })
            ],
          ])->validate();
          
          $schedule = new Schedule;
          
          $schedule->date_time = $input['date_time'];
          $schedule->customer_id = $request->input('customer_id');
          $schedule->provider_id = $provider_id;
          $schedule->status_id = 1;
          
          $schedule->save();
          
          DB::commit();

        } catch (\Exception $exception) {
            DB::rollback();

            $error = [
                'msg_title' => 'Erro no servidor',
                'msg_error' => 'Erro ao realizar agendamento.'
            ];

            return redirect()->back()->with($error)->withInput();
        }

        $success = [
            'msg_title' => 'Agendamento marcado!',
            'msg_success' => 'Cheque em meus agendamentos'
        ];

        return redirect()->back()->with($success);
    }


    /**
     * Get the days of week that the company/provider is not working
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id = company or provider identification
     * @return \Illuminate\Http\Response
     */
    public function getDaysOfWeekDisabled(Request $request, $id) 
    {
      list($type, $id) = explode("/", $request->path(), 3);
      $daysOfWeek = [0, 1, 2, 3, 4, 5, 6];
      $daysOfWeekDisabled = [];

      if ($type === 'provider') {
        $workingDays = WorkingHour::where('provider_id', $id)->pluck('week_day')->toArray();
        $daysOfWeekDisabled = array_values(array_diff($daysOfWeek, $workingDays));
      } else {
        $workingDays = WorkingHour::where('company_id', $id)->pluck('week_day')->toArray();
        $daysOfWeekDisabled = array_values(array_diff($daysOfWeek, $workingDays));
      }

      return $daysOfWeekDisabled;
    }
}
