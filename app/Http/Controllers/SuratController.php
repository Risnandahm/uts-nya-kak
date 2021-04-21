<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Surat::latest()->paginate(5);
    
        return view('surat_masuk.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat_masuk.create');
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
            'no_surat' => 'required',
            'tgl_surat' => 'required',
            'pengirim' => 'required',
        ]);
    
        Surat::create($request->all());
     
        return redirect()->route('surat_masuk.index')
                        ->with('success','Surat created successfully.');
    }


    public function edit(Surat $surat_masuk)
    {
        return view('surat_masuk.edit',compact('surat_masuk'));
    }


    public function update(Request $request, Surat $surat_masuk)
    {
        $request->validate([
            'no_surat' => 'required',
            'tgl_surat' => 'required',
            'pengirim' => 'required',
        ]);
    
        $surat_masuk->update($request->all());
    
        return redirect()->route('surat_masuk.index')
                        ->with('success','Surat updated successfully');
    }


    public function destroy(Surat $surat_masuk)
    {
        $surat_masuk->delete();
    
        return redirect()->route('surat_masuk.index')
                        ->with('success','Surat deleted successfully');
    }
}
