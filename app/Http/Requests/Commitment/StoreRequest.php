<?php

namespace App\Http\Requests\Commitment;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fixed_amount' => 'sometimes|integer',
            'is_variable' => 'required|boolean',
            'description' => 'required|string|min:3',
            'account_id' => 'sometimes|integer', // Pode ser conveniente transformar isso em uuid

            // Validação de inicio e fim da recorrência
            'start_date' => 'required|date', // data maior que hoje? Pode ser que o usuário precise salvar a data inicial de um compromisso passado que ainda tem sequencia
            'end_date' => 'sometimes|date|after:start_date', // TODO: data sempre maior que hoje

            // RRULE
            'frequency' => 'required|string|in:DAILY,WEEKLY,MONTHLY,YEARLY', // Ainda não cabe colocar isso em enum
            'interval' => 'required|integer|min:1',

            // Semanal
            'weekdays' => 'required_if:frequency,WEEKLY|array',
            'weekdays.*' => 'in:SU,MO,TU,WE,TH,FR,SA',

            // Para regra mensal e anual. Até porque precisamos do dia do mês em recorrência anual também
            'day_of_month' => 'required_if:frequency,MONTHLY,YEARLY|integer|min:1|max:31',

            // Anual
            'month' => [
                'required_if:frequency,YEARLY',
                'integer',
                'min:1',
                'max:12'
            ],
        ];
    }
}
