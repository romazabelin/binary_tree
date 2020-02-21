<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<script src="{{ asset('js/app.js') }}"></script>

<div class="container">
    <div class="card mb-5">
        <div class="card-body">
            {{ Form::open(['url' => route('binary.store'), 'class' => 'form-horizontal', 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
            <div class="row">
                <div class="col-md-5">
                    {{ trans('translations.form.parent_id') }}
                    {{ Form::select('parent_id', $parentIds, '', ['class' => 'form-control']) }}
                </div>
                <div class="col-md-5">
                    {{ trans('translations.form.position') }}
                    {{ Form::input('number', 'position', 1, ['min' => 1, 'max' => 2, 'class' => 'form-control']) }}
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div class="mt-2">
                {{ Form::submit(trans('translations.form.save'), ['class' => 'btn btn-info']) }}
            </div>
            <div>
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="card mb-5">
        <div class="card-body">
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
        </div>
    </div>
    <div>
        {{ Html::link(route('binary.fill'), trans('translations.form.fill'), ['class' => 'btn btn-info']) }}
        {{ Html::link(route('binary.reset'), trans('translations.form.reset'), ['class' => 'btn btn-info']) }}
    </div>
    <div>
        {!! $tree !!}
    </div>
</div>