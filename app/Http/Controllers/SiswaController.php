<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SiswaController extends Controller
{
	public function index(Request $request)
	{
		if($request->has('cari')){
			$data_siswa = \App\Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
		}else{
			$data_siswa = \App\Siswa::all();
		}
		return view('siswa.index',['data_siswa' => $data_siswa]);
	}    

	public function create(Request $request)
	{
		$this->validate($request,[
            'nama_depan' => 'required|min:5', 
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',   
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            //'avatar' => 'mimes:jpeg,png'
        ]);
		
		$user = new \App\User;
		$user->role = 'siswa';
		$user->name = $request->nama_depan;
		$user->email = $request->email;
		$user->password = bcrypt('123456');
		$user->remember_token = str_shuffle(60);
		$user->save();

		$request->request->add(['user_id' => $user->id]);
		$siswa = \App\Siswa::create($request->all());
		if($request->hasFile('avatar')){
			$request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
			$siswa->avatar = $request->file('avatar')->getClientOriginalName();
			$siswa->save();
		}
		return redirect('/siswa')->with('sukses','DATA BERHASIL DITAMBAHKAN');
	}
	public function edit($id)
	{
		$siswa = \App\Siswa::find($id);
		return view('siswa/edit',['siswa' => $siswa]);
	}
	public function update(Request $request,$id)
	{
		$siswa = \App\Siswa::find($id);
		$siswa->update($request->all());
		if($request->hasFile('avatar')){
			$request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
			$siswa->avatar = $request->file('avatar')->getClientOriginalName();
			$siswa->save();
		}
		return redirect('/siswa')->with('sukses','DATA BERHASIL DI UBAH');
	}
	public function delete($id)
	{
		$siswa = \App\Siswa::find($id);
		$siswa->delete($siswa);

		return redirect('/siswa')->with('sukses','DATA BERHASIL DIHAPUS');
	}

	public function profile($id)
	{
		$siswa = \App\Siswa::find($id);
		$matapelajaran = \App\Mapel::all();
		$category = \App\Kategori::all();

		//data chart
		$kategori =[];
		$data = [];
		foreach ($matapelajaran as $mp) {
			if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){

			$kategori[] = $mp->nama;
			$data[] = $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
			}
		}
		
		//dd($hasil);
		//dd($data);
		return view('siswa.profile',['siswa' => $siswa,'matapelajaran' => $matapelajaran,'kategori'=> $kategori, 'data' => $data, 'category' => $category]);
	}

	public function addnilai(Request $request, $idsiswa)
	{
		$siswa = \App\Siswa::find($idsiswa);
		if($siswa->mapel()->where('mapel_id',$request->mapel)->exists())
		{
			return redirect('siswa/'.$idsiswa.'/profile')->with('error','DATA MATPEL SUDAH ADA');
		}
		$siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);

		return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','DATA BERHASIL DITAMBAH');
	}

	public function deletenilai($idsiswa,$idmapel){
        $siswa = \App\Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses','NILAI BERHASIL DIHAPUS');
    }
    public function exportExel() 
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }
    public function exportPdf(){
        $siswa = \App\Siswa::all();
        $pdf = PDF::loadView('export.siswapdf',['siswa' => $siswa]);
        return $pdf->download('Siswa.pdf');
    }
}
