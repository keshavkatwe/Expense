@extends('layout.master')
@section('title', 'Reports')
@section('content')
@parent
<?php
Form::macro('date', function($field, $value, $attr) {
            return '<input type="date" name="' . $field . '" value="' . $value . '" ' . implode(' ', array_map(function($v, $k) {
                                        return $k . '=' . $v;
                                    }, $attr, array_keys($attr))) . ' >';
        });
?>
{!! Form::open(array('url' => 'reports/search' ,'method' => 'GET' )) !!}
<div class="row">
    <div class="col-md-3 {{ $errors->first('date_from')? 'has-error':'' }}">
        <label>Date from :</label>
        {!! Form::date('date_from',Input::old('date_from',$date_from),array("class"=>"form-control")) !!}
        {!! $errors->first('date_from', '<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-md-3 {{ $errors->first('date_to')? 'has-error':'' }}">
        <label>Date to :</label>
        {!! Form::date('date_to',Input::old('date_to',$date_to),array("class"=>"form-control")) !!}
        {!! $errors->first('date_to', '<span class="text-danger">:message</span>') !!}
    </div>
    <div class="col-md-3">

        <button type="submit" class="btn btn-primary" style="margin-top: 23px;">Search</button>
    </div>
</div>  
{!! Form::close() !!}
<br>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Expense Name</th>
                        <th>Price</th>
                        <th>Payed By</th>
                        <th>Date</th>
                        @foreach($arrUser as $k => $user)
                        <th class="text-center">{{ ucfirst($user) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @if(count($arrExpenseList)==0)
                    <tr><td colspan="{{ 4+count($arrUser)}}" class="text-center">No Records found</td></tr>
                    @else
                    @foreach($arrExpenseList as $expense)
                    <tr>
                        <td>{{ $expense['expense_name'] }}</td>
                        <td>{{ round($expense['price'],2) }}</td>
                        <td>{{ $expense['payed_by'] }}</td>
                        <td>{{ date("d-M-Y h:i:s a",strtotime($expense['created_at'] )) }}</td>
                        @foreach($expense['countData'] as $price)
                        <td class="text-right">{{ round($price,2) }}</td>
                        @endforeach
                    </tr>
                    @endforeach

                    <tr>
                        <th>Total</th>
                        <th>{{ round($total_expense,2) }}</th>
                        <td></td>
                        <td></td>
                        @foreach($expense['sumData'] as $sum)
                        <th class="text-right">{{ round($sum,2) }}</th>
                        @endforeach
                    </tr>

                    <!--
                    <tr>
                        <td colspan="{{ 4+count($arrUser)}}" class="text-center"><b>User shared summary</b></td>
                    </tr>
                    @foreach($arrUser as $o => $user)
                    <tr>
                        <td colspan="4">{{ ucfirst($arrUser[$o]) }}</td>
                        @foreach($arrUser as $i => $user)
                    <?php
                    $me = round($sumTotalPay[$o][$i], 2);
                    $they = round($sumTotalPay[$i][$o], 2);
                    $diff = $me - $they;
                    ?>
                        @if ($o!=$i)
                        <td class="text-right">{{ $me }} - {{ $they }} = <span @if ($diff>0) class="label label-success" @else class="label label-danger" @endif>{{ $diff }}</span></td> 
                        @else
                        <td class="text-right">{{ $me }} </td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                    @endif -->
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        @foreach($arrUser as $k => $user)
                        <?php $userTotal[$k] = 0 ?>
                        <th class="text-center">{{ ucfirst($user) }}</th>
                        @endforeach
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arrUser as $o => $user)
                    <tr>
                        <th>{{ ucfirst($arrUser[$o]) }}</th>
                        @foreach($arrUser as $i => $user)
                        <?php
                        $me = round($sumTotalPay[$o][$i], 2);
                        $they = round($sumTotalPay[$i][$o], 2);
                        $diff = $me - $they;

                        if ($o == $i) {
                            $userTotal[$o] = $userTotal[$o] + $me;
                        } else if ($diff < 0) {
                            $userTotal[$o] = $userTotal[$o] + ( $they - $me);
                        }
                        ?>
                        @if ($o!=$i)
                        <td class="text-right">{{ $me }} - {{ $they }} = <span @if ($diff>0) class="label label-success" @else class="label label-danger" @endif>{{ $diff }}</span></td> 
                        @else
                        <td class="text-right">{{ $me }} </td>
                        @endif
                        @endforeach
                        <th>{{ $userTotal[$o] }}</th>
                    </tr>
                    @endforeach  



                </tbody>

            </table>
        </div>

    </div>
</div>
@stop


