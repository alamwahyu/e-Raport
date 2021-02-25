<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
	public function index(Request $request)
	{
		if($request->has('cari')){
			$data_guru = \App\Guru::where('nama','LIKE','%'.$request->cari.'%')->get();
		}
		else{
			$data_guru = \App\Guru::all();
		}
    return view('guru.index',['data_guru' => $data_guru]);
	}

	public function create(Request $request)
	{
		\App\Guru::create($request->all());
		return redirect('/guru')->with('sukses','DATA GURU BERHASIL DITAMBAHKAN');
	}

	public function edit($id)
	{
		$guru = \App\Guru::find($id);
		return view('guru/edit',['guru' => $guru]);
	}

	public function update(Request $request, $id)
	{
		$guru = \App\Guru::find($id);
		$guru->update($request->all());
		return redirect('/guru')->with('sukses','DATA GURU BERHASIL DIUBAH');
	}

	public function delete($id)
	{
		$guru = \App\Guru::find($id);
		$guru->delete($guru);
		return redirect('/guru')->with('sukses','DATA GURU BERHASIL DIHAPUS');
	}
	public function profile(Guru $guru){
    	return view('guru.profile',['guru' => $guru]);
    }
}
