@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h4 class="tittle-w3layouts">{{ $title }}</h4>
    <hr>

    @if (app()->environment('production'))
        <div class="text-center" style="margin-bottom: 10px;">
            @include('partials.ads.responsive')
        </div>
    @endif

    <upload-form></upload-form>

    </div>
</div>

<div class="modal fade" tabindex="-1" id="rules" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Terms &amp; Conditions</h4>
      </div>
      <div class="modal-body">
        @include('partials.rule')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
