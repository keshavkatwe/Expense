@extends('layout.master')
@section('title', ($strAction=='add_expense')?'Add Expense':'Update Expense')
@section('content')
@parent
<div class="row">
    <div class="col-md-4">
        {!! Form::open(array('url' => $strAction ,'method' => ($strAction=='add_expense')?'POST':'PUT' )) !!}
        {!! Form::hidden("expense_id",(!empty($intExpenseId))?$intExpenseId:'') !!}
        <div class="form-group {{ $errors->first('expense_name')? 'has-error':'' }}">
            {!! Form::label('expense_name', 'Expense name') !!} <span class="text-danger">*</span>
            {!! Form::text('expense_name',Input::old('expense_name',$arrExpenseList['expense_name']), array("class"=>"form-control", "placeholder"=>"Expense name")) !!}
            {!! $errors->first('expense_name', '<span class="text-danger">:message</span>') !!}        
        </div>
        <div class="form-group {{ $errors->first('price')? 'has-error':'' }}">
            {!! Form::label('price', 'Expense price') !!} <span class="text-danger">*</span>
            {!! Form::text('price',Input::old('price',$arrExpenseList['price']), array("class"=>"form-control", "placeholder"=>"Expense price")) !!}
            {!! $errors->first('price', '<span class="text-danger">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->first('payed_by')? 'has-error':'' }}">
            {!! Form::label('payed_by', 'Expense payed by') !!} <span class="text-danger">*</span>
            {!! Form::select('payed_by', $users, Input::old('payed_by',$arrExpenseList['payed_by']),array("class"=>"form-control")) !!}
            {!! $errors->first('payed_by', '<span class="text-danger">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->first('shared_by')? 'has-error':'' }}">
            {!! Form::label('shared_by', 'Shared by') !!} <span class="text-danger">*</span>
            <?php
            if (!empty(Request::old('shared_by'))) {
                $arrExpenseList['shared_by'] = Request::old('shared_by');
            }
            ?>
            @foreach ($users as $k => $u)
            <br>{!! Form::checkbox('shared_by[]', $k, ((!empty($arrExpenseList['shared_by']) and in_array($k, $arrExpenseList['shared_by']))?'checked':'')) !!} {{ ucfirst($u) }}
            @endforeach
            <br> 
            {!! $errors->first('shared_by', '<span class="text-danger">:message</span>') !!}
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ ($strAction=='add_expense')?'Add Expense':'Update Expense' }}</button>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-6"></div>
</div>

@stop


