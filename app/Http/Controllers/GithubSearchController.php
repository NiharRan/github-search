<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GithubSearchController extends Controller
{
    public function index()
    {
        return view('welcome');
    }


    public function search(Request $request)
    {
        if ($request->q == '') {
            return response()->json(null);
        }
        $response = Http::get("https://api.github.com/search/users?q=$request->q");
        return $response->json();
    }


    public function getUserInfo($name)
    {
        if ($name == '') {
            return response()->json(null);
        }

        $response = Http::get("https://api.github.com/users/$name");
        $data = $response->object();
        $repo_data = Http::get($data->repos_url);
        $data->repos = $repo_data->object();
        return response()->json($data);
    }
}
