<?php

namespace IbrahimBougaoua\FilamentTrace\Observers;

use IbrahimBougaoua\FilamentTrace\Models\Trace;

class GeneralObserver
{
    public function created($model)
    {
        Trace::create([
            'name' => class_basename($model),
            'model' => get_class($model),
            'content' => $model::with('user'),
            'action' => 'created'
        ]);
    }

    public function updated($model)
    {
        Trace::create([
            'name' => class_basename($model),
            'model' => get_class($model),
            'content' => $model,
            'action' => 'updated'
        ]);
    }

    public function deleted($model)
    {
        Trace::create([
            'name' => class_basename($model),
            'model' => get_class($model),
            'content' => $model,
            'action' => 'deleted'
        ]);
    }

    public function restored($model)
    {
        Trace::create([
            'name' => class_basename($model),
            'model' => get_class($model),
            'content' => $model,
            'action' => 'restored'
        ]);
    }
}
