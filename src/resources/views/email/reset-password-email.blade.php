<h1>你好!{{$name}} 這封信是更改密碼驗證</h1>

<div>
    <h2 >信件驗證碼: <span style="color: red">{{$email_code}}</span></h2>
    <span>請先比對中工專題網上的信件驗證碼是否符合 <span style="color: red">{{$email_code}}</span>，如不符合請忽視這封信件!</span>
    <h3> 點下方的連結修改密碼:</h3>
    <h5>
        <a href="{{ route('reset.password.page', ["token"=>$token,"id"=>$id]) }}">修改密碼</a>
    </h5>
    <h6>請勿將此信件分享給他人!</h6>
</div>
