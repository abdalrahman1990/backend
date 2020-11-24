<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ExpenseManagement extends Model
{
    public function getCategoryList(){
        $record = DB::table('categories')
                        ->select('*')
                        ->get();

        return $record;
    }

    public function addExpense($data){
        DB::table('expense_list')->insert($data);
    }

    public function userExpenseList($user_id){
        return DB::table('expense_list')
                        ->select('expense_list.id','expense_list.expense_title','expense_list.cost','expense_list.category', 'expense_list.date', 'expense_list.added_on')
                        ->where('expense_list.user_id', '=', $user_id)
                        ->get();
    }
}
