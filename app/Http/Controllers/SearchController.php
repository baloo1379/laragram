<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function search()
    {
        $q = Input::get('q', '');
        $usersResult = Collection::make([]);
        $tagsResult = Collection::make([]);
        if ($q[0] == '@') {
            // searching user
            $name = substr($q, 1);
            $users = User::where('name', 'like', '%' . $name . '%')->get()->pluck('id')->toArray();
            $profiles = Profile::where('title', 'like', '%' . $name . '%')->get()->pluck('user_id')->toArray();
            $id = array_unique(array_merge($users, $profiles), SORT_REGULAR);
            $usersResult = User::whereIn('id', $id)->get();
        } elseif ($q[0] == '#') {
            // searching tag
            $tagsResult = Tag::where('name', 'like','%'.$q.'%')->get();
        } else {
            $tagsResult = Tag::where('name', 'like', '%'.$q.'%')->get();
            $users = User::where('name', 'like', '%' . $q . '%')->get()->pluck('id')->toArray();
            $profiles = Profile::where('title', 'like', '%' . $q . '%')->get()->pluck('user_id')->toArray();
            $id = array_unique(array_merge($users, $profiles), SORT_REGULAR);
            $usersResult = User::whereIn('id', $id)->get();
        }

        $result = Collection::make([[$usersResult, $tagsResult]])->flatten()->sortBy('name');
            //([$usersResult, $tagsResult])->sortByDesc('name');

        dd($result);

        return view('search', [
            'users' => $usersResult,
            'tags' => $tagsResult
        ]);
    }
}
