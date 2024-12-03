<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\Post;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_logo' => 'required|string|max:255',
            'image_logo' => 'required|image',
            'image_banner' => 'required|image',
        ]);
        
        // Guardar el logo
        $imagePath_logo = $request->file('image_logo')->store('dashboards', 'public');
        
        // Guardar el banner
        $imagePath_banner = $request->file('image_banner')->store('dashboards', 'public');
        
        // Crear el dashboard con logo y banner
        Dashboard::create([
            'title_logo' => $request->title_logo,
            'image_logo' => $imagePath_logo,
            'image_banner' => $imagePath_banner,
        ]);
        
        return redirect()->route('admin.dashboard.index')->with('success', 'Dashboard creado exitosamente.');
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
    public function update(Request $request, Dashboard $dashboard)
    {
        //
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
