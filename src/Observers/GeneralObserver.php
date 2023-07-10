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
            'content' => $model,
            'action' => 'Created',
        ]);
    }

    public function updated($model)
    {
        Trace::create([
            'name' => class_basename($model),
            'model' => get_class($model),
            'content' => $model,
            'action' => 'Updated',
        ]);
    }

    public function deleted($model)
    {
        Trace::create([
            'name' => class_basename($model),
            'model' => get_class($model),
            'content' => $model,
            'action' => 'Deleted',
        ]);
    }

    public function restored($model)
    {
        Trace::create([
            'name' => class_basename($model),
            'model' => get_class($model),
            'content' => $model,
            'action' => 'Restored',
        ]);
    }
}
