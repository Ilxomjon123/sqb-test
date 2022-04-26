@extends('layouts.app')

@section('content')
<a href="/database" class="btn btn-success"
  onclick="document.getElementById('warning-message').innerHTML = 'It may take 2-3 minutes'">Generate Data for Next 30
  days</a>
<span id="warning-message"></span>
<form action="" class="row gy-2 gx-0 align-items-center float-end">
  <div class="col-auto">
    <input type="date" name="date" id="datePicker" class="form-control"
      value="{{ request()->get('date', date('Y-m-d')) }}" onchange="this.form.submit()" />
  </div>
</form>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Value</th>
      <th scope="col">Code</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($result as $index => $item)
    <tr>
      <th scope="row">{{ $index + 1 }}</th>
      <td>{{ $item->name }}</td>
      <td>{{ $item->value }}</td>
      <td>{{ $item->charCode }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection