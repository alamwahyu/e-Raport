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
									<h3 class="panel-title">DATA GURU</h3>
									<div class="right">
										<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
									  Tambah Data Guru
									</button>
									</div>
						
				<!-- Button trigger modal -->
									
							
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Jenis Kelamin</th>
												<th>Alamat</th>
												<th>Umur</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												@foreach($data_guru as $guru)
												<td>{{$guru->nama}}</td>
												<td>{{$guru->jenis_kelamin}}</td>
												<td>{{$guru->alamat}}</td>
												<td>{{$guru->umur}}</td>
												<td>
													<a href="/guru/{{$guru->id}}/edit" class="btn-warning btn-sm">Edit</a>
													<a href="/guru/{{$guru->id}}/delete" class="btn-danger btn-sm" onclick="return confirm('Yakin Data ingin dihapus? ')">Delete</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Input Data Siswa</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <form action="/guru/create" method="POST">
				        	{{csrf_field()}}
						  <div class="form-group">
						    <label for="exampleInputEmail1">Nama Guru</label>
						    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Guru">
						  </div>

						  <div class="form-group">
						    <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
						    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
						      <option value="L">Laki-laki</option>
						      <option value="P">Perempuan</option>
						    </select>
						  </div>

						  <div class="form-group">
						    <label for="exampleFormControlTextarea1">Alamat</label>
						    <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"></textarea>
						  </div>
						  
						  <div class="form-group">
						    <label for="exampleInputEmail1">Umur</label>
						    <input type="text" name="umur" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="umur">
						  </div>
						
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				        </form>
					      </div>
					    </div>
					  </div>

@stop
