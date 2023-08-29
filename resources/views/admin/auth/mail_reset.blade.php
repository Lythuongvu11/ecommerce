<div style="width: 600px;margin: 0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{$admin->name}}</h2>
        <p>Bạn đã yêu cầu đặt lại mật khẩu tại hệ thống của chúng tôi</p>
        <p>Vui lòng nhấn vào link bên dưới để đặt lại mật khẩu </p>
        <p>Chú ý mã xác nhận trong link chỉ có hiệu lực trong 24h</p>
        <p>
            <a href="{{ route('admin.password.reset',['admin'=>$admin->id,'token'=> $admin->reset_password_token])}}">Nhấn vào đây để đặt lại mật khẩu</a>
        </p>
    </div>
</div>
