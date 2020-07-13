<?php

use App\Token;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/logout', function () {
    session()->forget('zohotoken');
    return redirect()->route('home');
})->name('logout');

Route::get('/authenticated', function () {
    $params = request()->validate([
        'code' => 'required',
    ]);

    $response = Zoho::getToken($params['code']);

    if(isset($response['access_token'])) {
        $tokenObj = new Token($response['access_token'],$response['expires_in']);
    
        session()->put('zohotoken',$tokenObj);
    
        return redirect()->route('entityList');
    }
    else {
        session()->flash('status', 'error');
        
        return redirect()->route('result');
    }

});

Route::middleware('zohotoken')->group(function () {

    Route::get('/leads', function () {
        $entities = Zoho::getEntities();
        return view('list-lead')->with('entities',$entities);
    })->name('entityList');
    
    Route::get('/leads/edit/{id}', function ($id) {
        $entity = Zoho::getEntity($id);
        return view('edit-lead')->with('entity',$entity);
    })->name('entityEdit');
    
    Route::post('/leads/edit/{id}', function ($id) {
        $validate = request()->validate([
            'Last_Name' => 'required',
            'First_Name' => '',
        ]);
    
        $validate['id'] = $id;
    
        $status = Zoho::updateEntity($validate) == true ?  'success' : 'error';
    
        session()->flash('status', $status);
        
        return redirect()->route('result');
    });
    
    Route::get('/leads/fields', function () {
        $fields = Zoho::getFields();
        
        if(empty($fields)) {
            session()->flash('status', 'error');
            return redirect()->route('result');
        }

        return view('fields-list')->with('fields',$fields);
    })->name('fieldsList');
    
    Route::post('/leads/new', function () {
        request()->validate([
            'Last_Name' => 'required'
        ]);
    
        $data = request()->post();
    
        $status = Zoho::createEntity($data) == true ?  'success' : 'error';
    
        session()->flash('status', $status);
        
        return redirect()->route('result');
    });

    Route::get('/leads/new', function () {
        $fields = Zoho::getFields();

        if(empty($fields)) {
            session()->flash('status', 'error');
            return redirect()->route('result');
        }

        return view('create-lead')->with('fields',$fields);

        return view('create-lead');
    })->name('entityCreate');

    Route::get('/leads/delete/{id}', function ($id) {

        $status = Zoho::deleteEntity($id) == true ?  'success' : 'error';

        session()->flash('status', $status);
        
        return redirect()->route('result');
    });
    
    Route::get('/result', function () {
        return view('messages');
    })->name('result');

});







