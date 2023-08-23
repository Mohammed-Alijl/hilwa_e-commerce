<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Product;

class ProductRepository implements BasicRepositoryInterface
{
  public function getAll()
  {
      return Product::get();
  }

  public function find($id)
  {
      // TODO: Implement find() method.
  }

  public function create($request)
  {
      // TODO: Implement create() method.
  }

  public function update($request, $id)
  {
      // TODO: Implement update() method.
  }

  public function delete($id)
  {
      // TODO: Implement delete() method.
  }

  public function getActiveProducts(){
      return Product::where('status',1)->get();
  }
}
