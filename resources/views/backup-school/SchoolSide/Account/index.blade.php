@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <div class="my-5 mx-5 p-5 bg-white border rounded-md border border-gray-300 shadow-sm">
        <h2 class="text-2xl font-semibold">Account Settings</h2>
        <p class="text-gray-600 mb-6">Manage your account settings and set e-mail preferences.</p>

        <div class="bg-white   flex flex-row justify-between  my-5 border border-gray-500 p-4">
            <div>
                <h2 class="text-2xl font-semibold">School Logo Management</h2>

                <form action="{{ route('school.update.logo') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="text" value="{{ Auth::guard('school')->user()->school->pk_school_id }}"
                        name="pk_school_id" class="hidden" />
                    <img id="logoPreview"
                        src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                        class="rounded-full w-24 h-24 object-cover shadow-md my-2" alt="">
                    <div class="mb-4 flex items-center gap-2">

                        <input type="file" id="logo-upload" name="image_path" accept="image/*" class="hidden"
                            onchange="previewLogo(event)">
                        <button type="button" onclick="document.getElementById('logo-upload').click();"
                            class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-6 rounded-md text-md transition">
                            Select
                            Logo</button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md text-md transition">Save</button>
                    </div>
                </form>
            </div>
            <div class="flex items-center mx-5 md:block hidden">
                <img src="{{ asset('icon/logo.png') }}" class="h-36" alt="">
            </div>

        </div>
        <script>
            function previewLogo(event) {
                const [file] = event.target.files;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('logoPreview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>
        <!-- Last Login -->
        <div class="mb-6">
            <span class="font-medium">Last Login:</span>
            {{ Auth::guard('school')->user()->school->schoolUser->last_login
                ? \Carbon\Carbon::parse(Auth::guard('school')->user()->school->schoolUser->last_login)->format('F j, Y, g:i a')
                : 'Never' }}
        </div>

        <!-- Change Password Form -->
        <div class="border-t pt-6">
            <h3 class="text-xl font-semibold  ">Change Password</h3>
            <div class="mb-2 text-md">
                <span class="font-normal text-sm">Password Changed:
                    {{ Auth::guard('school')->user()->school->schoolUser->password_changed_at ?? ''
                        ? \Carbon\Carbon::parse(Auth::guard('school')->user()->school->schoolUser->password_changed_at ?? '')->format(
                            'F j, Y, g:i a',
                        )
                        : 'Never' }}</span>
            </div>
            <form action="{{ route('schools.account.change-password') }}" method="POST" class="space-y-4 max-w-md">
                @csrf
                @method('POST')

                <!-- Current Password -->
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full mt-1 px-3 py-1 border border-gray-400 rounded-md focus:ring focus:ring-blue-200">
                    <button type="button" onclick="togglePassword('current_password', this)"
                        class="absolute right-2 top-7 text-gray-600 text-sm">Show</button>
                    @error('current_password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" name="new_password" id="new_password" required
                        class="w-full mt-1 px-3 py-1 border border-gray-400 rounded-md focus:ring focus:ring-blue-200">
                    <button type="button" onclick="togglePassword('new_password', this)"
                        class="absolute right-2 top-7 text-gray-600 text-sm">Show</button>
                    @error('new_password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                        class="w-full mt-1 px-3 py-1 border border-gray-400 rounded-md focus:ring focus:ring-blue-200">
                    <button type="button" onclick="togglePassword('new_password_confirmation', this)"
                        class="absolute right-2 top-7 text-gray-600 text-sm">Show</button>
                </div>

                <div class="pt-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Update Password
                    </button>
                </div>
            </form>
            <script>
                function togglePassword(inputId, btn) {
                    const input = document.getElementById(inputId);
                    if (input.type === 'password') {
                        input.type = 'text';
                        btn.textContent = 'Hide';
                    } else {
                        input.type = 'password';
                        btn.textContent = 'Show';
                    }
                }
            </script>
            </form>
        </div>
    </div>
@endsection
