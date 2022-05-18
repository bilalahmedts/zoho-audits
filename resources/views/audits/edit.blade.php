
@extends('layouts.app')

@section('title', 'Edit Audits')


@section('content')

<div class="back-area mb-3">
    <a href="{{ route('audits.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-2"></i> Go Back</a>
</div>

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Audits</h3>
    </div>

    <form action="{{ route('audits.update', $audit) }}" method="post" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Agent Name</label>
                <select name="user_id" class="form-control select2" required>
                    <option value="">Select Option</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $audit->user_id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Zoho Id</label>
                <input type="text" class="form-control" name="zoho_id" value="{{ $audit->zoho_id }}">
            </div>
            <label for="exampleInputEmail1">Evaluation Status</label><br>
                <div class="icheck d-inline">
                  <input type="radio" name="evaluationStatus" value="Passed" @if ($audit->evaluationStatus == 'Passed') checked @endif>
                  <label for="radioSuccess1">
                      Passed
                  </label>
                </div>
                <div class="icheck d-inline">
                  <input type="radio" name="evaluationStatus" value="Failed" @if ($audit->evaluationStatus == 'Failed') checked @endif>
                  <label for="radioSuccess2">
                      Failed
                  </label>
                </div>
            <div class="form-group">
                <label>Comments</label>
                <textarea name="comments" class="form-control" rows="3">{{ $audit->comments }}</textarea>
              </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- /.card-footer-->

    </form>
</div>
<!-- /.card -->

@endsection
