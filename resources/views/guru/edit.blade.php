@extends('layouts.master')

@section('content')

		@if(session('sukses'))
			<div class="alert alert-success" role="alert">
		  {{session('sukses')}}
			</div>
		@endif

<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">

						<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">UBAH DATA GURU</h3>
								</div>
								<div class="panel-body">
			
			 	        <form action="/guru/{{$guru->id}}/update" method="POST">
				        	{{csrf_field()}}
						  <div class="form-group">
						    <label for="exampleInputEmail1">Nama Guru</label>
						    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Guru" value="{{$guru->nama}}">
						  </div>

						  <div class="form-group">
						    <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
						    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
						      <option value="L" @if($guru->jenis_kelamin == 'L') selected @endif>Laki-laki</option>
						      <option value="P" @if($guru->jenis_kelamin =='P') selected @endif>Perempuan</option>
						    </select>
						  </div>

						  <div class="form-group">
						    <label for="exampleFormControlTextarea1">Alamat</label>
						    <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3">{{$guru->alamat}}</textarea>
						  </div>
						  
						  <div class="form-group">
						    <label for="exampleInputEmail1">Umur</label>
						    <input type="text" name="umur" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="umur" value="{{$guru->umur}}">
						  </div>
						
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				        </form>
				    </div>
				</div>
			</div>
		</div>
					

					  


@endsection