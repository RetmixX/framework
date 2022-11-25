<?php

namespace Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTask extends Model{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;
    public $table = "task.product";
}
