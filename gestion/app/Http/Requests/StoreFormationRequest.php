<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFormationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request./Règle de validation
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ref_formation' => 'required',
            'nom_formation' => 'required',
            'date' => 'required|date|after:today',
            'statut' => 'required|in:en_inscription,en_cours,termine',
            'capacite' => 'required|integer|min:1',
            'nb_participant' => 'required|integer|min:1',
        ];
    }

     /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'ref_formation.required' =>
                'La référence est obligatoire.',
            'nom_formation.required' =>
                'Le nom de la formation est obligatoire.',
            'date.required' =>
                'La date est obligatoire.',
            'date.after' =>
                'La date doit être supérieure à aujourd\'hui.',
            'capacite.required' =>
                'Le nombre de jours de la formation est obligatoire.',
            'capacite.min' =>
                'Le nombre de jours de la formation doit être supérieur à 0.',
            'statut.required' =>
                'Le statut est obligatoire.',
            'statut.in' =>
                'Statut invalide.',
            'nb_participant.required' =>
                'Le nombre de participant est obligatoire.',
            'nb_participant.min' =>
                'Le nombre de participant ne peut pas être négatif (minimum:1).',
        ];
    }
}
