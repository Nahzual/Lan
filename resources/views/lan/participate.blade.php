@extends('layouts.dashboard')

@section('title')
Registering to Lan : {!!$lan->name!!}
@endsection

@section('page-title')
Registering to Lan
@endsection

@section('content')
<div id="response-success" class="alert alert-success mt-2" style="display:none"></div>
<div id="response-error" class="alert alert-danger mt-2" style="display:none"></div>

<p>Please choose a place on this LAN's room plan :</p>

{!! Form::hidden('room_plan', $room, ['class' => 'form-control']) !!}
<p>Legend :</p>
<table>
	<tbody>
		<tr>
			<table style="display: inline-table;" class="border border-dark field">Wall : <td class="cell wall"></td></table>
		</tr>
		<tr>
			<td scope="col">Table :</td>
			<table style="display: inline-table;" class="border border-dark field"><td class="mr-2 cell table"></td></table>
		</tr>
		<tr>
			<td scope="col">Empty chair :</td>
			<table style="display: inline-table;" class="border border-dark field"><td class="cell chairNull"></td></table>
		</tr>
		<tr>
			<td scope="col">Taken chair :</td>
			<table style="display: inline-table;" class="border border-dark field"><td class=" cell chair"></td></table>
		</tr>
		<tr>
			<td scope="col">Your place :</td>
			<table style="display: inline-table;" class="border border-dark field"><td class="cell user"></td></table>
		</tr>
		<tr>
			<td scope="col">Computer :</td>
			<table style="display: inline-table;" class="border border-dark field"><td class="cell computer"></td></table>
		</tr>
		<tr>
			<td scope="col">Console :</td>
			<table style="display: inline-table;" class="border border-dark field"><td class="cell console"></td></table>
		</tr>
		<tr>
			<td scope="col">Empty space :</td>
			<table style="display: inline-table;" class="border border-dark field"><td class="mr-2 cell null"></td></table>
		</tr>
	</tbody>
</table>

<div id="plateau" class="form-group row text-center justify-content-center mt-5">
	<div id="result">
	</div>
</div>

<form class="text-center" onsubmit="return addPlayer(event,{{$lan->id}})">
	<button type="submit" class="button button-primary">Join</button>
</form>

@endsection

@section('js_includes')
<script src="/js/ajax/lan/ajax_participate.js"></script>
<script defer="defer" src="/js/room_plan/participate.js"></script>
@endsection

@section('css_includes')
<link rel="stylesheet" href="/css/room_plan/salle.css"></link>
@endsection
