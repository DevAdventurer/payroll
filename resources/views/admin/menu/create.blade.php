@extends('admin.layouts.master')

@push('links')
@endpush

@section('main')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h5 class="content-header-title mb-0">Create Menu</h5>
    </div>

    <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                @can('add_menu')
                    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary btn-sm">Add Menu</a>
                @endcan
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <div class="card-body">
            {{ html()->form('POST', route('admin.'.request()->segment(2).'.store'))->class('form-horizontal')->open() }}

            <div class="form-group">
                {{ html()->label('Menu Name')->for('name')->class('control-label') }}
                {{ html()->text('name')->class('form-control')->required()->placeholder('Enter Menu Name')->value(old('name')) }}
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                {{ html()->label('Icon')->for('icon')->class('control-label') }}
                {{ html()->text('icon')->class('form-control')->required()->placeholder('Enter Icon')->value(old('icon')) }}
                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                {{ html()->label('Status')->for('status')->class('control-label') }}
                {{ html()->select('status', [1 => 'Active', 0 => 'Deactive'])->class('form-control')->id('menu_status')->value(old('status')) }}
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                {{ html()->submit('Create')->class('btn btn-primary') }}
            </div>

            {{ html()->form()->close() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
