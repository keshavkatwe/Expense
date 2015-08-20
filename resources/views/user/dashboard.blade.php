@extends('layout.master')
@section('title', 'Dashboard')
@section('content')
@parent
<?php 
    $color = array("danger","info","success","warning");
    $i = 0;
?>
<div class="row">
@foreach($total as $k =>  $t)

    <div class="col-md-3">
        <div class="alert alert-{{ $color[$i] }} {{ $color[$i] }}">
            <i>{{ ucfirst($users[$k]) }}</i>
            <h2>{{$t}} / <small>{{ date('F Y') }}</small> </h2>
        </div>
    </div>

<?php $i++; ?>
@endforeach
</div>




<blockquote style="border-left: 5px solid #FF3A3A;">
    Where there is a will there is a way
    <small>Kharcho</small>
</blockquote>

@stop