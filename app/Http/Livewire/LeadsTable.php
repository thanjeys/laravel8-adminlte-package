<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class LeadsTable extends PowerGridComponent
{
    use ActionButton;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                '$refresh',
                'edit',
                'deleteConfirm',
                'copy'
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Lead>
    */
    public function datasource(): Builder
    {
        // $lead->user_id != auth()->user()->id && auth()->user()->is_admin == 0

        $query = Lead::query()
                    ->select('leads.*', 'bank_name', 'freelancers.name as freelancer', 'users.name as username')
                    ->leftjoin('banks', 'banks.id', '=', 'leads.bank')
                    ->leftjoin('freelancers', 'freelancers.id', '=', 'leads.flr_name')
                    ->leftjoin('users', 'users.id', '=', 'leads.user_id');


        if (auth()->user()->is_admin == 1) {
            return $query;
        } else if (auth()->user()->is_admin == 2) {
            $backend_banks = DB::table('bank_user')
                                ->select('bank_id')
                                ->where('user_id', auth()->user()->id)
                                ->get()
                                ->toArray();
            $backend_banks = array_map(function($item){ return (array) $item;},$backend_banks);
            return $query->whereIn('bank', $backend_banks);
        } else {
            return $query->where('user_id', '=', auth()->user()->id);
        }

    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'bank' => [
                'bank_name',
            ]
            ,
            'freelancer' => [
                'name',
            ],
            'user' => [
                'name'
            ]

        ];

        // Column::add()
        //         ->title('Customer Name')
        //         ->field('customer_name', 'CardName')
        //         ->sortable('customer_name')
        //         ->searchable('customer_name'),
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('customer_num')

           /** Example of custom column using a closure **/
            ->addColumn('customer_num_lower', function (Lead $model) {
                return strtolower(e($model->customer_num));
            })

            ->addColumn('customer_name')
            ->addColumn('salary')
            ->addColumn('company_name')
            ->addColumn('disbused_amount')
            ->addColumn('app_num')
            ->addColumn('sm')
            ->addColumn('disbused_amount')
            ->addColumn('loan_amount')
            ->addColumn('bank_name')
            ->addColumn('freelancer')
            ->addColumn('status')
            ->addColumn('remarks')
            ->addColumn('username')
            ->addColumn('product')
            ->addColumn('created_at_formatted', fn (Lead $model) => Carbon::parse($model->created_at)->format('d/m/Y'))
            ->addColumn('updated_at_formatted', fn (Lead $model) => Carbon::parse($model->updated_at)->format('d/m/Y'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
                // ->makeInputRange(),

            Column::make('CUSTOMER NAME', 'customer_name')
                ->sortable()
                ->searchable(),
                // ->makeInputText(),

            Column::make('CUSTOMER NUM', 'customer_num')
                ->sortable()
                ->searchable(),
                // ->makeInputText(),

            Column::make('LOAN AMOUNT', 'loan_amount')
                ->sortable()
                ->searchable(),

            Column::make('Disbused Amount', 'disbused_amount')
            ->sortable()
            ->searchable(),

            Column::make('Salary', 'salary')
            ->sortable()
            ->searchable(),

            Column::make('COMPANY', 'company_name')
            ->sortable()
            ->searchable(),

            Column::make('PRODUCT', 'product')
            ->sortable()
            ->searchable(),


            Column::make('BANK', 'bank_name')
            ->sortable()
            ->searchable(),

            Column::make('Freelancer', 'freelancer')
            ->sortable()
            ->searchable(),


            Column::make('App Num', 'app_num')
            ->sortable()
            ->searchable(),

            Column::make('SM', 'sm')
            ->sortable()
            ->searchable(),

            Column::make('Remarks', 'remarks')
            ->sortable()
            ->searchable(),

                // ->makeInputRange(),
            Column::make('STATUS', 'status')
                ->sortable()
                ->searchable(),

            Column::make('CREATED USER', 'username')
                ->sortable()
                ->searchable(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable(),
                // ->makeInputDatePicker(),

            // Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Lead Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('copy', 'Copy')
                 ->class('btn btn-warning')
                 ->emitTo('leads-component','copy', ['id' => 'id']),

            Button::make('edit', 'Edit')
                 ->class('btn btn-primary')
                 ->emitTo('leads-component','edit', ['id' => 'id']),

             Button::make('delete', 'Delete')
             ->class('btn btn-danger')
             ->emitTo('leads-component','deleteConfirm', ['id' => 'id']),
         ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Lead Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('delete')
                ->when(fn() => auth()->user()->is_admin == 0)
                ->hide(),

            Rule::button('copy')
                ->when(fn() => auth()->user()->is_admin == 0 || auth()->user()->is_admin == 2)
                ->hide(),

            Rule::button('edit')
            ->when(fn($lead) => $lead->user_id != auth()->user()->id && auth()->user()->is_admin == 0)
            ->hide(),
        ];
    }

}
