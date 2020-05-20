      <div class="card">
        <div class="card-header">
					<h3>{{ __('messages.viewing') }} {!!$material->name_material!!}</h3>
				</div>

				<div class="card-body">
					<div class="row">
						<label class="display-6">{{ __('messages.description') }}</label>
						<textarea size="30x5" class="form-control">{!!$material->desc_material!!}</textarea>
					</div>
        </div>
			</div>
