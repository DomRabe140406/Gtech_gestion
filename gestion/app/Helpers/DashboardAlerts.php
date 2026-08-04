<?php

namespace App\Helpers;

use App\Models\Formation;
use Carbon\Carbon;

class DashboardAlerts
{
    public static function get()
    {
        $alertes = [];

        $today = Carbon::today();

        /*
            débute dans moins de 48 h sans formateur
        */

        $urgentes = Formation::whereNull('formateur_id')
            ->where('statut', 'en_inscription')
            ->whereBetween('date_debut', [
                $today,
                $today->copy()->addDays(2)
            ])
            ->count();

        if ($urgentes > 0) {

            $alertes[] = [
                'type' => 'danger',
                'icon' => 'fa-triangle-exclamation',
                'message' => "{$urgentes} formation(s) commencent dans moins de 48 h sans formateur.",
                'lien' => route('liste.index'),
            ];
        }

        /* Débute dans les 7 prochains jours sans formateur*/

        $prochaines = Formation::whereNull('formateur_id')
            ->where('statut', 'en_inscription')
            ->whereBetween('date_debut', [
                $today->copy()->addDays(3),
                $today->copy()->addDays(7)
            ])
            ->count();

        if ($prochaines > 0) {

            $alertes[] = [
                'type' => 'warning',
                'icon' => 'fa-user-slash',
                'message' => "{$prochaines} formation(s) débutent dans les 7 prochains jours sans formateur.",
                'lien' => route('liste.index'),
            ];
        }

        /*Formations actuellement en cours */

        $formationsEnCours = Formation::where('statut', 'en_cours')
        ->orderBy('date_debut')
        ->get();

        if ($formationsEnCours->count() > 0) {

            $message = $formationsEnCours->count() . " formation(s) sont actuellement en cours :";

            foreach ($formationsEnCours->take(3) as $formation) {

                $jour = Carbon::parse($formation->date_debut)
                    ->diffInDays($today) + 1;

                $message .= "• {$formation->nom_formation} (Jour {$jour}/{$formation->nb_jours})";
            }

            if ($formationsEnCours->count() > 3) {

                $reste = $formationsEnCours->count() - 3;

                $message .= "<br>... et {$reste} autre(s).";
            }

            $alertes[] = [
                'type' => 'primary',
                'icon' => 'fa-person-chalkboard',
                'message' => $message,
                'lien' => route('liste.index', [
                    'statut' => 'en_cours'
                ]),
            ];
        }
        /*Formations terminées aujourd'hui*/

        $terminees = 0;

        foreach (Formation::where('statut', 'termine')->get() as $formation) {

            $dateFin = Carbon::parse($formation->date_debut)
                ->addDays($formation->nb_jours - 1);

            if ($dateFin->isToday()) {
                $terminees++;
            }
        }

        if ($terminees > 0) {

            $alertes[] = [
                'type' => 'success',
                'icon' => 'fa-circle-check',
                'message' => "{$terminees} formation(s) se sont terminées aujourd'hui.",
                'lien' => route('liste.index', ['statut' => 'termine']),
            ];
        }

        return $alertes;
    }
}