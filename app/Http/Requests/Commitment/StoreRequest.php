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
            'is_variable' => 'sometimes|boolean',
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
            'day_of_month' => 'required_if:frequency,MONTHLY,YEARLY',

            // Anual
            'month' => [
                'required_if:frequency,YEARLY',
                'integer',
                'min:1',
                'max:12'
            ],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->frequency === 'WEEKLY' && empty($this->by_days)) {
                $validator->errors()->add('by_days', 'Recorrência semanal exige ao menos um dia da semana selecionado');
            }

            if ($this->frequency === 'MONTHLY') {
                if (empty($this->by_month_days) && empty($this->by_days)) {
                    $validator->errors()->add('frequency', 'Recorrência mensal exige ao menos um dia do mês ou um dia da semana selecionados');
                }

                if (!empty($this->by_month_days) && !empty($this->by_days)) {
                    $validator->errors()->add('frequency', 'Recorrência mensal não pode conter dia do mês e dia específico da semana combinados');
                }
            }

            if (!empty($this->by_days_frequencies) && empty($this->by_days)) {
                $validator->errors()->add('by_days_frequencies', 'O campo de frequência diária não pode existir sem um dia da semana selecionado');
            }
        });
    }
}
