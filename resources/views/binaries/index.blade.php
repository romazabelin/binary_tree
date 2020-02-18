{{ Form::open(['url' => route('binary.store'), 'class' => 'form-horizontal', 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}

<div>
    {{ trans('translations.form.parent_id') }}
    {{ Form::select('parent_id', $parentIds) }}
</div>
<div>
    {{ trans('translations.form.position') }}
    {{ Form::input('number', 'position', 1, ['min' => 1, 'max' => 2]) }}
</div>
<div>
    {{ Form::submit(trans('translations.form.save')) }}
</div>
<div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div>
{{ Form::close() }}