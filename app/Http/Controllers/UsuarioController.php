<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{

    public function getUsers(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar; 

        $criterio = $request->criterio;

        if ($buscar == '') {
            $usuarios =  DB::table('users')
                ->select('users.id','users.identification', 'users.document_type', 'users.names', 'users.surnames', 'users.email', 'users.status', 'users.id_category', 'users.phone', 'category_user.name AS nombreCategoria', 'users.id_category AS idCategoria')
                ->join('category_user', 'category_user.id', '=', 'users.id_category')
                ->where('users.id', '!=', auth()->id())
                ->orderBy('users.id', 'desc')
                ->paginate(3);
        } else {
            $usuarios =  DB::table('users')
                ->select('users.id','users.identification', 'users.document_type', 'users.names', 'users.surnames', 'users.email', 'users.status', 'users.id_category', 'users.phone', 'category_user.name AS nombreCategoria', 'users.id_category AS idCategoria')
                ->join('category_user', 'category_user.id', '=', 'users.id_category')
                ->orderBy('users.id', 'desc')
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->where('users.id', '!=', auth()->id())
                ->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $usuarios->total(),
                'current_page' => $usuarios->currentPage(),
                'per_page'     => $usuarios->perPage(),
                'last_page'    => $usuarios->lastPage(),
                'from'         => $usuarios->firstItem(),
                'to'           => $usuarios->lastItem(),
            ],
            'usuarios' => $usuarios
        ];
    }

    public function getCategory(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categorias = DB::table('category_user')
            ->select('id', 'name')
            ->get();
        return ['categorias' => $categorias];
    }

    public function registerUser(CreateUserRequest $request)
    {
        $user = new User();
        $user->identification = $request->identification;
        $user->document_type = $request->document_type;
        $user->names = $request->names;
        $user->surnames = $request->surnames;
        $user->email = $request->email;
        $user->password = bcrypt($request->id);
        $user->phone = $request->phone;
        $user->status = true; //1 Es activo 
        $user->id_category = $request->id_category;
        $user->save();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function chanceState(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($id);
        $user->status = $request->accion;
        $user->save();
    }

    public function updateUser(UpdateUserRequest $request)
    {
        if (!$request->ajax()) return redirect('/');
        $client = User::findOrFail($request->id);
        $client->names = $request->names;
        $client->surnames = $request->surnames;
        $client->phone = $request->phone;
        $client->save();
    }
}
