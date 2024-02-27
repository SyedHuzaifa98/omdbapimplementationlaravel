<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Models\cars;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\JoinClause;
use PhpParser\ErrorHandler\Collecting;
use Illuminate\Support\Collection;
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

Route::get('/',function (){
    return redirect("movie");
});
Route::resource("movie", MovieController::class);


// Route::get('/cars/{id}', function ($id) {
//     // DB::enableQueryLog();
//     $data = Cars::with('carModels')->find($id);

//     // $queries = DB::getQueryLog();
//     // dd($queries);



//     // DB::enableQueryLog();
//     // $data = DB::table('cars')
//     //     ->select('*')
//     //     ->join('car_models', 'cars.id', '=', 'car_models.car_id')
//     //     ->get();

//     // $queries = DB::getQueryLog();
//     // dd($queries);
//     return view('cars.show')->with('car1', $data);
// });



// Route::get('player/{id}', function ($id) {
//     try {
//         $country = Country::findOrFail($id);
//         $players = $country->players;
//         $data = 'Player Name | ' . 'Country' . '<br>';

//         foreach ($players as $p) {
//             $data .= ($p->name . ' ' . $p->country->name) . '<br>';
//         }
//         return $data;
//     } catch (Exception $e) {
//         dd($e->getMessage());
//     }
// });


// Route::get('countryR/{id}', function ($id) {
//     try {
//         $country = Country::findorFail($id);
//         $rep = $country->un_representative;
//         $data = 'Country | ' . 'Representative ' . '<br>';
//         $data .= ($rep->country->name . ' ' . $rep->name) . '<br>';
//         return $data;
//     } catch (Exception $e) {
//         dd($e->getMessage());
//     }
// });

// Route::post('file_upload', [MovieController::class, 'file_upload']);



// Route::get('test', function () {
//     // Select *
//     // $data = DB::table('countries')->get();
//     // foreach($data as $d){
//     //     echo $d->name.",".$d->size."<br>";
//     // }


//     // $data = DB::table('players')->where('id','>','2')->get();  // get multiple necessary use get

//     // $data = DB::table('players')->where('id','>','2')->first(); // get first only not need get()

//     // $data = DB::table('players')->where('id','>','2')->value('name'); // get single also only name column

//     // $data = DB::table('players')->find(1); // get by id 

//     // $data = DB::table('players')->where('id','>','2')->pluck('name'); // get multiple row but only single columns for all

//     // foreach ($data as $title) {
//     //     echo $title."<br>";
//     // }



//     // DB::table('players')->orderBy('id')->chunk(3,function(Collection $collection){ 
//     //     foreach($collection as $c){   // this will get data in chunks in 3 ..3 items per round
//     //         echo  $c->name;
//     //     }
//     //     return false;
//     // });




//     // Aggregates

//     // $count = DB::table('players')->count();  // count records
//     // dd($count);


//     // $max = DB::table('players')->max('country_id');  // maximum country_id
//     // dd($max);


//     // exist , not exist

//     // $check = DB::table('players')->where('country_id',10)->exists();  // exist
//     // $check = DB::table('players')->where('country_id',10)->doesntExist(); // not exist
//     // dd($check);


//     // $data = DB::table('players')->select('id','name')->get();  // select
//     // dd($data);


//     //  $data = DB::table('players')->distinct()->get();  // select
//     //  dd($data);


//     // $data = DB::table('players')->select('name');  
//     // $data = $data->addSelect('country_id')->get(); // addSelect when adding another select clause
//     // dd($data);



//     // Raw Expressions


//     // $data = DB::table('players')
//     //         ->select(DB::raw("id,name")) // we can also select columns or add query in string
//     //         ->addSelect('country_id')
//     //         ->where('name','like','%t')
//     //         ->get();
//     // dd($data);



//     // Raw Methods



//     // $data = DB::table('players')
//     //         // in selectRaw we dont need to use DB::raw , also we can provide external value
//     //         ->selectRaw("name as Cricketers, country_id * ? as CountryID",[10]) 
//     //         ->get();
//     // dd($data);



//     // $data = DB::table('players')
//     //         ->selectRaw("*")
//     //         ->whereRaw("country_id > ? and name = ?",[1,'Babar'])
//     //         ->get();
//     // dd($data);






//     // $data = DB::table('players')
//     //         ->selectRaw("*")
//     //         ->whereRaw("country_id > ?",[0])
//     //         ->orderByRaw("id DESC")
//     //         ->get();
//     // dd($data);




//     // Joins
//     // Inner Join Clause



//     // $data  =  DB::table("players")
//     //           ->join("countries","players.country_id","=","countries.id")
//     //           // i use alias for name because both columns have same column name
//     //           ->select('players.name as players','countries.name as country') 
//     //           ->get();
//     // dd($data);




//     // $data =  DB::table('players')
//     //         ->leftJoin("countries","players.country_id","countries.id")
//     //         ->select("players.name as Players","countries.name as Country")
//     //         ->get();
//     // dd($data);




//     // $data = DB::table("players")
//     //     ->join('countries', function (JoinClause $join) {
//     //         $join->on('players.country_id', '=', 'countries.id');
//     //     })
//     //     ->select("players.name as Players","countries.name as Country")
//     //     ->get();
//     // dd($data);





// });
