<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\Post;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public $totalComments;
    public $model;
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index()
     {
         // Obtener los 10 posts más comentados
         $posts = Post::withCount('questions')
             ->orderBy('questions_count', 'desc') // Ordenar por el número de comentarios
             ->take(10)
             ->get();
     
         // Calcular la suma total de los comentarios de esos 10 posts
         $totalComments = $posts->sum('questions_count'); // Usamos el atributo 'questions_count'
     
         // Otros datos necesarios para el dashboard
         $questions = Question::all();
         $users = User::all();
         $dashboard = Dashboard::all();
     
         return view('admin.dashboard.index', compact('dashboard', 'users', 'posts', 'questions', 'totalComments'));
     }
     
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view('admin.dashboard.create');
}

    public function edit(Dashboard $dashboard)
    {
      
        return view('admin.dashboard.edit', compact('dashboard'));
    }
    


    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    // public function edit(Dashboard $dashboard)
    // {
       
    //     return view('admin.dashboard.edit', compact('dashboard'));
    // }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dashboard = Dashboard::findOrFail($id);
    
        // Validar las imágenes
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB máximo
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Subir el logo si está presente
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $dashboard->image_path_logo = $logoPath;
        }
    
        // Subir el banner si está presente
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $dashboard->image_path_banner = $bannerPath;
        }
    
        // Actualizar otros campos si es necesario
        $dashboard->title_logo = $request->input('title_logo', $dashboard->title_logo);
    
        $dashboard->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El dashboard fuè actualizado corretamente'
        ]);
    
        return redirect()->route('admin.dashboard.index');
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
