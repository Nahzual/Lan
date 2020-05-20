@extends('layouts.dashboard')

@section('title')
Viewing : Tree of {!!$tournament->name_tournament!!}
@endsection

@section('page-title')
Tree tournament page
@endsection


@section('content')


<?php $arr = array(); ?>

<div class="col-md-12">
  <div id="response-success-teams" class="container alert alert-success mt-2" style="display:none"></div>
  <div id="response-error-teams" class="container alert alert-danger mt-2" style="display:none"></div>
  @include('tournament.show_parts.team_card')
</div>

@foreach($teams as $team)
  <tr id="row-team-tournament-{{$team->id}}">
      <?php array_push($arr, $team->name_team); ?>
    </td>
  </tr>
@endforeach

<br>

<div class="col-md-12">

@if($teams->count()!=0)
<?php
$nb_equipe = $teams->count();
/* on ajoute assez de noms NULL pour avoir un nombre d'équipe qui est une puissance de 2*/
  $puissance=array('1','2', '4', '8', '16', '32', '64', '128');
  $i = 0;
  while ($nb_equipe > $puissance[$i]) {
    $i ++;
  }
  /*ici le nombre de colones (*2 car une colone case et une colone lignes) (+1 i commence à 0 dernière colone n'a pas de lignes)*/
  $max_col = $i * 2 + 1;
  $x = $puissance[$i]-$nb_equipe;
  if($x != 0){
    for ($j=0; $j < $x; $j++) {
      array_splice($arr, $j*2 , 0, "NULL");
    }
    $nb_equipe += $x;
  }
  /*on mélange les noms*/
  shuffle($arr);

  $nb_col = 1;
  $nb_col_p = 1;
  $deb_col = 0;
  $esp_col = 0;
  $is_case = 1;

/*pour le css*/
  $height = 15;
  $width = 80;


  /*on determine le nombre de lignes, chaques case fait deux lignes de hauteur pour pouvoir bien dessiner les liens*/
  $nb_ligne = (($nb_equipe-1) *4) + 2;

  /* On Commence la table (pour les colonnes) */
  echo "<table cellpadding='0' cellspacing='0'><tr>";

/* On fait une boucle jusqu'au nombre maximum de colonne */
for($nb_col ; $nb_col <= $max_col ; $nb_col++)
{
	/* On reinitilise quelques variable et on affiche une nouvelle colonne */
	echo "<td valign='top' width='".$width."'>";
	$is_case = 1;

/* Si la colonne n'est pas une colonne lien */
if($nb_col % 2 == 1)
{
	/* Certain calcul */
	$deb_col = pow(2 , $nb_col_p) - 1;
	$esp_col = $deb_col * 2;

	/* Une boucle du nombre de ligne dans une colonne */
  for($i = 1;$i < $nb_ligne ; $i++)
	{
	  /* Si on a pas atteint le premier affichage */
		if($i < $deb_col)
		{
			echo "<table cellpadding='0' cellspacing='0' border='0' height='".$height."'><tr><td></td></tr></table>";
		}

		/* si c'est une case ( de hauteur 2 * $height ) et que c'est bien la premiere ligne de la case (grace au modulo) */
		else if($is_case == 1 && $i % 2 == 1)
		{
      /* Le texte d'affichage de la case */
        if((($i-1) % 4) == 0){
          echo "<table cellpadding='0' cellspacing='0' border='1' height='".(2*$height)."' bgcolor='#293133' width='".$width."' align='center'><tr><td width='".$width."' align='center'><font size='1' color='#FFFFFF'>"
          .$arr[$i/4]."</font></td></tr></table>";
        }else{
          echo "<table cellpadding='0' cellspacing='0' border='1' height='".(2*$height)."' bgcolor='#293133' width='".$width."' align='center'><tr><td width='".$width."' align='center'><font size='1'>
          <input id='case' name='case' size='11' color='#FFFFFF'></font></td></tr></table>";
        }
    			$i += 2;
    			$is_case = 0;
		 }
		/*Sinon :)
		else
		{
			echo "<table cellpadding='0' cellspacing='0' border='0' height='".$height."'><tr><td></td></tr></table>";
		}*/
		/*rapiditer on saute directement les espaces vides et on declare qu'il va y avoir de nouveau une case */
		if($is_case == 0 && $i % 2 == 1)
		{
			echo "<table cellpadding='0' cellspacing='0' border='0' height='".($esp_col)*$height."'><tr><td></td></tr></table>";
			$i += $esp_col -1;
			$is_case = 1;
		}

	}


}

/*************************************************/
/*          On fait les traits/lien              */
/*         entre les cases (col lien)            */
/*************************************************/
else if($nb_col % 2 == 0)
{
  /* On change quelques variables */
	$nb_col_pair = $nb_col;

	$deb_col = pow(2 , $nb_col_p);
	$nb_col_p++;
	$esp_col = $deb_col * 2;

	/* Meme boucle que tout  l'heure boucle dunombre de ligne */
	for($i = 1 ; $i < $nb_ligne ; $i++)
	{
	  /* Pareil : si aucun affichage encore */
		if($i < $deb_col)
		{
			echo "<table cellpadding='0' cellspacing='0' border='0' height='".$height."'><tr><td></td></tr></table>";
		}

		/* Si on doit afficher les liens */
		else if($is_case == 1 && $i % 2 == 0)
		{
			echo "<table cellpadding='0' cellspacing='0' border='0' height='".$esp_col*$height."'>";

			/* Je fonctionne comme �a , on fait une boucle du nombre de ligne cons�cutive pour un lien */
			for ($i2 = 1 ; $i2 <= $esp_col ; $i2++)
			{
			  /* Si premiere ligne */
				if($i2 == 1)
				{
					echo "<tr><td width='".($width)."' height='".$height."' valign='top'>
									<table cellpadding='0' cellspacing='0' border='0'><tr><td height='".$height."' valign='top' width='".($width/2 - 2)."'>
															<table cellpadding='0' cellspacing='0' border='0'><tr height='4'><td bgcolor='#000000' width='".($width/2 - 2)."'></td></tr>
															<tr height='".($height-4)."'><td></td></tr></table></td>
									<td width='4' height='".$height."' bgcolor='#000000'></td>
									<td height='".$height."' width='".($width/2 - 2)."'></td></tr></table></td></tr>";
				}
				/* Si ligne du milieu */
				else if($i2 == ($esp_col)/2 )
				{
					echo "<tr><td width='".($width)."' height='".$height."'>
									<table cellpadding='0' cellspacing='0' border='0'><tr><td height='".$height."' width='".($width/2 - 2)."'></td>
									<td bgcolor='#000000' width='4' height='".$height."'></td>
									<td height='".$height."' width='".($width/2 - 2)."'>
															<table cellpadding='0' cellspacing='0' border='0'>
															<tr height='".(($height/2) +2 )."'><td></td></tr>
															<tr height='4'><td bgcolor='#000000' width='".($width/2 - 2)."'></td></tr>
															<tr height='".(($height/2)-6)."'><td></td></tr>
															</table></td></tr></table></td></tr>";
				}
				/* Si derniere ligne */
				else if($i2 == ($esp_col))
				{
					echo "<tr><td width='".($width)."' height='".$height."' valign='bottom'>
									<table cellpadding='0' cellspacing='0' border='0'><tr><td height='".$height."' valign='bottom' width='".($width/2 - 2)."'>
															<table cellpadding='0' cellspacing='0' border='0'><tr height='".($height-4)."'><td></td></tr>
															<tr height='4'><td bgcolor='#000000' width='".($width/2 - 2)."'></td></tr></table></td>
									<td width='4' bgcolor='#000000' height='".$height."'></td>
									<td height='".$height."' width='".($width/2 - 2)."'></td></tr></table></td></tr>";
					$is_case = 0;
				}
				/* Si ligne verticale */
				else
				{
					echo "<tr><td width='".($width)."' height='".$height."' valign='top'>
									<table cellpadding='0' cellspacing='0' border='0'><tr><td width='".($width/2 - 2)."' height='".$height."'></td>
									<td width='4' bgcolor='#000000' height='".$height."'></td>
									<td height='".$height."' width='".($width/2 - 2)."'></td></tr></table></td></tr>";
				}
			}
			/* on incr�mente le nobre de ligne du nombre de ligne cons�cutive pour un lien */
			$i += $esp_col;

		}

		/* Sinon
		else
		{
			echo "<table cellpadding='0' cellspacing='0' border='0' height='".$height."'><tr><td></td></tr></table>";
		}*/

		/*Si on doit afficher des espaces , on les affiche avant d'�ecuter une nouvelle fois la boucle , pour a rapiditer */
		if($is_case == 0 && $i % 2 == 0)
		{
			echo "<table cellpadding='0' cellspacing='0' border='0' height='".$esp_col*$height."'><tr><td></td></tr></table>";
			$i += $esp_col - 1;
			$is_case = 1;
	  }
	}
}

/* On ferme la colonne */
echo "</td>";

/*Fin de la premiere boucle */
}

/*On ferme la table */
echo "</tr></table>";

/*******************************************/
/*Si on a pas renseigner le nombre d'�quipe*/
/*******************************************/
?>
@else
  There are not teams
@endif

<div class="row">
	<div class="col">
	  <a class="btn btn-outline-info shadow-sm float-right" href="{{ route('tournament.show_tournament', [$tournament->lan_id, $tournament]) }}"><i class='fa fa-arrow-left'></i> {{ __('messages.back_tournament') }}</a>
	</div>
</div>
</div>

@endsection

@section('css_includes')
<link href="{{ asset('css/tree.css') }}" rel="stylesheet">
@endsection
