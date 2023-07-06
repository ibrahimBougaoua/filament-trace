<?php

namespace IbrahimBougaoua\FilamentTrace\Traits;

trait Multitenantable
{
    protected static function bootMultitenantable(): void
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}