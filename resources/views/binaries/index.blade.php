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
<div>
    {{ Html::link(route('binary.fill'), trans('translations.form.fill')) }}
</div>
<div>
    {{ Html::link(route('binary.reset'), trans('translations.form.reset')) }}
</div>
<div>
    {!! $tree !!}
</div>
{{ Form::close() }}

{{ Form::open(['url' => route('binary.get_items'), 'class' => 'form-horizontal', 'method'=>'POST']) }}
{{ Form::select('id', $parentIds, $bothSideId) }}
{{ Form::submit(trans('translations.form.get')) }}
<div>
    {{ trans('translations.form.under') }}:
    @foreach($underItems as $underItem)
    {{ $underItem }};
    @endforeach
</div>
<div>
    {{ trans('translations.form.above') }}:
    @foreach($aboveItems as $aboveItem)
    {{ $aboveItem }};
    @endforeach
</div>
{{ Form::close() }}