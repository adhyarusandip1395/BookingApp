<h1>Hello, {{ $user->f_name.' '.$user->l_name }}</h1>
<p>Please click the link below to verify your email address:</p>
<a href="{{ route('verify', ['id' => $user->id, 'hash' => sha1($user->email.'test')]) }}">
    Verify Email
</a>
