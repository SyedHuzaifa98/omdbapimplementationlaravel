<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Movie::where('deleted_at',null)->get();

        return view("home", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->movieName,
            'url' => '',
            'year' => $request->movieYear
        ];

        Movie::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    function file_get_contents_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
    public function show(Request $request)
    {
        // dd($request->all());
        $apiKey = '3f2f8cda';
       $api = "https://www.omdbapi.com/?t=".$request->name."&y=".$request->year."&apikey=".$apiKey;
      // dd($api);
        $curlInit = curl_init();
        curl_setopt($curlInit, CURLOPT_URL, $api);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        $serverResponse = curl_exec($curlInit);

        $serverResponse = json_decode($serverResponse, true);
//dd($serverResponse);
        $response = $serverResponse['Response'];

        
        if ($response == 'True') {
            if($serverResponse['Poster'] != "N/A"){
                $title = $serverResponse['Title'];
                $url = $serverResponse['Poster'];
                $releaseDate = date('Y-m-d', strtotime($serverResponse['Released']));
                $movieType = $serverResponse['Genre'];
                $language = $serverResponse['Language'];
                $year = Str::slug($serverResponse['Year'], ' ');
                $extention = pathinfo($url, PATHINFO_EXTENSION);
                $slug = Str::slug($title, ' ');
                if (Storage::exists("uploads/" . $slug)) {
                    dd("Exist");
                } else {
                    $slug = ($slug.'('.$year.')');
                    Storage::disk('public')->makeDirectory("uploads/" . $slug);
                    $data = $this->file_get_contents_curl($url);
                    $imagePath = "uploads/{$slug}/{$title}.{$extention}";
                    Storage::disk('public')->put($imagePath, $data);
                    Movie::where('name','=', $title)
                    ->where('year','=',$year)
                    ->update(
                        ['url' => $imagePath, 
                        'releasedDate' => $releaseDate, 
                        'movieType' => $movieType, 
                        'language' => $language
                    ]);
                }
                return redirect()->route('movie.index');
            }
            else{
                dd("Movie Poster Not found");
            }
        } else {
            dd("Movie Not Found");
        }

        curl_close($curlInit);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Movie::find($id);
        return view('edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Movie::where('id', $id)->update(['name' => $request->movieName,'year' => $request->movieYear, 'url' => '', 'releasedDate' => null, 'movieType' => null, 'language' => null]);
        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
       $data = Movie::find($id);
       $data->delete();
       return redirect('movie');
    }



    public function file_upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:txt'
        ]);
        $file = $request->file('file');

        $fileContent = file_get_contents($file);
    
        // Explode the content into an array using newline characters
        $moviesArray = explode("\n", $fileContent);
        foreach($moviesArray as $item){
            $data = [
                'name' => $item,
                'url' => '',
                'year' => 0
            ];
            Movie::create($data);
        }
        return redirect()->back();
    }
}
