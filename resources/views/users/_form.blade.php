<div class="mb-4">
    <label class="form-label">Nama</label>
    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name') }}"
        placeholder="Masukkan nama lengkap">

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="form-label">Email</label>
    <input
        type="email"
        name="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email') }}"
        placeholder="contoh@email.com">

    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="form-label">Password</label>
    <input
        type="password"
        name="password"
        class="form-control @error('password') is-invalid @enderror"
        placeholder="Minimal 8 karakter">

    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="form-label">Role</label>

    <select
        name="role_id"
        class="form-select @error('role_id') is-invalid @enderror">

        <option value="">-- Pilih Role --</option>

        @foreach($roles as $role)
            <option
                value="{{ $role->id }}"
                {{ old('role_id') == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach

    </select>

    @error('role_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>