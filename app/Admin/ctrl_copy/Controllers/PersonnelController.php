<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Personnel;
use App\Models\Typepersonnel;
use App\Models\Diplomepersonnel;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;


class PersonnelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Personnel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new personnel());

        $grid->quickSearch('matricule', 'nom', 'prenoms');
        $grid->filter(function ($filter) {

            // Remove the default id filter
            $filter->disableIdFilter();

            $lestypepersonnels = array();
            $typepersonnels = Typepersonnel::all();
            foreach ($typepersonnels as $typepersonnel) {
                $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
            }
            $filter->in('typepersonnels_id', "Type de personnel")->multipleSelect($lestypepersonnels);

            $lesdiplomes = array();
            $diplomes = Diplomepersonnel::all();
            foreach ($diplomes as $diplome) {
                $lesdiplomes[$diplome->id] = $diplome->libellediplome;
            }
            $filter->in('diplomepersonnels_id', "Diplome du personnel")->multipleSelect($lesdiplomes);
        });
        $grid->column('id', __('Id'));
        // $grid->column('typepersonnels_id', __('Typepersonnels id'));
        $grid->typepersonnels_id("Type de personnel")->display(function ($id) {
            $query = Typepersonnel::find($id);
            return $query ? $query->libelletypepersonnel : 'Pas défini';
        });
        $grid->column('matricule', __('Matricule'));
        $grid->column('nom', __('Nom'));
        $grid->column('prenoms', __('Prenoms'));
        $grid->column('datenaissance', __('Date de naissance'));
        $grid->column('lieunaissance', __('Lieu de naissance'));
        $grid->column('sexe', __('Sexe'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('email', __('Email'));
        $grid->column('numeroautorisation', __("N° d'autorisation"));
        $grid->column('dateautorisation', __("Date d'autorisation"));
        // $grid->column('diplomepersonnels_id', __('Diplomepersonnels id'));
        $grid->diplomepersonnels_id("Diplome du personnel")->display(function ($id) {
            $query = Diplomepersonnel::find($id);
            return $query ? $query->libellediplome : 'Pas défini';
        });
        // $grid->column('created_at', __('Created at'))->date('Y-m-d');
        // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(personnel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('matricule', __('Matricule'));
        $show->field('nom', __('Nom'));
        $show->field('prenoms', __('Prenoms'));
        $show->field('datenaissance', __('Datenaissance'));
        $show->field('lieunaissance', __('Lieunaissance'));
        $show->field('sexe', __('Sexe'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('numeroautorisation', __('Numeroautorisation'));
        $show->field('dateautorisation', __('Dateautorisation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('typepersonnels_id', __('Typepersonnels id'));
        $show->field('diplomepersonnels_id', __('Diplomepersonnels id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new personnel());

        $form->text('nom', __('Nom'));
        $form->text('prenoms', __('Prenoms'));
        $form->text('matricule', __('Matricule'));
        // $form->number('typepersonnels_id', __('Typepersonnels id'));
        $lestypepersonnels = array();
        $typepersonnels = Typepersonnel::all();
        foreach ($typepersonnels as $typepersonnel) {
            $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
        }
        $form->select('typepersonnels_id', __('Type personnel'))->options($lestypepersonnels);
        // $form->number('diplomepersonnels_id', __('Diplomepersonnels id'));
        $lesdiplomes = array();
        $diplomes = Diplomepersonnel::all();
        foreach ($diplomes as $diplome) {
            $lesdiplomes[$diplome->id] = $diplome->libellediplome;
        }
        $form->select('diplomepersonnels_id', __('Diplome personnel'))->options($lesdiplomes);
        // $form->number('diplomepersonnels_id', __('Diplomepersonnels id'));

        $form->date('datenaissance', __('Datenaissance'))->default(date('Y-m-d'));
        $form->text('lieunaissance', __('Lieunaissance'));
        $form->text('sexe', __('Sexe'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        // $form->text('numeroautorisation', __('Numeroautorisation'));
        // $form->text('dateautorisation', __('Dateautorisation'));
        // $form->file('documentautorisation', "Uploader le document d'autorisation");
        $form->file('cv', "Uploader votre Curriculum Vitae");

        return $form;
    }

    public function createForm()
    {
        $form = new Form(new Personnel());

        $form->text('nom', __('Nom'));
        $form->text('prenoms', __('Prenoms'));
        $form->text('matricule', __('Matricule'));
        // $form->number('typepersonnels_id', __('Typepersonnels id'));
        $lestypepersonnels = array();
        $typepersonnels = Typepersonnel::all();
        foreach ($typepersonnels as $typepersonnel) {
            $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
        }
        $form->select('typepersonnels_id', __('Type personnel'))->options($lestypepersonnels);
        $lesdiplomes = array();
        $diplomes = Diplomepersonnel::all();
        foreach ($diplomes as $diplome) {
            $lesdiplomes[$diplome->id] = $diplome->libellediplome;
        }
        $form->select('diplomepersonnels_id', __('Diplome personnel'))->options($lesdiplomes);
        $form->date('datenaissance', __('Datenaissance'))->default(date('Y-m-d'));
        $form->text('lieunaissance', __('Lieunaissance'));
        $form->text('sexe', __('Sexe'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        $form->text('numeroautorisation', __('Numeroautorisation'));
        $form->text('dateautorisation', __('Dateautorisation'));
        $form->file('documentautorisation', "Uploader le document d'autorisation");
        $form->file('cv', "Uploader votre Curriculum Vitae");

        $form->tools(function (Form\Tools $tools) {
            $tools->disableList(); // Désactiver le bouton pour retourner à la liste
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $form->setAction('/admin/form_save');


       /* $form->saved(function (Form $form) {
         if (!Personnel::where([
                ['matricule', '=', $form->matricule]
            ])->exists()) {
                $personnel = new Personnel([
                    'nom' => $form->nom,
                    'prenoms' => $form->prenoms,
                    'matricule' => $form->matricule,
                    'typepersonnels_id' => $form->typepersonnels_id,
                    'diplomepersonnels_id' => $form->diplomepersonnels_id,
                    'lieunaissance' => $form->lieunaissance,  // Corrected field
                    'datenaissance' => $form->datenaissance,  // Corrected field
                    'sexe' => $form->sexe,                    // Corrected field
                    'telephone' => $form->telephone,          // Corrected field
                    'dateautorisation' => $form->dateautorisation,  // Corrected field
                    'numeroautorisation' => $form->numeroautorisation,  // Corrected field
                    'documentautorisation' => $form->documentautorisation,  // Corrected field
                    'cv' => $form->cv,  // Corrected field
                ]);
                $personnel->save();
            }
            return redirect()->route('admin/personnelannees/create')->with('success', __('Nouveau personnel ajouté avec succès.'));
        }); */

        return $form->render();

        // admin_toastr('Nouveau personnel ajouté avec succès.', 'success');
        // return redirect(admin_url('/personnelannees/create'));
    }

    
    public function sauvegarde(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'typepersonnels_id' => 'required|int|max:255',
            'diplomepersonnels_id' => 'nullable|int|max:255',
            'lieunaissance' => 'nullable|string|max:255',
            'sexe' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'dateautorisation' => 'nullable|string|max:255',
            'numeroautorisation' => 'nullable|string|max:255',
            'matricule' => 'required|string|max:255|unique:personnels',  // Assuming 'matricule' should be unique
            'email' => 'nullable|email', // Email validation, assuming it can be unique
            'datenaissance' => 'nullable|date',
            'documentautorisation' => 'nullable|file|mimes:pdf,jpeg,png',
            'cv' => 'nullable|file|mimes:pdf,docx,jpeg,png',


        ]);

        // Création du personnel
        Personnel::create($validatedData);

        // Répondre avec succès

        // admin_toastr('Nouveau personnel ajouté avec succès.', 'success');
        // return redirect()->back()->with('success', __('Nouveau personnel ajouté avec succès.'));
        // return redirect()->back();

        admin_toastr('Nouveau personnel ajouté avec succès.', 'success');
        return redirect(admin_url('/personnels'));

    }
    
}
