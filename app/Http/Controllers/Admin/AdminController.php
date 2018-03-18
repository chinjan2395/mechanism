<?php namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use Redirect;
use Google_Service_Sheets;

class AdminController extends Controller
{

    /*
    |------------------------------------------------------------------
    |Index page for login
    |------------------------------------------------------------------
    */
    public function index()
    {

        $client = getClient();
        $service = new Google_Service_Sheets($client);

        $spreadsheetId = '1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms';
        $range = 'Class Data!A2:E';
        $spreadsheetId = '1SdHQNLQICcx_qU98Qub06ivsXuPa3mflOfezxw6N8qc';
        $range = 'Users';
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $users = $response->getValues();

        return View('backEnd.admin.index',compact('users'));
    }

}