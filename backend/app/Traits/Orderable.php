<?php

namespace App\Traits;

trait Orderable
{
  public function scopeLatestFirst($query)
  {
    return $query;
  }

  public function scopeOldestFirst($query)
  {
    return $query->orderBy('created_at', 'asc');
  }
}
