<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\expense;
use App\mapuserexpense;
use DB;
use Auth;

class AddExpense extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $users = User::lists('name', 'id');

        $arrExpenseList = array(
            "expense_name" => null,
            "price" => null,
            "payed_by" => null,
            "shared_by" => null
        );
        return view('user/addExpense', ['users' => $users,
                    "strAction" => "add_expense",
                    "arrExpenseList" => $arrExpenseList,
                    "strCurrentPage" => "add_expense"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
                    'expense_name' => 'required|max:255',
                    'price' => 'required|numeric',
                    'payed_by' => 'required',
                    'shared_by' => 'required'
                ]);

        if ($validator->fails()) {
            return redirect('add_expense')
                            ->withErrors($validator)
                            ->withInput();
        }

        $expense = new expense;
        $expense->expense_name = $request->expense_name;
        $expense->price = $request->price;
        $expense->payed_by = $request->payed_by;
        $expense->added_by = Auth::user()->id;
        $expense->save();

        foreach ($request->shared_by as $user_id) {
            $map_user_expense = new mapuserexpense;
            $map_user_expense->expense_id = $expense->id;
            $map_user_expense->user_id = $user_id;
            $map_user_expense->save();
        }
        return redirect('manage_expense');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function view() {
        $rsExpenseList = expense::orderBy("expense.id","DESC")->get(); 
        $arrExpenseList = array();
        foreach ($rsExpenseList as $expense) {
            
            $users = DB::table('users')
                            ->join('mapuserexpense', 'mapuserexpense.user_id', '=', 'users.id')
                            ->select('users.name')
                            ->where('mapuserexpense.expense_id', '=', $expense->id)->get();
            $expense['shared_by'] = $users;
            $expense['payed_by'] = user::find($expense->payed_by)->name;
            $arrExpenseList[] = $expense;
        }
        return view('user/manageExpense', ['arrExpenseList' => $arrExpenseList, "strCurrentPage" => "manage_expense"]);
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
        $objExpense = expense::find($id);
        $shared_users = array();

        foreach (expense::find($id)->shared_by_users as $u) {
            $shared_users[] = $u->user_id;
        }
        $arrExpenseList = array(
            "expense_name" => $objExpense->expense_name,
            "price" => $objExpense->price,
            "payed_by" => $objExpense->payed_by,
            "shared_by" => $shared_users
        );

        $users = User::lists('name', 'id');
        return view('user/addExpense', ['users' => $users,
                    "strAction" => "update_expense",
                    "intExpenseId" => $id,
                    "strCurrentPage" => "manage_expense",
                    'arrExpenseList' => $arrExpenseList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
                    'expense_name' => 'required|max:255',
                    'price' => 'required|numeric',
                    'payed_by' => 'required',
                    'shared_by' => 'required'
                ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $expense = expense::find($request->expense_id);
        $expense->expense_name = $request->expense_name;
        $expense->price = $request->price;
        $expense->payed_by = $request->payed_by;
        $expense->added_by = Auth::user()->id;


        $comments = array();
        foreach ($request->shared_by as $u) {
            $comments[] = new mapuserexpense(['user_id' => $u]);
        }

        $expense->shared_by_users()->delete();
        $expense->shared_by_users()->saveMany($comments);
        $expense->save();

        return redirect('manage_expense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $expense = expense::find($id);
        $expense->shared_by_users()->delete();
        $expense->delete();
        return redirect('manage_expense');
    }

}
