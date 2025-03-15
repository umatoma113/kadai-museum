<form action="{{ route('users.update') }}" method="POST">
    @csrf
    @method('PATCH')

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
    @error('name') <span>{{ $message }}</span> @enderror

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    @error('email') <span>{{ $message }}</span> @enderror

    <button type="submit">Update Profile</button>
</form>

<form action="{{ route('users.destroy') }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit">Delete Account</button>
</form>