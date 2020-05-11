@extends('layouts.dashboard')

@section('content')
<br><br>

<div id="response-success" class="container alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="container alert alert-danger mt-2" style="display:none"></div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h3>LANs waiting to be confirmed</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table card-table table-bordered">
          <thead class="card-table text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">View</th>
            <th scope="col">Accept</th>
            <th scope="col">Reject</th>
          </thead>

          <tbody class="text-center">
          @foreach($waiting_lans as $lan)
            <tr id="row-waiting-lan-{{$lan->id}}">
              <td class="lead-text">{{$lan->id}}</td>
              <td class="col mt-2 lead-text">{{$lan->name}}</td>

              <td>
                <a class="btn btn-success" href="{{ route('lan.show', $lan->id) }}"><i class='fa fa-eye'></i> View</a>
              </td>
              <td>
                {!! Form::model($lan, ['method' => 'put', 'onsubmit' => 'return sendRequestAccept(event,'.$lan->id.')']) !!}
                  {{ Form::hidden('waiting_lan', config('waiting.ACCEPTED'),['id'=>'waiting_lan_accept']) }}
                  {{ Form::button('<i class="fa fa-check" aria-hidden="true"></i> Accept', ['class' => 'btn btn-success', 'type' => 'submit']) }}
                {{ Form::close() }}
              </td>
              <td>
                {!! Form::model($lan, ['method' => 'put', 'onsubmit' => 'return sendRequestReject(event,'.$lan->id.')']) !!}
                  {{ Form::hidden('waiting_lan', config('waiting.REJECTED'),['id'=>'waiting_lan_reject']) }}
                  {{ Form::button('<i class="fa fa-times" aria-hidden="true"></i> Reject', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css_includes')
<link rel="stylesheet" href="/css/table-style.css"></link>
@endsection

@section('js_includes')
@parent
<script src="/js/ajax/lan/ajax_validate.js"></script>
@endsection
