@method('patch')


<div class="mb-3 form-group">
    <label for="roles" class="form-label">Role Use</label>
    <select required name="role" class="form-control" id="roles-edit">
        <option></option>
        @foreach ($dataRole as $item)
            <option {{ old('role', $user->roles->value('name')) == $item->name ? 'selected' : '' }} value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
        @endforeach

    </select>

</div>

<x-ui.input
    label="Nama Legkap"
    id="name"
    name="name"
    required
    placeholder="Nama"
    value="{{ old('name', $user->name) }}"
/>

<x-ui.input
    label="Email"
    id="email"
    name="email"
    required
    placeholder="email"
    type="email"
    value="{{ old('email', $user->email) }}"
/>

<x-ui.input
    label="Username"
    id="username"
    name="username"
    required
    placeholder="username"
    value="{{ old('username', $user->username) }}"
/>

<x-ui.input
    label="Password"
    id="password"
    name="password"
    placeholder="password"
    value="{{ old('password') }}"
/>
