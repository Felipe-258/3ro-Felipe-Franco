<?php

namespace App\Http\Controllers;

use App\Models\LogCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{

    //Funcion para agregar
    public function logCRUD($request, $id, $accion)
    {
        $now = now();
        $ip = $request->getClientIp();
        $browser = $request->header('User-Agent');
        DB::insert('insert into log_crud (id_user, fecha, accion, browser, ip) values (?, ?, ?, ?, ?)', [$id, $now, "$accion", $browser, $ip]);
    }

    //logs.index
    public function logIndex(): View|RedirectResponse
    {
        /* dd('i');  */
        /* $id = Auth::user()->id; */
        $id = auth()->user()->role;
        if ($id === 1) {
            /* $logs = DB::select("SELECT * FROM log_crud"); */
            $logs = DB::select("SELECT log_crud.*, users.* FROM log_crud JOIN users ON log_crud.id_user = users.id ");
            /* dd($logs2); */
            return view('students.log', [
                'logs' => $logs
            ]);
        } else {
            return redirect()->route('students.index')->with('message', 'You have no permision to be there');

        }
    }

}
