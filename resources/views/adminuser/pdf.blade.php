@extends('layouts_pdf/main')

@section('content')

<b>สิทธิ์ผู้ใช้งาน</b> {{ $adminuser->role->detail }} <br>
<b>อีเมล์</b> {{ $adminuser->email }} <br>
<b>ชื่อ-นามสกุล</b> {{ $adminuser->title }}  {{ $adminuser->firstname }} {{ $adminuser->lastname }} <br>
<b>เลขบัตรประชาชน</b> {{ $adminuser->card_id }} <br>
<b>วันที่ออกบัตร</b> {{ $adminuser->card_build_at ? $adminuser->card_build_at->addYears(543)->format('d/m/Y') : null }} <br>
<b>วันที่บัตรหมดอายุ</b> {{ $adminuser->card_expire_at ? $adminuser->card_expire_at->addYears(543)->format('d/m/Y') : null }} <br>
<b>วันเกิด</b> {{ $adminuser->birthday ? $adminuser->birthday->addYears(543)->format('d/m/Y') : null }} <br>
<b>เพศ</b> {{ $adminuser->gender }} <br>
<b>เบอร์ติดต่อ</b> {{ $adminuser->tel }} <br>
<b>ที่อยู่</b> {{ $adminuser->address }}

@endsection