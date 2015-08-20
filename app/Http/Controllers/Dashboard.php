<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;

class Dashboard extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $total = array();
        $users = User::lists('name', 'id');
        foreach ($users as $o => $user) {
            $sql = "SELECT e.price,(select count(user_id) from mapuserexpense where expense_id = e.id) as shared_by,e.price/(select count(user_id) from mapuserexpense where expense_id = e.id) as total_price FROM expense e, mapuserexpense me WHERE e.id = me.expense_id and me.user_id=".$o." and e.created_at between '".date('Y')."-".date('m')."-01 00:00:00' and '".date('Y')."-".date('m')."-31 23:59:59'";
            $rs = DB::select(DB::raw($sql));
            $sum = 0;
            foreach ($rs as $r) {
                $sum = $sum + $r->total_price;
            }
            $total[$o] = round($sum,1);
        }
        return view('user/dashboard', ["strCurrentPage" => "dashboard", "total" => $total,"users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
