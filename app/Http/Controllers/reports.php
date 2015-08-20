<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\expense;
use DB;
use Validator;

class reports extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $arrUser = User::lists('name', 'id');
        $arrExpenseList = expense::orderBy("expense.id", "ASC")->get();
        $ExpenseList = array();

        $sumData = array();
        $sumTotalPay = array();
        foreach ($arrUser as $k => $user) {
            $sumData[$k] = 0;
            foreach ($arrUser as $i => $user) {
                $sumTotalPay[$k][$i] = 0;
            }
        }

        $total_expense = 0;
        foreach ($arrExpenseList as $expense) {
            $share_count = $expense->shared_by_users->count();
            $countData = array();
            foreach ($arrUser as $k => $user) {
                $count = DB::table('mapuserexpense')->where('expense_id', $expense->id)->where('user_id', $k)->count();
                if ($count > 0) {
                    $cost = ($expense->price / $share_count);
                    $countData[] = $cost;
                    $sumData[$k] = $sumData[$k] + $cost;
                    $total_expense+=$cost;

                    $sumTotalPay[$expense->payed_by][$k] += $cost;
                } else {
                    $countData[] = NULL;
                }
            }



            $ExpenseList[] = array(
                'expense_name' => $expense->expense_name,
                'price' => $expense->price,
                'payed_by' => user::find($expense->payed_by)->name,
                'created_at' => $expense->created_at,
                'countData' => $countData,
                'sumData' => $sumData
            );
        }



        return view('user/reports', [
                    "strCurrentPage" => "reports",
                    "total_expense" => $total_expense,
                    "arrUser" => $arrUser,
                    "sumTotalPay" => $sumTotalPay,
                    'date_from' => "",
                    'date_to' => "",
                    "arrExpenseList" => $ExpenseList]);
    }

    public function search(Request $request) {
        $date_from = "";
        $date_to = "";
        $validator = Validator::make($request->all(), [
                    'date_from' => 'required',
                    'date_to' => 'required'
                ]);

        if ($validator->fails()) {
            
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }


        $arrUser = User::lists('name', 'id');

        $date_from = date("Y-m-d", strtotime($request->date_from)) . " 00:00:00";
        $date_to = date("Y-m-d", strtotime($request->date_to)) . " 23:59:59";
        //$arrExpenseList = expense::whereBetween('created_at',array($date_from,$date_to))->orderBy("expense.id", "ASC")->get();
        $arrExpenseList = expense::whereRaw('created_at between "' . $date_from . '" and "' . $date_to . '"')->get();
        $ExpenseList = array();

        $sumData = array();
        $sumTotalPay = array();
        foreach ($arrUser as $k => $user) {
            $sumData[$k] = 0;
            foreach ($arrUser as $i => $user) {
                $sumTotalPay[$k][$i] = 0;
            }
        }

        $total_expense = 0;
        if (count($arrExpenseList) > 0) {
            foreach ($arrExpenseList as $expense) {
                $share_count = $expense->shared_by_users->count();
                $countData = array();
                foreach ($arrUser as $k => $user) {
                    $count = DB::table('mapuserexpense')->where('expense_id', $expense->id)->where('user_id', $k)->count();
                    if ($count > 0) {
                        $cost = ($expense->price / $share_count);
                        $countData[] = $cost;
                        $sumData[$k] = $sumData[$k] + $cost;
                        $total_expense+=$cost;

                        $sumTotalPay[$expense->payed_by][$k] += $cost;
                    } else {
                        $countData[] = NULL;
                    }
                }



                $ExpenseList[] = array(
                    'expense_name' => $expense->expense_name,
                    'price' => $expense->price,
                    'payed_by' => user::find($expense->payed_by)->name,
                    'created_at' => $expense->created_at,
                    'countData' => $countData,
                    'sumData' => $sumData
                );
            }
        } else {
            $ExpenseList = array();
        }



        return view('user/reports', [
                    "strCurrentPage" => "reports",
                    "total_expense" => $total_expense,
                    "arrUser" => $arrUser,
                    "sumTotalPay" => $sumTotalPay,
                    'date_from' => $date_from,
                    'date_to' => $date_to,
                    "arrExpenseList" => $ExpenseList]);
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
