@extends('layouts_pdf/main')

@section('content')

<b>สิทธิ์ผู้ใช้งาน</b> {{ $adminuser->role->detail }} <br>
<b>ชื่อ-นามสกุล</b> {{ $adminuser->name }} <br>
<b>อีเมล์</b> {{ $adminuser->email }} <br>
<b>เบอร์ติดต่อ</b> {{ $adminuser->tel }} <br>
<b>เพศ</b> {{ $adminuser->gender }} <br>
<b>วันเกิด</b> {{ $adminuser->birthday ? $adminuser->birthday->addYears(543)->format('d/m/Y') : null }} <br>
<b>ที่อยู่</b> {{ $adminuser->address }}

@endsection