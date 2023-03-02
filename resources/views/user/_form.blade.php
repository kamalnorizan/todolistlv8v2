@csrf

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control"
        value="@isset($user) {{ $user->name }} @endisset" placeholder="Enter your name"
        aria-describedby="helpId">
    <small class="text-danger"></small>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control"
        value="@isset($user) {{ $user->email }} @endisset" placeholder="eg:mail@example.com"
        aria-describedby="helpId">
    <small class="text-danger"></small>
</div>

@if (!isset($user))
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" aria-describedby="helpId">
        <small class="text-danger"></small>
    </div>
@endif
