<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['kode','nama','nilai'];

    public function mapel(){
    	return $this->hasMany(Mapel::class);
    }}
