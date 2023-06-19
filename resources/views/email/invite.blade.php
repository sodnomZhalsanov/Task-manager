
<body style="background: black; color: white">
<h1>Email Invitation</h1>
<p>Hello - {{$email}}</p>
<p>Someone has invited you to task.</p>
<a href="{{ route('accept', $invite->token) }}">Click here</a> to join a team!
<p>....</p>
</body>
