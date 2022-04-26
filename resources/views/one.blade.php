@extends('layouts.app')

@section('content')
<form action="" class="row gy-2 gx-0 align-items-center float-end">
  <div class="col-auto">
    <select name="valuteID" id="valute-id" class="form-control" onchange="this.form.submit()">
      @foreach ($valutes as $item)
      <option value="{{ $item->valuteID }}">{{ $item->name . ' (' . $item->charCode . ')' }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-auto">
    <input type="date" name="from" id="from-date" class="form-control"
      value="{{ request()->get('from', date('Y-m-d')) }}" onchange="this.form.submit()" />
  </div>
  <div class="col-auto">
    <input type="date" name="to" id="to-date" class="form-control" value="{{ request()->get('to', date('Y-m-d')) }}"
      onchange="this.form.submit()" />
    <script>
      const valute = @json(request()->get('valuteID', 'R01235'));
      document.getElementById('valute-id').value = valute;
    </script>
  </div>
</form>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Value</th>
      <th scope="col">Code</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($result as $index => $item)
    <tr>
      <th scope="row">{{ $index + 1 }}</th>
      <td>{{ $item->date }}</td>
      <td>{{ $item->value }}</td>
      <td>{{ $item->charCode }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection