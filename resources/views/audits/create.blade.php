@extends('layouts.app')

@section('title', 'Create Audit')

@section('content')

    {{-- @if ($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif --}}

    <div class="back-area mb-3">
        <a href="{{ route('audits.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-2"></i>
            Go
            Back</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Audits</h3>
        </div>
        <form action="{{ route('audits.store') }}" method="post" autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Agent Name</label>
                    <select name="user_id" class="form-control select2">
                        <option value="">Select Option</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->campaign->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('user_id')
                    <div class="validate-error">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="exampleInputEmail1">Zoho Id</label>
                    <input type="text" class="form-control" name="zoho_id">
                </div>
                @error('zoho_id')
                    <div class="validate-error">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="exampleInputEmail1">Evaluation Status</label>
                    <div class="icheck d-inline">
                        <input type="radio" name="evaluationStatus" value="Passed">
                        <label for="radioSuccess1">
                            Passed
                        </label>
                    </div>
                    <div class="icheck d-inline">
                        <input type="radio" name="evaluationStatus" value="Failed">
                        <label for="radioSuccess2">
                            Failed
                        </label>
                    </div>
                    @error('evaluationStatus')
                        <div class="validate-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Comments</label>
                    <textarea name="comments" class="form-control" rows="3"></textarea>
                </div>
                @error('comments')
                    <div class="validate-error">{{ $message }}</div>
                @enderror
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <!-- /.card-footer-->
        </form>
    </div>
@endsection
