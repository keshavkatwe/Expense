@extends('layout.master')
@section('title', "Manage Expense")
@section('content')
@parent

<div class="row">
    <div class="col-md-12">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Expense Name</th>
                    <th>Price</th>
                    <th>Payed By</th>
                    <th>Shared By</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($arrExpenseList)==0)
                <tr>
                    <td colspan="6" class="text-center">No Records</td>
                </tr>
                @endif
                @foreach ($arrExpenseList as $list)
                <tr>
                    <td>{{ $list->expense_name }}</td>
                    <td>{{ $list->price }}</td>
                    <td>{{ ucfirst($list->payed_by) }}</td>
                    <td>
                        <?php $count = 0; ?>
                        @foreach($list->shared_by as $u)
                        {{ $count==0 ? '' : ',' }}
                        {{ ucfirst($u->name) }}
                        <?php $count++; ?>
                        @endforeach
                    </td> 
                    <td>{{ date("d-M-Y h:i:s a",strtotime($list->created_at)) }}</td>
                    <td>
                        <a href="edit_expense/{{$list->id}}" class="btn-primary btn btn-xs">Edit</a>
                        <a href="delete_expense/{{$list->id}}" class="btn-primary btn btn-xs">Delete</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @stop


