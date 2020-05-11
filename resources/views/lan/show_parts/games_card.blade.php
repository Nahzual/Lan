					<div class="card">
						<div class="card-header" id="heading-games">
							<div class="row">
								<div class="col mt-2">
									<h4>Games</h4>
								</div>
								<div class="col mt-2">
									<button class="btn btn-outline-dark shadow-sm float-right ml-2" data-toggle="collapse" data-target="#lan_games" aria-expanded="false" aria-controls="lan_games">Show/hide</button>
									@if ($userIsLanAdmin)
									<a class="btn btn-success shadow-sm float-right ml-2" href="{{ route('lan.add_game', $lan->id) }}"><i class='fa fa-plus'></i></a>
									@endif
									<a class="btn btn-outline-primary shadow-sm float-right" href="{{ route('lan.game_list', $lan->id) }}"><i class='fa fa-list'></i> All</a>
								</div>
							</div>
						</div>
						<div class="collapse" id="lan_games" aria-labelledby="heading-games">
							<div class="card-body">
								@include('game.list_lan')
							</div>
						</div>
				</div>
				@foreach($games as $game)
				<div id="popup-game-{{$game->id}}" class="popup">
					<div class="popup-content">
						<span onclick="closeGame({{$game->id}})" class="close">&times;</span>
						@include('game.add_port',[$game,$lan])
					</div>
				</div>
				@endforeach
