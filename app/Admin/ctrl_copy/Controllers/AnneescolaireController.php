<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use Encore\Admin\Controllers\AdminController;
class AnneescolaireController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Année scolaire';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Anneescolaire());

        $grid->column('id', __('Id'));
        $grid->column('libelleanneescolaire', __('Libelle'));
        $grid->column('rapport1', __('Rapport 1'))->display(function ($date) {
            return Carbon::parse($date)->format('d/m/Y H:i'); // Exemple : 18/03/2025 14:30
        });
        $grid->column('rapport2', __('Rapport 2'))->display(function ($date) {
            return Carbon::parse($date)->format('d/m/Y H:i'); // Exemple : 18/03/2025 14:30
        });
        $grid->column('rapport3', __('Rapport 3'))->display(function ($date) {
            return Carbon::parse($date)->format('d/m/Y H:i'); // Exemple : 18/03/2025 14:30
        });
        $grid->column('datedebut', __('Date de début'))->display(function ($date) {
            return Carbon::parse($date)->format('d/m/Y H:i'); // Exemple : 18/03/2025 14:30
        });
        $grid->column('datefin', __('Date de fin'))->display(function ($date) {
            return Carbon::parse($date)->format('d/m/Y H:i'); // Exemple : 18/03/2025 14:30
        });
        $grid->column('created_at', __('Created at'))->display(function ($date) {
            return Carbon::parse($date)->format('d/m/Y H:i'); // Exemple : 18/03/2025 14:30
        });
        $grid->column('updated_at', __('Updated at'))->display(function ($date) {
            return Carbon::parse($date)->format('d/m/Y H:i'); // Exemple : 18/03/2025 14:30
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Anneescolaire::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libelleanneescolaire', __('Libelle'));
        $show->field('rapport1', __('Rapport 1'));
        $show->field('rapport2', __('Rapport 2'));
        $show->field('rapport3', __('Rapport 3'));
        $show->field('datedebut', __('Date de début'));
        $show->field('datefin', __('Date de fin'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Anneescolaire());

        $form->text('libelleanneescolaire', __('Libelle'));
        $form->datetime('rapport1', __('Rapport 1'))->default(date('Y-m-d'));
        $form->datetime('rapport2', __('Rapport 2'))->default(date('Y-m-d'));
        $form->datetime('rapport3', __('Rapport 3'))->default(date('Y-m-d'));
        $form->date('datedebut', __('Date de début'))->default(date('Y-m-d'));
        $form->date('datefin', __('Date de fin'))->default(date('Y-m-d'));

        // Utiliser l'événement saving pour calculer la différence en jours
        $form->saving(function (Form $form) {
            // Récupérer la date de rapport1
            $rapport1Date = $form->rapport1;
            
            // Si rapport1 est défini, on calcule la différence en jours
            if ($rapport1Date) {
                $rapport1 = Carbon::parse($rapport1Date);
                $today = Carbon::now();

                // Calculer la différence en jours
                $daysDifference = $today->diffInDays($rapport1);

                // Stocker la différence dans la session
                session(['days_difference' => $daysDifference]);
            }
        });
        // Ajoutez un champ pour afficher le décompte
        // $form->html('<div id="date-decompte"></div>');

        // Script pour calculer et afficher le décompte
//         $form->html('
// <script>
//     function updateDecompte() {
//         var rapport1 = $("#rapport1").val();
//         if (rapport1) {
//             var today = new Date();
//             var dateRapport1 = new Date(rapport1);
//             var timeDiff = dateRapport1.getTime() - today.getTime();
//             var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Conversion en jours
//             $("#date-decompte").text("Décompte rapport de rentrée : " + diffDays + " jours");

//             // Send the countdown value to the server
//                 fetch("store-decompte", {
//                     method: "POST",
//                     headers: {
//                         "Content-Type": "application/json",
//                         "X-CSRF-TOKEN": "' . csrf_token() . '"
//                     },
//                     body: JSON.stringify({ countdown: diffDays })
//                 });

//         } else {
//                 document.getElementById("date-decompte").innerText = "";
//         }
//     }
    
//     // Écouteur d événement pour mettre à jour le décompte lorsque rapport1 change
//     // $("#rapport1").change(updateDecompte);
//             document.getElementById("rapport1").addEventListener("change", updateDecompte);
//     // Appel initial pour afficher la valeur par défaut
//     updateDecompte();
//     </script>
// ');

        return $form;
    }

    public function storeDecompte(Request $request)
    {
        // Valider l'entrée
        $request->validate([
            'countdown' => 'required|integer',
        ]);

        // Stocker dans la session
        session(['date_decompte' => $request->countdown]);

        return response()->json(['message' => 'Décompte jours enregistré dans la session.']);
    }
}
