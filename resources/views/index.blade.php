@extends('layout.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dynatable.css') }}" type="text/css" />
@endsection

@section('content')

<div class="wrapper">

    <h2>Welcome Vouchers</h2>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <h3>{{$vouchers_total}}</h3>
            <p> Entire vouchers</p>
        </div>

        <div class="col-lg-3 col-xs-6">
            <h3>{{$vouchers_unused}}</h3>
            <p>Unused vouchers</p>
        </div>

        <div class="col-lg-3 col-xs-6">
            <h3>{{$vouchers_used}}</h3>
            <p>Used vouchers</p>
        </div>
    </div>

    <div class="clear"></div>
</div>

<div class="wrapper">

    <div class="row form-row">
        <div class="col" style="max-width: 9%">
            <div class="form-group text-left">
                {!! Button::primary('+ Add coupons')->aslinkTo(route('offer.create'))->large()!!}
            </div>
        </div>
        <div class="col" style="max-width: 30%; margin-left: 5px">
            <div class="form-group text-left">
                <input type="text" class="form-control " placeholder="Search">
            </div>
        </div>
        <div class="col" style="max-width: 10%; margin-left: 5px">
            <div class="form-group text-left">
                {!! Button::primary(Icon::create('glyphicon glyphicon-cog'))->large() !!}
            </div>
        </div>
    </div>

    {{--<div class="form-group">
        <div class="row" style="margin: 5px 0px 5px">
            {!! Button::primary('+ Add coupons')->aslinkTo(route('offer.create')) !!}

        </div>
        <div class="row">
            <input type="text" class="form-control" placeholder="Search">
        </div>

    </div>--}}

  <table id="data_table" class="table table-bordered responsive table-striped">
      <thead>
          <tr>
              <th class="text-center"><input type="checkbox"> </th>
              <th class="text-center">Code</th>
              <th class="text-center">Used</th>
              <th class="text-center">Receiver</th>
              <th class="text-center">Use date</th>
          </tr>
      </thead>
      <tbody>

          @foreach($vouchers as $voucher)
          <tr>
              <td><input type="checkbox"></td>
              <td><div class="text-left d-inline">{{ $voucher->code }}</div>
                  <div class="float-right">{!! Button::primary(Icon::create('glyphicon glyphicon-cog')) !!}</div></td>
              <td>
                  <span class="glyphicon {{ is_null($voucher->used_on)
                    ? 'glyphicon glyphicon-remove'
                    : 'glyphicon glyphicon-ok'}}" aria-hidden="true">
                  </span>
              </td>
              <td>{{ $voucher->recipient->email }}</td>
              <td>{{ (is_null($voucher->used_on) ? '' : $voucher->used_on->format('d/m/Y')) }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.dynatable.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection