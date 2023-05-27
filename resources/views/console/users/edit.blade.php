<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
        <a href="/manage/users">Back to List</a>
    </x-slot>

    @if(session('status') != '')
    <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="bg-emerald-200 py-[6px] px-[10px] rounded text-sm text-gray-600">{{ session('status') }}</p>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form id="record-data" method="post" action="{{ $user->id > 0 ? route('users.update', $user->id) : route('users.store') }}" class="mt-6 space-y-6" onsubmit="return validatePassword()">
                        @csrf
                        @if($user->id > 0)
                            @method('patch')
                        @endif
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" :value="__('Name')"/>
                                <x-text-input id="name" name="name" type="text" value="{{ $user->name }}" class="mt-1 block w-full" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')"/>
                                <x-text-input id="email" name="email" type="email"  value="{{ $user->email }}" class="mt-1 block w-full" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('Password')"/>
                                <x-text-input id="password" name="password" type="password" value="" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('password')"/>
                            </div>

                            <div>
                                <x-input-label for="confirm_password" :value="__('Confirm Password')"/>
                                <x-text-input id="confirm_password" type="password" name="confirm_password" value="" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('confirm_password')"/>
                            </div>
                        </div>
                    </form>

                    <div class="flex items-center gap-4 mt-[15px]">
                        <x-primary-button onclick="doCancel()">{{ __('Cancel') }}</x-primary-button>
                        <x-primary-button form="record-data">{{ __('Save') }}</x-primary-button>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const doCancel = () =>{
        window.location.href=`/manage/users`;
    }

    const validatePassword = () =>{

        const formData = new FormData(document.querySelector('#record-data'));
        const newData = {};

        for (let [key, value] of formData.entries()){
            newData[key] = value;
        }

        // (?=.*[A-Z]) at least one uppercase
        // (?=.*[a-z]) at least one lowercase
        // (?=.*[0-9]) at least one numeric
        // (?=.*[!@#\$%\^&\*]) at least one special char
        // (?=.{8}) at least 8 characters in length
        const regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;

        if(newData.password != ''){
            if(regEx.test(newData.password)){
                if(newData.password ===  newData.confirm_password){
                    return true;
                }
            }
            return false;
        }

        return true;
    }

</script>
