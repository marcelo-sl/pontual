<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            $error = [
                'msg_title' => 'Erro no servidor',
                'msg_error' => 'Erro ao cadastrar cliente.'
            ];

            return redirect()->back()->with($error)->withInput();
        }

        $success = [
            'msg_title' => 'Sucesso ao cadastrar',
            'msg_success' => 'Usuário cadastrado com sucesso!'
        ];

        return redirect()->route('')->with($success);
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
