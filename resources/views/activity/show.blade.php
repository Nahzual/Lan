      <div class="card">
        <div class="card-header">
					<h3 >{{ __('messages.viewing') }} {!!$activity->name_activity!!}</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="display-6">{{ __('messages.description') }}</label>
						<textarea class="form-control">{!!$activity->desc_activity!!}</textarea>
					</div>
					<div class="form-group row text-center">
						@if(isset($userIsLanAdmin) && $userIsLanAdmin)
						<div class="col">
							<a class="btn btn-outline-warning shadow-sm" href="{{ route('activity.edit', array('lan' => $lan->id, 'activity' => $activity->id)) }}"><i class='fa fa-edit'></i> {{ __('messages.edit') }}</a>
						</div>
						@endif
					</div>
        </div>
			</div>
