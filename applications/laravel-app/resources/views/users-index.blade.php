<ul>
    @foreach($users as $user)
        <li>
            {{ $user->id }} | <br>
            {{ $user->name }} | <br>
            {{ $user->email }}
        </li>
    @endforeach
</ul>
