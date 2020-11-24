<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\UserManagement;
use App\Models\ExpenseManagement;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{

    public function __construct(){
        auth()->setDefaultDriver('api');
    }


    public function getCategories(){
        $db = new ExpenseManagement();
        $response = array('status'=> 'success', 'categoryList'=>$db->getCategoryList());
        return $response;
    }


    public function addExpense(Request $request)
    {
        $data['user_id'] = auth()->id();
        $data['expense_title'] = $request->expenseTitle;
        $data['expense_description'] = $request->expenseDescription;
        $date = str_replace('/', '-', $request->date);
        $data['date'] = date('Y-m-d', strtotime($date));
        $data['cost'] = $request->cost;
        $data['category'] = $request->category;

        $db = new ExpenseManagement();
        $db->addExpense($data);

        $response = array('status'=> 'success', 'message'=>'Expense added to the list.');
        return $response;
    }

    public function getUserExpenseList(){
        if(!empty(auth()->id())){
            $db = new ExpenseManagement();
            $result = $db->userExpenseList(auth()->id());
            $response = array('status'=> 'success', 'list'=>$result);
        }else{
            $response = array('status'=> 'Error', 'message'=>'User not loged in');
        }

        return $response;
    }
}
