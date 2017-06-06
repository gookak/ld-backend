@extends('layouts_pdf/main')

@section('content')


<table boder="0" cellspacing="0">
    <tbody>
        <tr>
            <td class="center"><b>{{ $report->name }}</b></td>
        </tr>
        <tr><td class="center">ประจำวันที่ {{ $report->create_date }} </td>
        </tr>
    </tbody>
</table>

<table class="one" cellspacing="0">
    <thead>
      <tr>
        <th>ชื่อ-นามสกุล</th>
        <th>อีเมล์</th>
        <th>เบอร์ติดต่อ</th>
        <th>สิทธิ์ผู้ใช้งาน</th>
    </tr>
</thead>
<tbody>
    @if( $employees )
    @foreach( $employees as $employee )
    <tr>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->email }}</td>
        <td class="center">{{ $employee->tel }}</td>
        <td class="center">{{ $employee->role->detail }}</td>
    </tr>
    @endforeach
    @endif
</tbody>
{{-- <tfoot>
  <tr>
      <td colspan="4" class="right">รวม</td>
  </tr>
</tfoot> --}}
</table>

@endsection